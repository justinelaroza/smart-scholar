<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;

class FileUploadApiController extends Controller
{ 
  public function viewDocument($id, $field)
  {
    $fileUpload = FileUpload::findOrFail($id);

    $validFields = [
      'school_registration_form',
      'barangay_clearance',
      'certificate_of_indigency',
      'school_id_front',
      'school_id_back',
      'cedula',
      'breakdown_of_expenses'
    ];

    if (!in_array($field, $validFields)) {
        abort(404);
    }

    $cloudinaryUrl = $fileUpload->$field;

    if (!$cloudinaryUrl) {
        abort(404, 'File not found');
    }

    return redirect($cloudinaryUrl);
  }

  public function downloadDocument($id, $field)
  {
    $fileUpload = FileUpload::findOrFail($id);

    $validFields = [
      'school_registration_form',
      'barangay_clearance',
      'certificate_of_indigency',
      'school_id_front',
      'school_id_back',
      'cedula',
      'breakdown_of_expenses'
    ];

    if (!in_array($field, $validFields)) {
        abort(404, 'Invalid field');
    }

    $cloudinaryUrl = $fileUpload->$field;

    if (!$cloudinaryUrl) {
        abort(404, 'File not found');
    }

    // For Cloudinary, add fl_attachment flag to force download
    $downloadUrl = str_replace('/upload/', '/upload/fl_attachment/', $cloudinaryUrl);

    return redirect($downloadUrl);
  }
}