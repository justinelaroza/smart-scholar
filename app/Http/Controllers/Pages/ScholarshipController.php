<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::orderBy('created_at', 'desc')->paginate(5);

        return view('scholarships.index', compact('scholarships'));
    }

    public function show($id) 
    {
        $scholarship = Scholarship::findOrFail($id);
        
        return view('scholarships.show', compact('scholarship'));
    }

    public function create($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        return view('scholarships.create', compact('scholarship'));
    }

    public function upload($id)
    {
        $scholarship = Scholarship::findOrFail($id);

        return view('scholarships.upload', compact('scholarship'));
    }
}
