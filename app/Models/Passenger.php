<?php

namespace App\Models;

use App\OfferType;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Passenger
 * @package App\Models
 */

class Passenger extends Model
{
    protected $table = 'passengers';
    protected $fillable = [
        'invoice_id',
        'first_name',
        'last_name',
        'currency_type_id',
        'amount',
        'offer_type_id'
    ];

    public $timestamps = false;

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function currencyType(){
        return $this->belongsTo(CurrencyType::class);
    }

    public function offerType(){
        return $this->belongsTo(OfferType::class);
    }
}
