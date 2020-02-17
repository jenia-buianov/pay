<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property integer $id
 * @property integer $language_id
 *
 * @property Language $language
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $connection = "autogari";

    protected $fillable = [
        'username', "access_token", "user_role_id"
    ];

    protected $hidden = [
        'password', 'auth_key', "remember_token"
    ];

    public function language(){
        return $this->belongsTo(Language::class);
    }
}
