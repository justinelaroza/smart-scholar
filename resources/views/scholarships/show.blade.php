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
      Educational Assistance Scholarship
    </h1>

    <div class="flex flex-col md:flex-row gap-6 mb-6">

      <!-- LEFT SIDE -->
      <div class="md:w-[60%] p-6 rounded-lg border">
        <p class="text-gray-500 mb-3 responsive-text-xs">
          Funded by <span class="font-medium responsive-text-small">Marilyn Sy</span>
        </p>

        <div class="bg-gray-100 aspect-[16/9] flex items-center justify-center text-gray-400 mb-4 responsive-text-small overflow-hidden">
          <img src="{{ asset('assets/images/municipality.jpg') }}" class="object-cover w-full h-full">
        </div>

        <h2 class="font-semibold mb-2 responsive-text-large">
          Eligibility Requirements:
        </h2>

        <ul class="mb-4 space-y-1 responsive-text-small">
          <li class="flex items-center gap-2">
            <p><strong class="responsive-text-small">Educational Level:</strong> 1st year college</p>
          </li>
          <li class="flex items-center gap-2">
            <p><strong class="responsive-text-small">Residency:</strong> Padre Garcia Batangas</p>
          </li>
        </ul>
      </div>

      <!-- RIGHT SIDE -->
      <div class="md:w-[40%] border p-6 rounded-lg min-w-full md:min-w-0 shadow-">
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold responsive-text-large">₱150,000</p>
          <span class="text-green-600 bg-green-100 px-2 py-1 rounded responsive-text-xxs">
            OPEN
          </span>
        </div>

        <p class="mb-1 responsive-text-xs">100 participants</p>
        <p class="mb-4 responsive-text-xs">₱1,500/ea</p>

        <a href="{{ route('scholarship.create') }}" class="block w-full bg-black text-white py-2 rounded mb-2 hover:bg-gray-800 responsive-text-small text-center">
          Apply Now
        </a>

        <a href="#" class="block w-full border py-2 rounded hover:bg-gray-50 responsive-text-small text-center">
          Contact Us
        </a>

        <div class="mt-8">
          <p class="font-semibold responsive-text-small">Application Start:</p>
          <p class="text-gray-600 responsive-text-xs mb-3">September 1, 2024</p>

          <p class="font-semibold responsive-text-small">Application Deadline:</p>
          <p class="text-gray-600 responsive-text-xs">September 29, 2024</p>
        </div>
      </div>

    </div>

    <div class="md:w-full border p-6 rounded-lg">

      <h2 class="font-semibold mb-2 responsive-text-large">
          Description:
      </h2>
      <p class="text-gray-700 responsive-text-small leading-relaxed">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed 
        lacus vel metus euismod placerat. Mauris ac velit in libero 
        facilisis porttitor. Vestibulum ante ipsum primis in faucibus orci 
        luctus et ultrices posuere cubilia curae; Sed vel erat quis augue 
        cursus finibus. Suspendisse ultricies, felis a tincidunt varius, 
        erat arcu sodales eros, et dictum risus felis ut purus. Cras 
        elementum est vel justo congue, at feugiat sapien condimentum. 
        Vivamus id quam non sapien malesuada facilisis non vel mi. Nullam 
        tristique ligula vel urna imperdiet, vitae varius enim dignissim.
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur 
        cupiditate eligendi unde iusto veritatis aliquid, architecto vitae 
        totam explicabo corporis modi iure maiores fugit dolorem. Vel fugiat 
        cupiditate libero corrupti! Lorem ipsum dolor sit amet, consectetur 
        adipisicing elit. Quisquam iste aut error minima dolorum praesentium, 
        non voluptas aperiam porro nemo ullam voluptatem repudiandae optio ex alias 
        itaque impedit sint a?
      </p>

    </div>

  </div>
</div>

@endsection
