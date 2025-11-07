@extends('layouts.auth')

@section('maincontent')

<div style="background-image: url('{{ asset('assets/images/bg-login.jpg') }}')" class="bg-cover bg-no-repeat bg-center h-screen overflow-hidden flex items-center justify-center">

  <div class="flex flex-col md:flex-row">
    <div id="panel" class="rounded-tl-xl rounded-tr-xl md:rounded-tr-none md:rounded-bl-xl p-2 flex flex-row gap-3 items-center justify-center bg-[rgb(59,0,151)] md:flex-col md:p-3 md:gap-5">
      <img class="h-24 w-auto md:h-auto md:w-5/6" src="{{ asset('assets/images/pg-logo.png') }}" alt="Padre Garcia logo">
      <div class="flex flex-col gap-1 md:gap-3 items-center justify-center">
        <p class="animate__animated animate__fadeInLeft text-white text-base md:text-xl text-nowrap">Padre Garcia Batangas</p>
        <p class="animate__animated animate__fadeInLeft text-white text-[.5rem] md:text-sm text-nowrap">" The Cattle Trading Capital of the Philippines "</p>
      </div>
    </div>

    <div class="overflow-hidden w-xs rounded-br-xl rounded-bl-xl md:rounded-bl-none md:w-xl md:rounded-tr-xl">

      <div id="wrapper" class="flex w-[300%] transition-transform duration-700 ease-in-out" >

        {{-- Panel 1: Registration --}}
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <div class="w-full grid py-4 px-2 grid-rows-[1fr_5.5fr_30px] md:grid-rows-[1fr_3fr_70px] md:p-5">

            <div class="flex items-center justify-center flex-col gap-2 md:gap-4">
              <p class="text-2xl md:text-5xl font-bold">Get Started</p>
              <p class="text-sm md:text-base">Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in</a></p>
            </div>

            <form id="registerForm" method="POST" action="{{ route('register.store') }}" class="flex justify-center flex-col gap-2 px-2 md:gap-5 md:p-5">
              @csrf
              <div class="grid grid-cols-2 gap-2 md:gap-3">
                <input type="text" name="first_name" placeholder="First Name" class="register-input" value="{{ old('first_name') }}" required>
                <input type="text" name="last_name" placeholder="Last Name" class="register-input" value="{{ old('last_name') }}" required>

                <select name="gender" class="register-input cursor-pointer" required>
                  <option value="">Select Gender</option>
                  <option value="Male"   {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                </select>

                <input type="text" name="birthday" class="datepicker register-input w-full max-w-full" placeholder="Birthday" value="{{ old('birthday') }}" required>
              </div>

              <input type="text" name="address" placeholder="Full Address" class="register-input" value="{{ old('address') }}" required>
              <input type="email" name="email" placeholder="Email Address" class="register-input" value="{{ old('email') }}" required>
              <input type="text" name="phone" placeholder="Phone Number" class="register-input" value="{{ old('phone') }}" required>

              <div class="grid grid-cols-2 gap-2 md:gap-3">
                <input type="password" name="password" placeholder="Password" class="register-input" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="register-input" required>
              </div>

              @if ($errors->any())
                <div class="text-red-500 text-sm">
                  <ul>
                    @foreach ($errors->all() as $err)
                      <li>{{ $err }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="flex justify-center items-center">
                <button id="continueBtn" type="submit" class="border text-sm py-1 px-4 md:py-3 md:px-8 md:rounded-2xl md:text-base bg-blue-500 text-white rounded-md cursor-pointer">
                  Continue
                </button>
              </div>
            </form>
          </div>
        </div>

        {{-- Panel 2: OTP --}}
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <form id="verifyForm" action="{{ route('register.verifyOtp') }}" method="POST" class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">
            @csrf

            <div class="flex flex-col text-center gap-1 md:gap-5">
              <p class="text-lg md:text-3xl">OTP VERIFICATION</p>
              <div>
                <p class="text-[.5rem] md:text-sm">Please Enter the OTP sent to your registered phone</p>
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
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
              <input type="text" maxlength="1" class="otp-input border text-center rounded" required>
            </div>

            <input type="hidden" name="pending_id" id="pendingIdHolder" value="">

            <div class="w-3xs gap-1 md:w-sm h-[15%] flex flex-col md:gap-2">
              <button type="submit" id="verify-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-white bg-blue-500">Verify</button>
              <button type="button" id="back-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-blue-500">Back</button>
            </div>
          </form>
        </div>

        {{-- Panel 3: Done --}}
        <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">
          <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">
            <div class="flex flex-col text-center">
              <p class="text-lg md:text-3xl">User ID: <span id="accountCodeText" class="text-blue-500">--</span></p>
            </div>
            <div class="h-32 md:h-64">
              <img class="h-full" src="{{ asset('assets/images/otp-success.png') }}" alt="OTP success">
            </div>
            <div class="flex flex-col text-center gap-1 mb-10 md:mb-5 md:gap-5">
              <p class="text-lg md:text-3xl">VERIFIED</p>
              <p class="text-[.5rem] md:text-sm">Your account has been verified successfully</p>
            </div>
            <div class="w-3xs md:w-sm h-[7.5%] flex flex-col">
              <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-center responsive-text-small">Done</a>
            </div>
          </div>
        </div>

      </div><!-- /wrapper -->
    </div>
  </div>
</div>

@endsection

@section('scripts')

  @vite(['resources/js/auth/register.js'])
  
@endsection
