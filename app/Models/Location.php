<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property integer $parrent_id
 */
class Location extends Model
{
    protected $connection = 'autogari';
    public $timestamps = false;

    protected $appends = ['translate'];

    public function constant(){
        return $this->hasMany(ConstantLanguage::class,'constant_id','name');
    }

    public function getTranslateAttribute(){
        $translate = $this->constant()->where('language_id',Language::where('url',app()->getLocale())->first()->id)->first();
        if (!is_null($translate))
            return $translate->translate;
        return "";
    }
}
