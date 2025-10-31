@extends('layouts.app')

@section('maincontent')

<section class="relative w-full flex items-center justify-center bg-gray-200 min-h-[350px] md:min-h-[700px] lg:min-h-[calc(100vh-80px)] overflow-hidden">

  <!-- Carousel Background -->
  <div id="wrapper-home" class="absolute inset-0 flex transition-transform duration-700 ease-in-out w-[300%] h-full">
    <img src="{{ asset('assets/images/parish.jpg') }}" class="w-1/3 h-full object-cover" alt="Banner 1">
    <img src="{{ asset('assets/images/municipality.jpg') }}" class="w-1/3 h-full object-cover" alt="Banner 2">
    <img src="{{ asset('assets/images/cattle-trading.jpg') }}" class="w-1/3 h-full object-cover" alt="Banner 3">
  </div>

  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/40"></div>

  <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 md:px-20 space-y-4 m-10">
    <h1 class="responsive-text-2xl md:responsive-text-3xl font-bold text-white">
      Free <span class="text-blue-600">Scholarship</span> For Every Bright Student
    </h1>
    <p class="max-w-md md:max-w-lg lg:max-w-3xl text-gray-200 responsive-text-small md:responsive-text-medium">
      Join our scholarship program to support and reward deserving students. 
      Discover how you can apply and take your next step toward a brighter future.
    </p>

    <div class="flex flex-col sm:flex-row gap-3 mt-4">
      <a href="{{ route('scholarship') }}" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md transition responsive-text-xs md:responsive-text-small text-center">
        Apply Scholarship
      </a>
      <a href="{{ route('register') }}" 
        class="border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg shadow-md transition responsive-text-xs md:responsive-text-small text-center">
        Register
      </a>
    </div>
  </div>

  <button id="previous-pic-btn" class="absolute left-3 top-1/2 -translate-y-1/2 text-3xl text-white cursor-pointer z-10">&#10094;</button>
  <button id="next-pic-btn" class="absolute right-3 top-1/2 -translate-y-1/2 text-3xl text-white cursor-pointer z-10">&#10095;</button>

</section>

<div class="bg-[#282740] py-10 md:py-20 flex justify-center items-center flex-col text-center border-y-2 border-gray-700">
  <h1 class="responsive-text-2xl md:responsive-text-3xl text-white mx-10 md:mx-20 text-nowrap">Need Scholarship?</h1>
  <p class="responsive-text-medium md:responsive-text-large text-gray-300 mx-10 md:mx-20">Browse through diffrent scholarhsips that the municipality of padre garcia has to offer!<a href="/scholarship" class="text-blue-400"> Here.</a></p>
</div>

<div class="w-full text-center mt-12 mb-6">
  <h2 class="responsive-text-xl font-bold text-gray-800 tracking-wide relative inline-block">
    Scholarship Posts
  </h2>
  <p class="responsive-text-small text-gray-500 mt-4">
    Discover the latest scholarship opportunities from the Municipality of Padre Garcia.
  </p>
</div>

<section class="px-6 py-10 flex items-center justify-center">

  <div id="feed" class="bg-white w-[90%] 2xl:w-3/4 mx-auto grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    
  </div>

</section>

@endsection

@section('scripts')

  @vite(['resources/js/pages/home.js'])
  
@endsection
