<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    // By default this model will use the "pending_registrations" table
    // because Laravel pluralizes the class name.

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'address',
        'email',
        'phone',
        'password',   // this will be hashed already by the controller
        'otp_code',
    ];
}
