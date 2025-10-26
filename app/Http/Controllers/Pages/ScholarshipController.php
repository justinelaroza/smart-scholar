<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index()
    {
        return view('scholarships.index');
    }

    public function show() 
    {
        return view('scholarships.show');
    }

    public function create()
    {
        return view('scholarships.create');
    }

    public function upload()
    {
        return view('scholarships.upload');
    }
}
