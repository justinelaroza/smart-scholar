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

<div class="bg-gray-100 py-10 md:py-20 flex justify-center items-center flex-col text-center">
  <h1 class="responsive-text-2xl md:responsive-text-3xl text-gray-900 mx-10 md:mx-20 text-nowrap">Need Scholarship?</h1>
  <p class="responsive-text-medium md:responsive-text-large text-gray-700 mx-10 md:mx-20">
    Browse through different scholarships that the Municipality of Padre Garcia has to offer!
    <a href="/scholarship" class="text-blue-600 hover:text-blue-800 transition"> Here.</a>
  </p>
</div>

<section class="bg-white py-16 flex flex-col items-center text-center px-6 md:px-16 border-y border-gray-200">
  <h2 class="responsive-text-xl font-bold text-[#282740] mb-10">
    How to Apply for a <span class="text-blue-600">Scholarship</span>
  </h2>

  <div class="grid gap-12 sm:grid-cols-1 md:grid-cols-3 max-w-6xl">

    <div class="flex flex-col items-center px-4">
      <div class="bg-blue-100 text-blue-600 p-6 rounded-full mb-5 shadow-md">
        <i class="fa-solid fa-user-plus responsive-text-large"></i>
      </div>
      <h3 class="responsive-text-medium font-semibold text-[#282740] mb-3">1. Register</h3>
      <p class="responsive-text-small text-gray-600 max-w-sm">
        Create your account and fill in the necessary personal details to get started.
      </p>
    </div>

    <div class="flex flex-col items-center px-4">
      <div class="bg-blue-100 text-blue-600 p-6 rounded-full mb-5 shadow-md">
        <i class="fa-solid fa-file-pen responsive-text-large"></i>
      </div>
      <h3 class="responsive-text-medium font-semibold text-[#282740] mb-3">2. Apply</h3>
      <p class="responsive-text-small text-gray-600 max-w-sm">
        Browse the available scholarships and submit your application online easily.
      </p>
    </div>

    <div class="flex flex-col items-center px-4">
      <div class="bg-blue-100 text-blue-600 p-6 rounded-full mb-5 shadow-md">
        <i class="fa-solid fa-graduation-cap responsive-text-large"></i>
      </div>
      <h3 class="responsive-text-medium font-semibold text-[#282740] mb-3">3. Achieve</h3>
      <p class="responsive-text-small text-gray-600 max-w-sm">
        Wait for the results and start your journey as one of Padre Garcia’s scholars.
      </p>
    </div>

  </div>
</section>

<section class="relative bg-gray-100 overflow-hidden w-full flex flex-col 2xl:flex-row items-center justify-center gap-5 md:gap-14 lg:gap-18 px-10 py-10 lg:py-20">

  <div class="relative w-full max-w-[650px] h-auto aspect-[4/3] translate-x-[6%] sm:translate-x-[4%] md:translate-x-0">
    <div class="relative w-full max-w-[650px] h-auto aspect-[4/3]">

      <img 
        src="{{ asset('assets/images/municipality.jpg') }}" 
        alt="Municipality" 
        class="absolute bottom-[0%] left-0 w-[45%] sm:w-[48%] md:w-[50%] 2xl:w-[55%] aspect-[3/4] object-cover rounded-3xl shadow-2xl rotate-[-8deg] z-10"
      />

      <img 
        src="{{ asset('assets/images/municipality.jpg') }}" 
        alt="Graduate" 
        class="absolute bottom-[0%] left-[20%] sm:left-[22%] md:left-[25%] w-[47%] sm:w-[50%] md:w-[53%] 2xl:w-[58%] aspect-[3/4] object-cover rounded-3xl shadow-2xl rotate-[0deg] z-20"
      />

      <img 
        src="{{ asset('assets/images/municipality.jpg') }}" 
        alt="Scholars" 
        class="absolute bottom-[0%] left-[40%] sm:left-[42%] md:left-[45%] w-[49%] sm:w-[52%] md:w-[55%] 2xl:w-[60%] aspect-[3/4] object-cover rounded-3xl shadow-2xl rotate-[8deg] z-30"
      />
    </div>
  </div>

  <div class="w-full 2xl:w-1/2 text-gray-700 pl-0 2xl:pl-6 mt-12 2xl:mt-0 text-center 2xl:text-left">
    <h2 class="text-[#282740] font-extrabold leading-tight responsive-text-2xl mb-6 lg:ml-20">
      Empowering Future Leaders
    </h2>

    <div class="lg:ml-20">
      <p class="text-gray-600 responsive-text-small leading-relaxed mb-4 max-w-xl mx-auto 2xl:mx-0">
        The Padre Garcia Scholarship Program is dedicated to nurturing talented and deserving students. 
        We believe that financial barriers should never hinder anyone from achieving their dreams.
      </p>
    </div>
    
    <div class="lg:ml-20">
      <p class="text-gray-600 responsive-text-small leading-relaxed mb-8 max-w-xl mx-auto 2xl:mx-0">
        Through our support, we aim to build a community of scholars who will one day give back 
        and make a difference in our municipality and beyond.
      </p>
    </div>

    <a href="{{ route('about') }}" 
       class="inline-block bg-[#282740] hover:bg-blue-700 text-white px-8 py-3 rounded-lg shadow-md transition font-semibold responsive-text-xs lg:ml-20">
      Learn More About Our Mission
    </a>
  </div>

</section>

<div class="w-full text-center bg-[#282740] py-10 md:py-20 border-y-2 border-gray-700">
  <h2 class="responsive-text-xl font-bold text-white tracking-wide relative inline-block mx-10 md:mx-20">
    Scholarship Posts
  </h2>
  <p class="responsive-text-small text-gray-300 mt-4 mx-10 md:mx-20">
    Discover the latest scholarship opportunities from the Municipality of Padre Garcia.
  </p>
</div>

<section class="px-6 py-16 flex items-center justify-center bg-gray-100">
  <div id="feed" class="w-[95%] 2xl:w-3/4 mx-auto grid gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    
  </div>
</section>

@endsection

@section('scripts')

  @vite(['resources/js/pages/home.js'])
  
@endsection
