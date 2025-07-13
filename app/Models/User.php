<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'password',
        'nama',
        'status',
    ];

    public function emailOtp()
    {
        return $this->hasOne(EmailOtp::class, 'id_user', 'id_user');
    }

}
