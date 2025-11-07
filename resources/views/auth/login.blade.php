@extends('layouts.auth')

@section('maincontent')

<div style="background-image: url('{{ asset('assets/images/bg-login.jpg') }}')" class="bg-cover bg-no-repeat bg-center h-screen overflow-hidden flex items-center justify-center">

  <div class="grid grid-cols-1 w-xs justify-center items-center gap-5 p-10 border-1 bg-white rounded-sm md:rounded-md md:grid-rows-none md:grid-cols-[250px_1fr] md:w-2xl md:h-96 md:gap-10">
    
    <div class="flex justify-center items-center">
      <img src="{{ asset('assets/images/pg-logo.png') }}" alt="Padre Garcia logo" class="max-w-45 md:w-3xs md:max-w-none">
    </div>

    <div>

      {{-- LOGIN FORM --}}
      <form id="loginForm" class="flex flex-col justify-center items-center" method="POST" action="{{ route('login.authenticate') }}">
        @csrf

        <div class="flex flex-col w-full mb-2 gap-2 md:gap-3 md:mb-3">
          <input type="text" name="account_code" placeholder="Account ID" class="login-input" value="{{ old('account_code') }}" required>
          <input type="password" name="password" placeholder="Password" class="login-input" required>
        </div>

        <div class="flex justify-between items-center w-full mb-3 md:mb-5">
          <div class="flex justify-center items-center gap-1">
            <input id="remember" type="checkbox" name="remember" class="border cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="text-[.6rem] responsive-text-xs">Remember me</label>
          </div>
          <a href="{{ route('forgot-pass') }}" class="text-[.6rem] text-blue-600 responsive-text-xs">Forgot Password?</a>
        </div>

        <div class="w-full flex flex-col items-center justify-center gap-3 md:gap-4">
          <button id="loginBtn" type="submit" class="text-lg md:rounded-md bg-blue-500 text-white w-2/3 md:w-3/5 py-2 md:py-3 rounded-sm cursor-pointer">
            Login
          </button>
          
          <p class="text-base">Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-700">Register</a>
          </p>
        </div>
      </form>

    </div>
    
  </div>
  
</div>

@endsection

@section('scripts')

  @vite(['resources/js/auth/login.js'])

@endsection
