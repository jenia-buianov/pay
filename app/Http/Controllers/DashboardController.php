<?php

namespace App\Http\Controllers;

use App\Mail\Send;
use App\Models\CurrencyType;
use App\Models\Invoice;
use App\Models\Language;
use App\Models\Location;
use App\Models\Passenger;
use App\Models\PhoneType;
use App\Models\Status;
use App\Models\Transporter;
use App\OfferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class DashboardController extends Controller
{
    public function index(){
        $paidInvoices = Invoice::where('status_id',Status::where('code','paid')->first()->id)->get()->pluck('id');
        return view('dashboard.index',[
            'invoices'=>Invoice::with(['passengers.currencyType','status','details','locationFrom','locationTo'])->orderBy('id','desc')->limit(20)->get(),
            'pages' => ceil(Invoice::count()/15),
            'statistics'=> [
                'invoices' => Invoice::count(),
                'paid' => Invoice::whereHas('status',function($q){
                    $q->where('code','paid');
                })->count(),
                'unpaid' => Invoice::whereHas('status',function($q){
                    $q->where('code','<>','paid');
                })->count(),
                'money' => number_format(Passenger::whereIn('invoice_id',$paidInvoices)->where('currency_type_id',5)->sum('amount'),2),
            ]
        ])->render();
    }

    public function createInvoice(){
        return view('dashboard.create_invoice',[
            'offer_types' => OfferType::all(),
            'phone_types' => PhoneType::all(),
            'transporters' => Transporter::all(),
            'countries' => Location::where('parrent_id',0)->get(),
            'currencies' => CurrencyType::all()
        ]);
    }

    public function getCities(Request $request){
        $query = DB::connection('autogari')->table('constants_languages as cl')
            ->select(['cl.translate','l.id'])
            ->join('locations as l','l.name','=','cl.constant_id')
            ->where('l.parrent_id','>',0)
            ->where('cl.language_id',Language::where('url',app()->getLocale())->first()->id)
            ->where('cl.translate','like','%'.htmlspecialchars($request->get('q'),3).'%');

        return response()->json(['results'=>$query->limit(10)->get()]);
    }

    public function generateInvoice(Request $request){
        $validate = $this->validator($request->post());
        if ($validate->fails()){
            return response()->json(['status'=>false,'errors'=>$this->getErrors($validate)]);
        }

        foreach ($request->post('passengers') as $i=>$passenger){
            $validate = $this->validatePassenger($passenger);
            if ($validate->fails()){
                return response()->json(['status'=>false,'errors'=>$this->getErrors($validate)]);
            }
        }

        $post = $request->post();
        $invoice = $this->createInvoiceDB($post);
        $this->createInvoiceDetails($post,$invoice);
        $this->createPassengers($post,$invoice);

        return response()->json(['status'=>true,'invoice'=>$invoice]);
    }

    public function sendSMS(Request $request){
        $invoice = Invoice::where('id',(int)$request->invoice)->first();
        if (is_null($invoice)){
            return response()->json(['status'=> false]);
        }

        $link = route('invoice',['uuid'=>$invoice->uuid]);
        $link = str_replace('https://','',$link);
        $link = str_replace('http://','',$link);
        Send::send('sms',$invoice->details->phone,"",__('Plata online :from - :to',['from'=>$invoice->locationFrom->translate,'to'=>$invoice->locationTo->translate])."\n".$link);

        return response()->json(['status'=>true]);
    }

    private function validator($data){
        return Validator::make($data,[
            'transporter.id' => 'required|integer|exists:autogari.transporters,id',
            'direction.from.id' => 'required|integer|exists:autogari.locations,id',
            'direction.to.id' => 'required|integer|exists:autogari.locations,id',
            'direction.date' => 'required|string',
            'direction.due_date' => 'required|string',
//            'client.first_name' => 'sometimes|string|min:3',
//            'client.last_name' => 'sometimes|string|min:3',
            'client.phone' => 'required|string|min:9',
//            'client.email' => 'sometimes|email',
//            'client.another_phone' => 'sometimes|string',
//            'client.another_phone_type.id' => 'required_with:another_phone',
            'client.country.id' => 'sometimes|integer|exists:autogari.locations,id',
            'client.state' => 'sometimes|array',
            'client.city' => 'sometimes|array',
//            'client.address' => 'sometimes|string|min:5',
            'passengers' => 'required|array'
        ]);
    }

    private function validatePassenger($data){
        return Validator::make($data,[
            'currency.id' => 'required|integer|exists:autogari.currency_types,id',
            'offer_type.id' => 'required|integer|exists:autogari.schedule_offer_types,id',
            'price' => 'required|numeric',
//            'first_name' => 'sometimes|string|min:3',
//            'last_name' => 'sometimes|string|min:3',
        ]);
    }

    private function getErrors($validate){
        $messages = [];
        foreach($validate->errors()->getMessages() as $i=>$error){
            $messages[] = implode(', ',$error);
        }
        return implode('<br>',$messages);
    }

    private function createInvoiceDB($post){
        $post['direction']['date'] = strtotime($post['direction']['date']);
        $post['direction']['due_date'] = strtotime($post['direction']['due_date']);
        $tag = DB::connection('autogari')->table('object_tag')->select(['tag_id'])->where('object_id',(int)$post['transporter']['id'])->where('type','transporters')->first()->tag_id;
        return $invoice = Invoice::create([
            'transporter_id' => $post['transporter']['id'],
            'payment_method_id' => 0,
            'status_id' => Status::where('code','pending')->first()->id,
            'due_date' => date('Y-m-d',$post['direction']['due_date']),
            'date' => date('Y-m-d',$post['direction']['date']),
            'time' => date('H:i:00',$post['direction']['date']),
            'tag_id' => $tag,
            'reservation_id' => 0,
            'location_from' => $post['direction']['from']['id'],
            'location_to' => $post['direction']['to']['id'],
            'uuid' => mb_substr(str_shuffle(implode('',explode('-',Uuid::uuid4()))),0,16)
        ]);
    }

    private function createInvoiceDetails($post,$invoice){
        if (!isset($post['client']['another_phone_type'])){
            $post['client']['another_phone'] = "";
            $post['client']['another_phone_type'] = ['id'=>0];
        }

        $invoice->details()->create([
            'another_phone_type_id' => $post['client']['another_phone_type']['id'],
            'another_phone' => $post['client']['another_phone'],
            'client_location' => $post['client']['country']['id'],
            'client_state' => isset($post['client']['state'])?$post['client']['state'][0]['text']:"",
            'client_city' => isset($post['client']['city'])?$post['client']['city'][0]['text']:"",
            'client_address' => isset($post['client']['address'])?$post['client']['address']:"",
            'phone' => $post['client']['phone'],
            'first_name' => isset($post['client']['first_name'])?$post['client']['first_name']:"",
            'last_name' => isset($post['client']['last_name'])?$post['client']['last_name']:"",
            'email' => isset($post['client']['email'])?$post['client']['email']:""
        ]);
    }

    private function createPassengers($post,$invoice){
        foreach ($post['passengers'] as $i=>$passenger){
            $invoice->passengers()->create([
                'currency_type_id' => $passenger['currency']['id'],
                'offer_type_id' => $passenger['offer_type']['id'],
                'amount' => $passenger['price'],
                'first_name' => $passenger['first_name'],
                'last_name' => $passenger['last_name']
            ]);
        }
    }
}
