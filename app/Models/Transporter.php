<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transporter
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $fiscal_code
 * @property string $licence_number
 * @property string $phone_number
 * @property string $email
 * @property integer $user_id
 * @property integer $parrent_id
 * @property integer $reservation_status
 * @property integer $transfer
 * @property string $reservations_email
 * @property string $reservations_phone
 * @property string $report_phone
 */
class Transporter extends Model
{
    protected $connection = 'autogari';
    protected $table = 'transporters';
    public $timestamps = false;
}
