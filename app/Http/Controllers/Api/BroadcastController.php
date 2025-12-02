<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Events\ScholarshipCreated;
use App\Events\ScholarshipUpdated;
use App\Events\ScholarshipDeleted;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Log;
use App\Events\ApplicationProgressUpdated;

class BroadcastController extends Controller
{
    public function scholarshipCreated(Request $request)
    {       
        $request->validate([
            'scholarship_id' => 'required|integer'
        ]);
        
        $scholarshipId = $request->input('scholarship_id');
        
        $scholarship = Scholarship::find($scholarshipId);
        
        if (!$scholarship) {
            return response()->json(['error' => 'Scholarship not found'], 404);
        }
        
        broadcast(new ScholarshipCreated($scholarship));
        
        return response()->json([
            'message' => 'Broadcast sent successfully',
            'scholarship_id' => $scholarshipId
        ]);
    }

    public function scholarshipUpdated(Request $request)
    { 
        $request->validate([
            'scholarship_id' => 'required|integer'
        ]);
        
        $scholarshipId = $request->input('scholarship_id');
        
        $scholarship = Scholarship::find($scholarshipId);
        
        if (!$scholarship) {
            return response()->json(['error' => 'Scholarship not found'], 404);
        }
        
        broadcast(new ScholarshipUpdated($scholarship));
        
        return response()->json([
            'message' => 'Broadcast sent successfully',
            'scholarship_id' => $scholarshipId
        ]);
    }

    public function scholarshipDeleted(Request $request)
    {
        $request->validate([
            'scholarship_id' => 'required|integer'
        ]);
        
        $scholarshipId = $request->input('scholarship_id');
        
        broadcast(new ScholarshipDeleted($scholarshipId));
        
        return response()->json([
            'message' => 'Broadcast sent successfully',
            'scholarship_id' => $scholarshipId
        ]);
    }

    public function applicationProgressUpdated(Request $request)
    {
        $request->validate([
            'application_id' => 'required|integer'
        ]);
        
        $applicationId = $request->input('application_id');
        
        $application = FileUpload::with('scholarship')->find($applicationId);
        
        if (!$application) {
            return response()->json(['error' => 'Application not found'], 404);
        }
        
        event(new ApplicationProgressUpdated($application));
        
        return response()->json([
            'success' => true,
            'message' => 'Application progress broadcast sent',
            'application_id' => $applicationId
        ]);
    }
}