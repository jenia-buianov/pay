<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * @package App\Models
 *
 * @property integer $id
 * @property string $url
 * @property string $name
 * @property integer $by_default
 */
class Language extends Model
{
    protected $connection = 'autogari';
    public $timestamps = false;
}
