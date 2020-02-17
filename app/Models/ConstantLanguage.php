<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyType
 * @package App\Models
 *
 * @property integer $id
 * @property integer $constant_id
 * @property integer $language_id
 * @property string $translate
 *
 * @property Language $language
 */
class ConstantLanguage extends Model
{
    protected $connection = 'autogari';
    protected $table = 'constants_languages';
    protected $fillable = [];
    public $timestamps = false;

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
