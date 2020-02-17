<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App\Models
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 */

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['name','code'];
}
