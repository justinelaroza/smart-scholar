@extends('layouts.auth')

@section('maincontent')

  <div style="background-image: url('{{ asset('assets/images/bg-login.jpg') }}')" class="bg-cover bg-no-repeat bg-center min-h-screen flex items-center justify-center">
    
    <div class="flex flex-col md:flex-row">

      <div id="panel" class="rounded-tl-xl rounded-tr-xl md:rounded-tr-none md:rounded-bl-xl p-2 flex flex-row gap-3 items-center justify-center bg-[rgb(59,0,151)] md:flex-col md:p-3 md:gap-5">
        
        <img class="h-24 w-auto md:h-auto md:w-5/6" src="{{ asset('assets/images/pg-logo.png') }}" alt="Padre Garcia logo">
        
        <div class="flex flex-col gap-1 md:gap-3 items-center justify-center">
          <p class="animate__animated animate__fadeInLeft text-white text-base md:text-xl text-nowrap">Padre Garcia Batangas</p>
          <p class="animate__animated animate__fadeInLeft text-white text-[.5rem] md:text-sm text-nowrap">" The Cattle Trading Capital of the Philippines "</p>
        </div>

      </div>

      <div class="overflow-hidden w-xs rounded-br-xl rounded-bl-xl md:rounded-bl-none md:w-xl md:rounded-tr-xl ">

        <div id="wrapper" class="flex w-[300%] transition-transform duration-700 ease-in-out">

          <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

            <div class="w-full flex flex-col justify-center items-center gap-3 p-3 md:gap-5 md:p-5">

              <div class="flex items-center justify-center flex-col gap-2 md:gap-4">
                <p class="text-2xl md:text-5xl font-bold">Forgot Password</p>
                <p class="text-sm md:text-base">Remember Account? <a href="{{ route('login') }}" class="text-blue-500">Log in</a> </p>
              </div>

              <div class="flex items-center justify-center">
                <img src="{{ asset('assets/images/forgot-pass.png') }}" alt="Forgot password?" class="h-24 md:h-56">
              </div>

              <div class="text-center text-[.5rem] md:text-sm text-gray-500">
                <p>Don't worry! Enter your registered</p>
                <p>phone number to receive a password otp reset sms</p>
              </div>
              
              <div class="flex w-[14rem] gap-1 md:gap-2 flex-col md:w-sm">
                <input type="text" placeholder="Registered Number" class="register-input">
                <input type="password" placeholder="Password" class="register-input">
                <input type="password" placeholder="Confirm Password" class="register-input">
              </div>

              <div class="flex justify-center items-center">
                  <button id="continue-btn" class="border text-sm py-1 px-4 md:py-3 md:px-8 md:rounded-2xl md:text-base bg-blue-500 text-white rounded-md cursor-pointer">Continue</button>
              </div>

            </div>

          </div>

          <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

            <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">

              <div class="flex flex-col text-center gap-1 md:gap-5">
                <p class="text-lg md:text-3xl">OTP VERIFICATION</p>
                <div>
                  <p class="text-[.5rem] md:text-sm">Please Enter the OTP (One-Time Password) sent to your </p>
                  <p class="text-[.5rem] md:text-sm">registered phone number to complete your verification</p>
                </div>
              </div>

              <div class="h-32 md:h-64">
                <img class="h-full" src="{{ asset('assets/images/otp-sent.png') }}" alt="OTP sent">
              </div>

              <div class="flex justify-between items-center w-3xs md:w-sm">
                <p class="text-[.5rem] md:text-xs">Remaining time: <span class="text-blue-500">00:59s</span></p>
                <p class="text-[.5rem] md:text-xs">Didn’t get the code? <span class="text-blue-500 cursor-pointer">Resend</span></p>
              </div>

              <div class="w-3xs h-10 gap-1 mb-4 md:w-sm md:h-16 flex md:gap-2 md:mb-8">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
                <input type="text" maxlength="1" class="otp-input">
              </div>
              <div class="w-3xs gap-1 md:w-sm h-[15%] flex flex-col md:gap-2">
                <button id="verify-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-white bg-blue-500">Verify</button>
                <button id="back-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-blue-500">Back</button>
              </div>
              
            </div>
          
          </div>

          <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

            <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">

              <div class="h-32 md:h-64">
                <img class="h-full" src="{{ asset('assets/images/otp-success.png') }}" alt="OTP success">
              </div>

              <div class="flex flex-col text-center gap-1 mb-10 md:mb-5 md:gap-5">
                <p class="text-lg md:text-3xl">Password successfully changed</p>
                <p class="text-[.5rem] md:text-sm">Please use your new password next time you log in</p>
              </div>

              <div class="w-3xs md:w-sm h-[7.5%] flex flex-col">
                <button id="done-btn" class="cursor-pointer border h-full rounded-xl text-sm md:text-base md:rounded-2xl text-white bg-blue-500">Done</button>
              </div>

            </div>
          
          </div>

        </div>

      </div>
    
    </div>

  </div>

@endsection