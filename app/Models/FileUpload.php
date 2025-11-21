<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{   
     protected $fillable = [
        'user_id',
        'scholarship_id',
        'school_registration_form',
        'barangay_clearance',
        'certificate_of_indigency',
        'school_id_front',
        'school_id_back',
        'cedula',
        'breakdown_of_expenses',
        'school_registration_form_mime',
        'barangay_clearance_mime',
        'certificate_of_indigency_mime',
        'school_id_front_mime',
        'school_id_back_mime',
        'cedula_mime',
        'breakdown_of_expenses_mime',
        'remarks_school_registration_form',
        'remarks_barangay_clearance',
        'remarks_certificate_of_indigency',
        'remarks_school_id_front',
        'remarks_school_id_back',
        'remarks_cedula',
        'remarks_breakdown_of_expenses',
        'progress',
        'qr_code',
        'qr_code_mime',
    ];

    protected $hidden = [
        'school_registration_form',
        'barangay_clearance',
        'certificate_of_indigency',
        'school_id_front',
        'school_id_back',
        'cedula',
        'breakdown_of_expenses',
        'qr_code',
    ];

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQrCodeBase64Attribute()
    {
        if (!$this->qr_code) {
            return null;
        }
        
        $qrData = $this->qr_code;
        
        // Handle PostgreSQL resource stream
        if (is_resource($qrData)) {
            rewind($qrData);
            $qrData = stream_get_contents($qrData);
        }
        
        return base64_encode($qrData);
    }
}
