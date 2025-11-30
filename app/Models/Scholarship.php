<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ScholarshipCreated;
use App\Events\ScholarshipUpdated;
use App\Events\ScholarshipDeleted;

class Scholarship extends Model
{
    protected $fillable = [
        'title', 'funder', 'description', 'education_level', 
        'application_start', 'submission_deadline', 'amount', 
        'status', 'image_url', 'residency_requirement'
    ];

    protected $hidden = [
        'image'
    ];
    
    public function generalInfos()
    {
        return $this->hasMany(GeneralInfo::class);
    }

    public function fileUploads()
    {
        return $this->hasMany(FileUpload::class);
    }

    protected static function booted()
    {
        static::created(function ($scholarship) {
            broadcast(new ScholarshipCreated($scholarship));
        });

        static::updated(function ($scholarship) {
            broadcast(new ScholarshipUpdated($scholarship));
        });

        static::deleted(function ($scholarship) {
            broadcast(new ScholarshipDeleted($scholarship->id));
        });
    }
}
