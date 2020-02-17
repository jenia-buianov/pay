<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 * @package App\Models
 *
 * @property integer $id
 * @property string $code
 * @property string $phone_number
 * @property string $second_phone_number
 * @property string $email
 * @property string $details
 * @property integer $schedule_course_id
 * @property string $added
 * @property integer $language_id
 *
 * @property Language $language
 */
class Reservation extends Model
{
    protected $connection = 'autogari';
    protected $table = 'reservations';
    public $timestamps = false;

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
