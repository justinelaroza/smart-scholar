<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    protected $fillable = [
        'user_id', 'scholarship_id', 'client_name', 'sex', 'age', 'birth_date', 'civil_status',
        'birth_place', 'address', 'contact_number', 'relationship_to_beneficiary',
        'religion', 'nationality', 'education_level', 'philhealth_no', 'occupation',
        'income_range', 'mode_of_admission', 'referring_party', 'referring_contact',
        'beneficiary_category', 'beneficiary_id_no', 'beneficiary_name', 'beneficiary_sex',
        'beneficiary_birth_date', 'beneficiary_address', 'beneficiary_birth_place',
        'beneficiary_civil_status'
    ];
}
