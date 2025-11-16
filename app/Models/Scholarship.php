<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    protected $fillable = [
        'title', 'funder', 'description', 'education_level', 
        'application_start', 'submission_deadline', 'amount', 
        'status', 'image', 'residency_requirement'
    ];

    protected $hidden = [
        'image'
    ];

    // Add this accessor to handle binary image data
    public function getImageBase64Attribute()
    {
        if (!$this->image) {
            return null;
        }
        
        $imageData = $this->image;
        
        // Handle PostgreSQL resource stream
        if (is_resource($imageData)) {
            rewind($imageData);
            $imageData = stream_get_contents($imageData);
        }
        
        return base64_encode($imageData);
    }
    
  public function generalInfos()
  {
      return $this->hasMany(GeneralInfo::class);
  }

  public function fileUploads()
  {
      return $this->hasMany(FileUpload::class);
  }
}
