<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 * @package App\Models
 *
 * @property integer $id
 * @property boolean $active
 * @property string $class
 * @property string $shown_name
 *
 * @property Tag[] $tags
 */

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    protected $fillable = [
        'name',
        'class',
        'active',
        'shown_name'
    ];

    protected $appends = ['title'];

    public $timestamps = false;

    public function getTitleAttribute(){
        $json = json_decode($this->shown_name,true);
        return $json[app()->getLocale()];
    }


    public function tags(){
        return $this->hasMany(PaymentMethodTag::class,'payment_method_id');
    }
}
