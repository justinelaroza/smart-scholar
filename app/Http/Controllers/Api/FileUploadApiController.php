<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Storage;

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

    $filePath = $fileUpload->$field;

    if (!$filePath || !Storage::disk('local')->exists($filePath)) {
        abort(404, 'File not found');
    }

    $absolutePath = Storage::disk('local')->path($filePath);

    return response()->file($absolutePath);
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

    $filePath = $fileUpload->$field;

    if (!$filePath || !Storage::disk('local')->exists($filePath)) {
        abort(404, 'File not found');
    }

    $absolutePath = Storage::disk('local')->path($filePath);

    return response()->download($absolutePath);
  }
}