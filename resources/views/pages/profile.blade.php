@extends('layouts.app')

@section('maincontent')

<section class="min-h-[calc(100vh-80px)] flex flex-col items-center justify-center my-8 md:my-20">

  <div class="w-[90%] lg:w-3/4 flex flex-col gap-5 md:gap-10">

    {{-- USER PROFILE --}}
    <div class="bg-white w-full rounded-3xl shadow-lg p-8 md:p-10 border relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-transparent opacity-70"></div>
      <div class="relative flex flex-col md:flex-row items-center md:items-start gap-6">
        <div class="flex-shrink-0">
          <div class="w-32 h-32 rounded-full bg-gradient-to-br from-[#4f46e5] to-[#6366f1] flex items-center justify-center text-white responsive-text-2xl font-bold shadow-md">
            {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) ?? 'U' }}
          </div>
        </div>
        <div class="flex flex-col w-full text-center md:text-left">
          <h2 class="responsive-text-xl font-bold text-[#282740]">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
          <p class="text-gray-600 mt-1 responsive-text-xs">Account Code: <span class="text-blue-600 font-semibold">{{ Auth::user()->account_code }}</span></p>
          <p class="text-gray-600 responsive-text-xs">Email: <span>{{ Auth::user()->email }}</span></p>
          <p class="text-gray-600 responsive-text-xs">Phone: <span>{{ Auth::user()->phone_number }}</span></p>
          <p class="text-gray-600 responsive-text-xs">Address: <span>{{ Auth::user()->full_address }}</span></p>
          <p class="text-gray-600 responsive-text-xs">Gender: <span>{{ Auth::user()->gender }}</span></p>
          <p class="text-gray-600 responsive-text-xs">Birthday: <span>{{ \Carbon\Carbon::parse(Auth::user()->birthday)->format('F d, Y') }}</span></p>
        </div>
      </div>
    </div>

    {{-- SCHOLARSHIP APPLICATIONS --}}
    <div class="w-full bg-white rounded-3xl shadow-[0_10px_40px_rgba(79,70,229,0.15)] p-8 md:p-10 border border-[#4f46e5]/30 hover:shadow-[0_10px_50px_rgba(79,70,229,0.3)] transition-all duration-500">
      <h3 class="responsive-text-large font-bold text-[#282740] mb-6 text-center md:text-left flex items-center gap-3">
        <img src="{{ asset('assets/images/ss-logo.png') }}" class="h-10 w-10 rounded-full bg-white border border-[#4f46e5]/30 shadow-sm"> My Scholarship Applications
      </h3>

      <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full table-auto border-collapse">
          <thead>
            <tr class="bg-[#4f46e5] text-white text-left">
              <th class="px-6 py-3 rounded-tl-lg responsive-text-small">Scholarship Name</th>
              <th class="px-6 py-3 responsive-text-small">Status</th>
              <th class="px-6 py-3 rounded-tr-lg text-center responsive-text-small">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($applications as $app)
              <tr class="border-b border-gray-200 hover:bg-indigo-50 transition">
                <td class="px-6 py-4 font-medium text-gray-800 responsive-text-xs">{{ $app->scholarship->title }}</td>
                <td class="px-6 py-4">
                  <span class="{{ 
                    $app->progress === 'Approved' ? 'bg-green-100 text-green-700' : 
                    ($app->progress === 'Rejected' ? 'bg-red-100 text-red-700' : 
                    ($app->progress === 'Requires Revision' ? 'bg-yellow-100 text-yellow-700' : 
                    'bg-blue-100 text-blue-700')) 
                  }} px-3 py-1 rounded-full responsive-text-xs font-medium text-nowrap shadow-sm">
                    {{ $app->progress }}
                  </span>
                </td>
                <td class="px-6 py-4 text-center">
                  <a href="{{ route('scholarship.progress', ['id' => $app->scholarship->id]) }}" class="bg-[#4f46e5] hover:bg-[#3730a3] text-white px-5 py-2 rounded-lg responsive-text-xs shadow transition">View</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center py-6 text-gray-500">
                  <img src="{{ asset('assets/images/empty-search.jpg') }}" alt="No scholarships found" class="w-60 h-60 object-contain mx-auto mb-4">
                  <p class="responsive-text-small">No scholarship applications found.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="md:hidden space-y-4">
        @forelse ($applications as $app)
          <div class="border border-gray-200 rounded-xl p-4 shadow-sm bg-gradient-to-tr from-indigo-50 to-white">
            <p class="responsive-text-medium font-semibold text-gray-800">{{ $app->scholarship->title ?? 'Unknown' }}</p>
            <p class="responsive-text-small text-gray-600 mt-1">
              Status: <span class="{{ 
                $app->progress === 'Approved' ? 'bg-green-100 text-green-700' : 
                ($app->progress === 'Rejected' ? 'bg-red-100 text-red-700' : 
                ($app->progress === 'Requires Revision' ? 'bg-yellow-100 text-yellow-700' : 
                'bg-blue-100 text-blue-700')) 
              }} px-2 py-0.5 rounded-full responsive-text-xs font-medium text-nowrap">
                {{ $app->progress }}
              </span>
            </p>
            <div class="mt-3 flex justify-end">
              <a href="{{ route('scholarship.progress', ['id' => $app->scholarship->id]) }}" class="bg-[#4f46e5] hover:bg-[#3730a3] text-white px-4 py-2 rounded-lg responsive-text-small shadow">View</a>
            </div>
          </div>
        @empty
          <div class="text-center py-10 text-gray-500">
            <img src="{{ asset('assets/images/empty-search.jpg') }}" alt="No scholarships found" class="w-48 h-48 object-contain mx-auto mb-4 max-w-full sm:w-64 sm:h-64">
            <p class="responsive-text-small">No scholarship applications yet.</p>
          </div>
        @endforelse
      </div>
    </div>

    {{-- GENERAL INFO + FAMILY MEMBERS --}}
    <div class="w-full flex flex-col gap-5 md:gap-10">

      {{-- General Info Card --}}
      <div class="bg-white rounded-3xl shadow-lg overflow-hidden border transition-all duration-300">
        <button class="w-full flex justify-between items-center p-6 text-left responsive-text-large font-semibold text-[#282740] hover:bg-gray-50 transition toggle-section" data-target="generalInfo">
          <span>General Information</span>
          <svg class="w-6 h-6 text-gray-500 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div id="generalInfo" class="p-8 overflow-x-auto border-t hidden">
          @if ($generalInfo)
            <table class="min-w-full responsive-text-xs border-collapse">
              <tbody class="text-gray-700">
                <tr><td class="font-medium pr-4 py-1">Client Name:</td><td>{{ $generalInfo->client_name }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Sex:</td><td>{{ $generalInfo->sex }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Age:</td><td>{{ $generalInfo->age }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Birth Date:</td><td>{{ $generalInfo->birth_date }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Birth Place:</td><td>{{ $generalInfo->birth_place }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Address:</td><td>{{ $generalInfo->address }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Contact No.:</td><td>{{ $generalInfo->contact_number }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Civil Status:</td><td>{{ $generalInfo->civil_status }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Religion:</td><td>{{ $generalInfo->religion }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Nationality:</td><td>{{ $generalInfo->nationality }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Education Level:</td><td>{{ $generalInfo->education_level }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Occupation:</td><td>{{ $generalInfo->occupation }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Income Range:</td><td>{{ ucfirst(str_replace('_',' ',$generalInfo->income_range)) }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Mode of Admission:</td><td>{{ $generalInfo->mode_of_admission }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Referring Party:</td><td>{{ $generalInfo->referring_party }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Referring Contact:</td><td>{{ $generalInfo->referring_contact }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Category:</td><td>{{ $generalInfo->beneficiary_category }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary ID No.:</td><td>{{ $generalInfo->beneficiary_id_no }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Name:</td><td>{{ $generalInfo->beneficiary_name }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Sex:</td><td>{{ $generalInfo->beneficiary_sex }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Birth Date:</td><td>{{ $generalInfo->beneficiary_birth_date }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Address:</td><td>{{ $generalInfo->beneficiary_address }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Birth Place:</td><td>{{ $generalInfo->beneficiary_birth_place }}</td></tr>
                <tr><td class="font-medium pr-4 py-1">Beneficiary Civil Status:</td><td>{{ $generalInfo->beneficiary_civil_status }}</td></tr>
              </tbody>
            </table>
          @else
            <p class="text-gray-500 responsive-text-small">No general information available.</p>
          @endif
        </div>
      </div>

      {{-- Family Members Card --}}
      <div class="bg-white rounded-3xl shadow-lg overflow-hidden border transition-all duration-300">
        <button class="w-full flex justify-between items-center p-6 text-left responsive-text-large font-semibold text-[#282740] hover:bg-gray-50 transition toggle-section" data-target="familyMembers">
          <span>Family Members</span>
          <svg class="w-6 h-6 text-gray-500 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <div id="familyMembers" class="p-8 overflow-x-auto border-t hidden">
          @if ($familyMembers->count() > 0)
            <table class="min-w-full responsive-text-xxs border-collapse">
              <thead class="bg-blue-600 text-white">
                <tr>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Full Name</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Sex</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Birthdate</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Civil Status</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Relationship</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Education</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Occupation</th>
                  <th class="px-4 py-2 text-left responsive-text-xs md:responsive-text-small">Income</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($familyMembers as $member)
                  <tr class="border-b border-gray-200">
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->sex }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ \Carbon\Carbon::parse($member->birthdate)->format('F d, Y') }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->civil_status }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->relationship }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->education }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ $member->occupation }}</td>
                    <td class="px-4 py-2 responsive-text-xs">{{ ucfirst(str_replace('_','-',$member->income)) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <p class="text-gray-500 responsive-text-small">No family members recorded.</p>
          @endif
        </div>
      </div>

    </div>

    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST" class="w-full flex justify-center md:justify-end">
      @csrf
      <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg responsive-text-small shadow-md transition cursor-pointer">
        Logout
      </button>
    </form>

  </div>

</section>

@endsection

@section('scripts')

  @vite(['resources/js/pages/profile.js'])

@endsection
