@extends('layouts.auth')

@section('maincontent')

<div style="background-image: url('{{ asset('assets/images/bg-login.jpg') }}')" class="bg-cover bg-no-repeat bg-center min-h-dvh flex items-center justify-center">
  
  <div class="flex flex-col md:flex-row md:max-w-[95%]">

    <!-- Left Branding Panel -->
    <div id="panel" class="rounded-tl-xl rounded-tr-xl md:rounded-tr-none md:rounded-bl-xl p-2 flex flex-row gap-3 items-center justify-center bg-[rgb(59,0,151)] md:flex-col md:p-3 md:gap-5">
      <img class="h-24 w-auto md:h-auto md:w-5/6" src="{{ asset('assets/images/pg-logo.png') }}" alt="Padre Garcia logo">
      <div class="flex flex-col gap-1 md:gap-3 items-center justify-center">
        <p class="animate__animated animate__fadeInLeft text-white responsive-text-medium text-nowrap">Padre Garcia Batangas</p>
        <p class="animate__animated animate__fadeInLeft text-white responsive-text-xxs text-nowrap">" The Cattle Trading Capital of the Philippines "</p>
      </div>
    </div>

    <!-- Right Multi-Step Wrapper -->
    <div class="overflow-hidden w-xs rounded-br-xl rounded-bl-xl md:rounded-bl-none md:w-xl md:rounded-tr-xl">
      <div id="wrapper" class="flex w-[300%] transition-transform duration-700 ease-in-out">

        <!-- STEP 1: FORGOT FORM -->
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <form id="forgotForm" action="{{ route('forgot-pass.update') }}" method="POST" class="w-full flex flex-col justify-center items-center gap-3 p-3 md:gap-5 md:p-5">
            @csrf

            <div class="flex items-center justify-center flex-col gap-2 md:gap-4">
              <p class="font-bold responsive-text-2xl md:responsive-text-3xl">Forgot Password</p>
              <p class="responsive-text-small">Remember Account? 
                <a href="{{ route('login') }}" class="text-blue-500">Log in</a>
              </p>
            </div>

            <div class="flex items-center justify-center">
              <img src="{{ asset('assets/images/forgot-pass.png') }}" alt="Forgot password?" class="h-24 md:h-56">
            </div>

            <div class="text-center text-gray-500 responsive-text-xxs md:responsive-text-small">
              <p>Don't worry! Enter your registered</p>
              <p>phone number to receive a password reset OTP SMS.</p>
            </div>

            <div class="flex w-[14rem] gap-1 md:gap-2 flex-col md:w-sm">
              <input type="text" name="phone" placeholder="Registered Number" class="register-input" required>
              <input type="password" name="password" placeholder="New Password" class="register-input" required>
              <input type="password" name="password_confirmation" placeholder="Confirm Password" class="register-input" required>
            </div>

            <div class="flex justify-center items-center">
              <button id="continue-btn" type="submit" class="border responsive-text-xs py-1 px-4 md:py-3 md:px-8 md:rounded-2xl bg-blue-500 text-white rounded-md cursor-pointer mb-3">Continue</button>
            </div>
          </form>
        </div>

        <!-- STEP 2: OTP VERIFICATION -->
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <form id="verifyForm" action="{{ route('forgot-pass.verifyOtp') }}" method="POST" class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">
            @csrf

            <div class="flex flex-col text-center gap-1 md:gap-5">
              <p class="responsive-text-large md:responsive-text-2xl">OTP VERIFICATION</p>
              <div>
                <p class="responsive-text-xxs md:responsive-text-small">Please Enter the OTP (One-Time Password) sent to your</p>
                <p class="responsive-text-xxs md:responsive-text-small">registered phone number to complete verification.</p>
              </div>
            </div>

            <div class="h-32 md:h-64">
              <img class="h-full" src="{{ asset('assets/images/otp-sent.png') }}" alt="OTP sent">
            </div>

            <div class="w-3xs h-10 gap-1 mb-4 md:w-sm md:h-16 flex md:gap-2 md:mb-8">
              <input type="text" maxlength="1" class="otp-input" required>
              <input type="text" maxlength="1" class="otp-input" required>
              <input type="text" maxlength="1" class="otp-input" required>
              <input type="text" maxlength="1" class="otp-input" required>
              <input type="text" maxlength="1" class="otp-input" required>
              <input type="text" maxlength="1" class="otp-input" required>
            </div>

            <div class="w-3xs gap-1 md:w-sm h-[15%] flex flex-col md:gap-2">
              <button id="verify-btn" type="submit" class="cursor-pointer border h-1/2 rounded-xl responsive-text-xs md:responsive-text-small md:rounded-2xl text-white bg-blue-500">Verify</button>
              <button id="back-btn" type="button" class="cursor-pointer border h-1/2 rounded-xl responsive-text-xs md:responsive-text-small md:rounded-2xl text-blue-500">Back</button>
            </div>
          </form>
        </div>

        <!-- STEP 3: SUCCESS -->
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">
            <div class="h-32 md:h-64">
              <img class="h-full" src="{{ asset('assets/images/otp-success.png') }}" alt="OTP success">
            </div>

            <div class="flex flex-col text-center gap-1 mb-10 md:mb-5 md:gap-5">
              <p class="responsive-text-large md:responsive-text-2xl">Password successfully changed</p>
              <p class="responsive-text-xxs md:responsive-text-small">Please use your new password next time you log in.</p>
            </div>

            <div class="w-3xs md:w-sm h-[7.5%] flex flex-col">
              <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-center responsive-text-small">Done</a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')
  @vite(['resources/js/auth/forgot-pass.js'])
@endsection
