@extends('layouts.app')

@section('maincontent')

<div class="flex flex-col justify-center items-center my-8 md:my-20">
  <div class="w-[90%] lg:w-3/4 ">

    <div class="flex items-start mb-4">
      <a href="{{ route('scholarship.create', ['id' => $scholarship->id]) }}" class="cursor-pointer border border-gray-300 responsive-text-xs text-gray-600 hover:text-black py-1 px-2">
        ← Back
      </a>
    </div>

    <h1 class="font-semibold mb-6 responsive-text-xl text-center">
      Educational Assistance File Upload
    </h1>

    <p class="text-gray-600 mb-6 responsive-text-small text-center">
      Please upload clear scanned or photo copies of the following required documents.
    </p>
    
    <form action="{{ route('scholarship.fileupload', ['id' => $scholarship->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="space-y-4 border rounded-xl p-6">
      
        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">1. School Registration Form</p>
          <input name="school_registration_form" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">2. Barangay Clearance</p>
          <input name="barangay_clearance" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">3. Certificate of Indigency</p>
          <input name="certificate_of_indigency" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">4. Back-to-Back School ID (Front)</p>
          <input name="school_id_front" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">4. Back-to-Back School ID (Back)</p>
          <input name="school_id_back" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">5. Cedula</p>
          <input name="cedula" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

        <div class="border p-4 shadow-sm">
          <p class="font-medium mb-2 responsive-text-small">6. Breakdown of Expenses Worth ₱5,000 & Above</p>
          <input name="breakdown_of_expenses" type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" required/>
        </div>

      </div>

      <div class="mt-8 flex justify-end">
        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 responsive-text-small">
          Submit
        </button>
      </div>

    </form>
    
  </div>
</div>

@endsection