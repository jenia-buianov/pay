<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceDetails
 * @package App\Models
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $another_phone_type_id
 * @property string $client_location
 * @property string $client_state
 * @property string $client_city
 * @property string $client_address
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $another_phone
 *
 * @property Invoice $invoice
 * @property PhoneType $phoneType
 *
 * @property string $name
 */

class InvoiceDetails extends Model
{
    protected $table = 'invoice_details';

    protected $fillable = [
        'invoice_id',
        'client_location',
        'client_city',
        'client_state',
        'client_address',
        'first_name',
        'last_name',
        'phone',
        'email',
        'another_phone',
        'another_phone_type_id',
    ];

    protected $appends = ['name'];
    public $timestamps = false;

    public function getNameAttribute(){
        return trim($this->first_name.' '.$this->last_name);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function phoneType(){
        return $this->belongsTo(PhoneType::class,'another_phone_type_id');
    }
}
