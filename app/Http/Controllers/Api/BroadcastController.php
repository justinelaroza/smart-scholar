<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use App\Events\ScholarshipCreated;
use App\Events\ScholarshipUpdated;
use App\Events\ScholarshipDeleted;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function scholarshipCreated(Request $request)
{       
    try {
        $request->validate([
            'scholarship_id' => 'required|integer'
        ]);
        
        $scholarshipId = $request->input('scholarship_id');
        
        $scholarship = Scholarship::find($scholarshipId);
        
        if (!$scholarship) {
            return response()->json(['error' => 'Scholarship not found'], 404);
        }
        
        // This is where it's failing
        broadcast(new ScholarshipCreated($scholarship));
        
        return response()->json([
            'message' => 'Broadcast sent successfully',
            'scholarship_id' => $scholarshipId
        ]);
        
    } catch (\Exception $e) {
        // Return the actual error so we can see it
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
    }
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
}