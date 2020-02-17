<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invoice
 *
 * @package App\Models
 *
 * @property integer $id
 * @property integer $status_id
 * @property integer $payment_method_id
 * @property integer $transporter_id
 * @property integer $tag_id
 * @property integer $reservation_id
 * @property string $due_date
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 * @property string $location_from
 * @property string $location_to
 * @property string $time
 * @property string $uuid
 *
 * @property Status $status
 * @property PaymentMethod $paymentMethod
 * @property Tag $tag
 * @property Reservation $reservation
 * @property Transporter $transporter
 * @property InvoiceDetails $details
 * @property Passenger[] $passengers
 *
 * @property float $sum
 */


class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'status_id',
        'payment_method_id',
        'transporter_id',
        'tag_id',
        'due_date',
        'location_from',
        'location_to',
        'date',
        'time',
        'reservation_id',
        'uuid'
    ];

    protected $dates = ['created_at','updated_at','date','due_date'];

    protected $appends = ['sum'];

    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }

    public function transporter(){
        return $this->belongsTo(Transporter::class);
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function details(){
        return $this->hasOne(InvoiceDetails::class);
    }

    public function passengers(){
        return $this->hasMany(Passenger::class);
    }

    public function locationFrom(){
        return $this->belongsTo(Location::class,'location_from');
    }

    public function locationTo(){
        return $this->belongsTo(Location::class,'location_to');
    }

    public function getSumAttribute(){
        try {
            return $this->passengers()->sum('amount')." ".$this->passengers()->first()->currencyType->charcode;
        }catch (\Exception $e){
            return $this->id;
        }
    }
}
