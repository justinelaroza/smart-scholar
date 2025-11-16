<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;

class CreateScholarshipController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'funder' => 'required|string',
            'description' => 'required|string',
            'education_level' => 'required|string',
            'application_start' => 'required|date',
            'submission_deadline' => 'required|date',
            'amount' => 'required|integer',
            'status' => 'required|string',
            'residency_requirement' => 'required|string',
            'image' => 'nullable|file|image|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('scholarship_images', 'public');
        }

        $scholarship = Scholarship::create([
            'title' => $request->title,
            'funder' => $request->funder,
            'description' => $request->description,
            'education_level' => $request->education_level,
            'application_start' => $request->application_start,
            'submission_deadline' => $request->submission_deadline,
            'amount' => $request->amount,
            'status' => $request->status,
            'residency_requirement' => $request->residency_requirement,
            'image' => $imagePath ?? 'assets/images/ss-logo.png'
        ]);

        return response()->json([
            'success' => true,
            'data' => $scholarship,
        ]);
    }

}
