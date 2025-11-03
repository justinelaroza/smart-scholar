<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\GeneralInfo;
use App\Models\FamilyMember;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Auth;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::query();

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->education_level);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('funder', 'like', "%{$search}%");
            });
        }

        $scholarships = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->query());

        return view('scholarships.index', compact('scholarships'));
    }

    public function show($id) 
    {
        $scholarship = Scholarship::withCount('generalInfos')->findOrFail($id);
        
        $user = Auth::user();

        $hasApplied = false;
        $hasGeneralInfo = false;
        if ($user) {
            $hasApplied = FileUpload::where('user_id', $user->id)->where('scholarship_id', $scholarship->id)->exists();
            $hasGeneralInfo = GeneralInfo::where('user_id', $user->id)->exists();
        }

        return view('scholarships.show', compact('scholarship', 'hasApplied', 'hasGeneralInfo'));
    }

    public function create($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $user = Auth::user();

        $hasApplied = FileUpload::where('user_id', $user->id)->where('scholarship_id', $id)->exists();

        if ($hasApplied) {
            return redirect()->route('scholarship.show', ['id' => $id])->with('error', 'You have already applied for this scholarship.');
        }

        $hasGeneralInfo = GeneralInfo::where('user_id', $user->id)->exists();
        if ($hasGeneralInfo) {
            return redirect()->route('scholarship.upload', ['id' => $id]);
        }

        return view('scholarships.create', compact('scholarship'));
    }

    public function upload($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $user = Auth::user();

        $hasGeneralInfo = GeneralInfo::where('user_id', $user->id)->exists();

        if (!$hasGeneralInfo) {
            return redirect()->route('scholarship.create', ['id' => $id])->with('error', 'Please fill out your general information first.');
        }

        $hasApplied = FileUpload::where('user_id', $user->id)->where('scholarship_id', $id)->exists();

        if ($hasApplied) {
            return redirect()->route('scholarship.show', ['id' => $id])->with('error', 'You already submitted your application files.');
        }

        return view('scholarships.upload', compact('scholarship'));
    }

    public function storeGeneralInfo(Request $request, $id)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_sex' => 'required|in:Male,Female',
            'client_age' => 'required|integer|min:0',
            'client_birthdate' => 'required|date',
            'client_civil_status' => 'required|in:Single,Married,Others',
            'client_birthplace' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',
            'client_contact' => 'required|string|max:20',
            'client_relationship' => 'required|string|max:255',
            'client_religion' => 'required|string|max:255',
            'client_nationality' => 'required|string|max:255',
            'client_education' => 'required|in:Elementary,High School,Senior High School,College Undergraduate,College Graduate',
            'client_philhealth' => 'required|string|max:50',
            'client_occupation' => 'required|string|max:255',
            'client_income' => 'required|in:less_10k,10k_20k,20k_50k,50k_100k,above_100k',
            'client_admission_mode' => 'required|in:Walk-in,Referral,4Ps Beneficiary',
            'client_referring_party' => 'required|string|max:255',
            'client_referring_contact' => 'required|string|max:255',

            // Beneficiary
            'beneficiary_category' => 'required|string|max:255',
            'beneficiary_id_no' => 'required|string|max:100',
            'beneficiary_name' => 'required|string|max:255',
            'beneficiary_sex' => 'required|in:Male,Female',
            'beneficiary_birthdate' => 'required|date',
            'beneficiary_birthplace' => 'required|string|max:255',
            'beneficiary_civil_status' => 'required|in:Single,Married,Others',
            'beneficiary_address' => 'required|string|max:255',

            // Family members
            'family_members' => 'array',
            'family_members.*.last_name' => 'required|string|max:255',
            'family_members.*.first_name' => 'required|string|max:255',
            'family_members.*.middle_name' => 'required|string|max:255',
            'family_members.*.sex' => 'required|in:Male,Female',
            'family_members.*.birthdate' => 'required|date',
            'family_members.*.civil_status' => 'required|in:Single,Married,Others',
            'family_members.*.relationship' => 'required|string|max:255',
            'family_members.*.education' => 'required|in:Elementary,High School,Senior High School,College Undergraduate,College Graduate',
            'family_members.*.occupation' => 'required|string|max:255',
            'family_members.*.income' => 'required|in:less_10k,10k_20k,20k_50k,50k_100k,above_100k',
        ]);

        $generalInfoData = [
            'user_id' => Auth::id(),
            'scholarship_id' => $id,
            'client_name' => $validated['client_name'],
            'sex' => $validated['client_sex'],
            'age' => $validated['client_age'],
            'birth_date' => $validated['client_birthdate'],          
            'civil_status' => $validated['client_civil_status'],
            'birth_place' => $validated['client_birthplace'],
            'address' => $validated['client_address'],
            'contact_number' => $validated['client_contact'],
            'relationship_to_beneficiary' => $validated['client_relationship'],
            'religion' => $validated['client_religion'],
            'nationality' => $validated['client_nationality'],
            'education_level' => $validated['client_education'],
            'philhealth_no' => $validated['client_philhealth'],
            'occupation' => $validated['client_occupation'],
            'income_range' => $validated['client_income'],
            'mode_of_admission' => $validated['client_admission_mode'],
            'referring_party' => $validated['client_referring_party'],
            'referring_contact' => $validated['client_referring_contact'],

            // Beneficiary
            'beneficiary_category' => $validated['beneficiary_category'],
            'beneficiary_id_no' => $validated['beneficiary_id_no'],
            'beneficiary_name' => $validated['beneficiary_name'],
            'beneficiary_sex' => $validated['beneficiary_sex'],
            'beneficiary_birth_date' => $validated['beneficiary_birthdate'],
            'beneficiary_birth_place' => $validated['beneficiary_birthplace'],
            'beneficiary_civil_status' => $validated['beneficiary_civil_status'],
            'beneficiary_address' => $validated['beneficiary_address'],
        ];

        GeneralInfo::create($generalInfoData);

        if (!empty($validated['family_members'])) {
            foreach ($validated['family_members'] as $member) {
                FamilyMember::create([
                    'user_id' => Auth::id(),
                    'last_name' => $member['last_name'],
                    'first_name' => $member['first_name'],
                    'middle_name' => $member['middle_name'],
                    'sex' => $member['sex'],
                    'birthdate' => $member['birthdate'],
                    'civil_status' => $member['civil_status'],
                    'relationship' => $member['relationship'],
                    'education' => $member['education'],
                    'occupation' => $member['occupation'],
                    'income' => $member['income'],
                ]);
            }
        }

        return redirect()->route('scholarship.upload', ['id' => $id])->with('success', 'General information saved successfully!');
    }

    public function storeFileUpload(Request $request, $id) 
    {
        $validated = $request->validate([
            'school_registration_form' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'barangay_clearance' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'certificate_of_indigency' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'school_id_front' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'school_id_back' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'cedula' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'breakdown_of_expenses' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $paths = [
            'school_registration_form' => $request->file('school_registration_form')->store('uploads/school_forms', 'public'),
            'barangay_clearance' => $request->file('barangay_clearance')->store('uploads/barangay_clearances', 'public'),
            'certificate_of_indigency' => $request->file('certificate_of_indigency')->store('uploads/indigency_certificates', 'public'),
            'school_id_front' => $request->file('school_id_front')->store('uploads/school_ids', 'public'),
            'school_id_back' => $request->file('school_id_back')->store('uploads/school_ids', 'public'),
            'cedula' => $request->file('cedula')->store('uploads/cedulas', 'public'),
            'breakdown_of_expenses' => $request->file('breakdown_of_expenses')->store('uploads/expenses', 'public'),
        ];

        FileUpload::create([
            'user_id' => Auth::id(),
            'scholarship_id' => $id,
            'school_registration_form' => $paths['school_registration_form'],
            'barangay_clearance' => $paths['barangay_clearance'],
            'certificate_of_indigency' => $paths['certificate_of_indigency'],
            'school_id_front' => $paths['school_id_front'],
            'school_id_back' => $paths['school_id_back'],
            'cedula' => $paths['cedula'],
            'breakdown_of_expenses' => $paths['breakdown_of_expenses'],
        ]);

        return redirect()->route('scholarship')->with('success', 'Files uploaded successfully!');
    }

}
