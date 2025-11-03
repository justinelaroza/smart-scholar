<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Auth;
use App\Models\FamilyMember;
use App\Models\GeneralInfo;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $applications = FileUpload::with('scholarship')->where('user_id', $userId)->latest()->get();

        $generalInfo = Auth::user()->generalInfo;
        $familyMembers = Auth::user()->familyMembers;

        return view('pages.profile', compact('applications', 'generalInfo', 'familyMembers'));
    }


}
