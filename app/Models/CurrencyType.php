<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyType
 * @package App\Models
 *
 * @property integer $id
 * @property integer $name
 * @property integer $numcode
 * @property string $charcode
 * @property integer $is_delete
 *
 * @property Passenger[] $passengers
 */
class CurrencyType extends Model
{
    protected $connection = 'autogari';
    protected $table = 'currency_types';
    protected $fillable = [];
    public $timestamps = false;

    public function passengers(){
        return $this->hasMany(Passenger::class);
    }
}
