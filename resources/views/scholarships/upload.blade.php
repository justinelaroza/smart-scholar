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

    <div class="space-y-4 border rounded-xl p-6">

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">1. School Registration Form</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">2. Barangay Clearance</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">3. Certificate of Indigency</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">4. Back-to-Back School ID (Front)</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">4. Back-to-Back School ID (Back)</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">5. Cedula</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

      <div class="border p-4 shadow-sm">
        <p class="font-medium mb-2 responsive-text-small">6. Breakdown of Expenses Worth ₱5,000 & Above</p>
        <input type="file" class="w-full border rounded-lg p-2 responsive-text-xs bg-gray-200" />
      </div>

    </div>

    <div class="mt-8 flex justify-end">
      <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 responsive-text-small">
        Submit
      </button>
    </div>

  </div>
</div>

@endsection