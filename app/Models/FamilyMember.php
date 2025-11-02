<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'user_id', 'last_name', 'first_name', 'middle_name', 'sex', 'birthdate',
        'civil_status', 'relationship', 'education', 'occupation', 'income'
    ];
}
