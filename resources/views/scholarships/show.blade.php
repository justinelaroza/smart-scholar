@extends('layouts.app')

@section('maincontent')

<div class="bg-white flex items-center justify-center my-8 md:my-20">
  <div class="w-[90%] lg:w-3/4">

    <div class="flex items-start mb-4">
      <a href="{{ route('scholarship') }}" class="cursor-pointer border border-gray-300 responsive-text-xs text-gray-600 hover:text-black py-1 px-2">
        ← Back
      </a>
    </div>

    <h1 class="font-semibold mb-6 responsive-text-2xl">
      {{ $scholarship->title }}
    </h1>

    <div class="flex flex-col md:flex-row gap-6 mb-6">

      <!-- LEFT SIDE -->
      <div class="md:w-[60%] p-6 rounded-lg border">
        <p class="text-gray-500 mb-3 responsive-text-xs">
          Funded by <span class="font-medium responsive-text-small">{{ $scholarship->funder }}</span>
        </p>

        <div class="bg-gray-100 aspect-[16/9] flex items-center justify-center text-gray-400 mb-4 responsive-text-small overflow-hidden">
          <img src="{{ asset($scholarship->image) }}" alt="{{ $scholarship->title }}" class="object-cover w-full h-full">
        </div>

        <h2 class="font-semibold mb-2 responsive-text-large">
          Eligibility Requirements:
        </h2>

        <ul class="mb-4 space-y-1 responsive-text-small">
          <li class="flex items-center gap-2">
            <p><strong class="responsive-text-small">Educational Level:</strong> {{ $scholarship->education_level }}</p>
          </li>
          <li class="flex items-center gap-2">
            <p><strong class="responsive-text-small">Residency:</strong> {{ $scholarship->residency_requirement }}</p>
          </li>
        </ul>
      </div>

      <!-- RIGHT SIDE -->
      <div class="md:w-[40%] border p-6 rounded-lg min-w-full md:min-w-0 shadow-">
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold responsive-text-large">₱{{ number_format($scholarship->amount, 0) }}</p>
          <span class="text-white px-2 py-1 rounded responsive-text-xxs {{ $scholarship->status === 'Open' ? 'bg-green-500' : 'bg-red-500' }}">
            {{ strtoupper($scholarship->status) }}
          </span>
        </div>

        <p class="mb-5 responsive-text-xs">Currently have: 100 participants</p>

        <a href="{{ route('scholarship.create') }}" class="block w-full bg-black text-white py-2 rounded mb-2 hover:bg-gray-800 responsive-text-small text-center">
          Apply Now
        </a>

        <a href="#" class="block w-full border py-2 rounded hover:bg-gray-50 responsive-text-small text-center">
          Contact Us
        </a>

        <div class="mt-8">
          <p class="font-semibold responsive-text-small">Application Start:</p>
          <p class="text-gray-600 responsive-text-xs mb-3">{{ \Carbon\Carbon::parse($scholarship->application_start)->format('F j, Y') }}</p>

          <p class="font-semibold responsive-text-small">Application Deadline:</p>
          <p class="text-gray-600 responsive-text-xs">{{ \Carbon\Carbon::parse($scholarship->submission_deadline)->format('F j, Y') }}</p>
        </div>
      </div>

    </div>

    <div class="md:w-full border p-6 rounded-lg">

      <h2 class="font-semibold mb-2 responsive-text-large">
          Description:
      </h2>
      <p class="text-gray-700 responsive-text-small leading-relaxed">
        {{ $scholarship->description }}
      </p>

    </div>

  </div>
</div>

@endsection
