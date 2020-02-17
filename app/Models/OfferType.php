<?php

namespace App;

use App\Models\ConstantLanguage;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OfferType
 * @package App
 *
 * @property integer $id
 * @property integer $name
 * @property string $code
 * @property integer $from_field
 * @property integer $to_field
 * @property integer $textual_field
 * @property integer $segments_consts_field
 * @property integer $free_baggage_field
 * @property integer $reservation_message
 *
 * @property string $translate
 */
class OfferType extends Model
{
    protected $connection = 'autogari';
    protected $table = 'schedule_offer_types';
    public $timestamps = false;

    protected $appends = ['translate'];

    public function constant(){
        return $this->hasMany(ConstantLanguage::class,'constant_id','name');
    }

    public function getTranslateAttribute(){
        $translate = $this->constant()->where('language_id',Language::where('url',app()->getLocale())->first()->id)->first();
        if (!is_null($translate))
            return $translate->translate;
        return $this->code;
    }
}
