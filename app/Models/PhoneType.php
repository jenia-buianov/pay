<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhoneType
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 */

class PhoneType extends Model
{
    protected $table = 'phone_types';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
}
