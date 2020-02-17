<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethodTag
 * @package App\Models
 *
 * @property integer $payment_method_id
 * @property integer $tag_id
 *
 * @property PaymentMethod $paymentMethod
 * @property Tag $tag
 */

class PaymentMethodTag extends Model
{
    protected $table = 'payment_method_tags';
    protected $fillable = [
        'payment_method_id',
        'tag_id'
    ];

    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
