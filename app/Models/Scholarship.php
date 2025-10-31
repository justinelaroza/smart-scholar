<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'title',
        'funder',
        'description',
        'education_level',
        'submission_deadline',
        'amount',
        'status',
        'image',
    ];
}
