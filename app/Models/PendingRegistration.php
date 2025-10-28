<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    // This tells Laravel which fields we are allowed to mass assign
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'address',
        'email',
        'phone',
        'password',   // this is already hashed before saving
        'otp_code',
    ];
}
