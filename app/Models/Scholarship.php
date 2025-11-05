<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
  public function generalInfos()
  {
      return $this->hasMany(GeneralInfo::class);
  }

  public function fileUploads()
  {
      return $this->hasMany(FileUpload::class);
  }
}
