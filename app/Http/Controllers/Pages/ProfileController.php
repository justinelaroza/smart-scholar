<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $applications = FileUpload::with('scholarship')->where('user_id', Auth::id())->latest()->get();

        return view('pages.profile', compact('applications'));
    }


}
