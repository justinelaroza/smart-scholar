<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    protected $fillable = [
        'user_id', 'scholarship_id', 'school_registration_form', 'barangay_clearance', 'certificate_of_indigency', 
        'school_id_front', 'school_id_back', 'cedula', 'breakdown_of_expenses', 'progress'
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
