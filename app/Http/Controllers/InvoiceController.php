<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodTag;
use App\Models\PhoneType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\TranslationLoader\LanguageLine;

class InvoiceController extends Controller
{
    public function showCompleted($uuid, Request $request){
        $invoice = Invoice::where('uuid',htmlspecialchars($uuid,3))->first();
        if (is_null($invoice) || (!is_null($invoice) && strtotime($invoice->due_date)<time()))
            abort(404);

        if (empty(trim($invoice->details->name)) ||  ($invoice->passengers->count() && empty($invoice->passengers[0]->first_name))){
            return view('invoice.form',['invoice'=>$invoice,'types'=>PhoneType::all()]);
        }


        $methodsIDS = PaymentMethodTag::where('tag_id',$invoice->tag_id)->get()->pluck('payment_method_id');
        return view('invoice.completed',[
            'invoice'=>$invoice,
            'tax'=>[
                'amount'=>5,
                'currency'=>$invoice->passengers[0]->currencyType->charcode
            ],
            'total'=>[
                'amount'=>5+$invoice->passengers()->sum('amount'),
                'currency'=>$invoice->passengers[0]->currencyType->charcode
            ],
            'methods' => PaymentMethod::whereIn('id',$methodsIDS)->where('active',1)->get()
        ]);
    }

    public function save($uuid, Request $request){
        $invoice = Invoice::where('uuid',htmlspecialchars($uuid,3))->first();
        if (is_null($invoice))
            abort(404);

        $post = $request->post();
        $errors = [];
        if (empty(trim($invoice->details->name))){
            $validate = $this->checkClientData($post['client']);
            if ($validate->fails()){
                foreach ($validate->errors()->getMessages() as $i=>$message){
                    $errors[] = $message[0];
                }
            }
        }
        if ($invoice->passengers->count()==0)
            $errors[] = __('No passengers were added');
        else{
            if(empty($invoice->passengers[0]->first_name)){
                if (!isset($post['passengers']) || count($post['passengers'])==0){
                    $errors = __('Please fill passengers form');
                }else{
                    foreach ($post['passengers'] as $i=>$passenger){
                        if (empty($passenger['first_name']) || empty($passenger['last_name']))
                            $errors[] = __('Passenger :index has no name',['index'=>$i+1]);
                    }
                }
            }
        }

        if (count($errors)>0){
            return view('invoice.form',['invoice'=>$invoice,'post'=>$post,'errors'=>$errors,'types'=>PhoneType::all()]);
        }
        else{
            if (empty(trim($invoice->details->name))){
                $invoice->details->update($this->beforeInsert($post['client']));
            }
            if ($invoice->passengers->count()>0 && empty($invoice->passengers[0]->first_name)){
                foreach ($invoice->passengers as $i=>$passenger){
                    $passenger->first_name = htmlspecialchars($post['passengers'][$i]['first_name'],3);
                    $passenger->last_name = htmlspecialchars($post['passengers'][$i]['last_name'],3);
                    $passenger->save();
                }
            }
        }

        return redirect(route('invoice',['uuid'=>$invoice->uuid]));
    }

    private function checkClientData($data){
        return Validator::make($data,[
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'client_state' => 'required|string|min:3',
            'client_address' => 'required|string|min:3',
            'client_city' => 'required|string|min:3',
            'email' => 'sometimes',
            'another_phone' => 'sometimes',
            'another_phone_type_id' => 'required_with:another_phone'
        ]);
    }

    private function beforeInsert($post){
        foreach ($post as $key=>$value){
            if (is_null($value))
                $post[$key] = "";
            else $post[$key] = htmlspecialchars($value,3);
        }
        return $post;
    }
}
