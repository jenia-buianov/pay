<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 * @property integer $id
 * @property string $name
 * @property string $domain
 */
class Tag extends Model
{
    protected $connection = 'autogari';
    protected $table = 'tags';
    protected $fillable = false;
}
