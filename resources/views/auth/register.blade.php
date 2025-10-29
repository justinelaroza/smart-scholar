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

        @php
            $currentStep = $step ?? 'form';

            $translate =
                $currentStep === 'otp'  ? '-33.333%' :
                ($currentStep === 'done' ? '-66.666%' : '0%');
        @endphp

        <div id="wrapper" class="flex w-[300%] transition-transform duration-700 ease-in-out" style="transform: translateX({{ $translate }});">

          <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

            <div class="w-full grid py-4 px-2 grid-rows-[1fr_5.5fr_30px] md:grid-rows-[1fr_3fr_70px] md:p-5">

              <div class="flex items-center justify-center flex-col gap-2 md:gap-4">
                <p class="text-2xl md:text-5xl font-bold">Get Started</p>
                <p class="text-sm md:text-base">Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Log in</a> </p>
              </div>

             <form id="registerForm" method="POST" action="{{ route('register.step1') }}" class="flex justify-center flex-col gap-2 px-2 md:gap-5 md:p-5">
                  @csrf

                  <div class="grid grid-cols-2 gap-2 md:gap-3">
                      <input type="text" name="first_name" placeholder="First Name" class="register-input" value="{{ old('first_name') }}" required>
                      <input type="text" name="last_name" placeholder="Last Name" class="register-input" value="{{ old('last_name') }}" required>

                      <select name="gender" class="register-input cursor-pointer">
                          <option value="">Select Gender</option>
                          <option value="male"   {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                      </select>

                      <input type="date" name="birthday" class="datepicker register-input" placeholder="Birthday" value="{{ old('birthday') }}">
                  </div>
                  
                  <input type="text" name="address" placeholder="Full Address" class="register-input" value="{{ old('address') }}">
                  <input type="email" name="email" placeholder="Email Address" class="register-input" value="{{ old('email') }}">
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
                      <button
                          type="submit"
                          class="border text-sm py-1 px-4 md:py-3 md:px-8 md:rounded-2xl md:text-base bg-blue-500 text-white rounded-md cursor-pointer"
                      >
                          Continue
                      </button>
                  </div>
              </form>

            </div>

          </div>


          <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

            <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">

              <div class="flex flex-col text-center gap-1 md:gap-5">
                <p class="text-lg md:text-3xl">OTP VERIFICATION</p>
                <div>
                  <p class="text-[.5rem] md:text-sm">Please Enter the OTP (One-Time Password) sent to your </p>
                  <p class="text-[.5rem] md:text-sm">registered phone number to complete your verification</p>

                  <!-- always in DOM so JS can fill it -->
                  <p id="devOtpMessage"
                    class="text-red-500 text-xs md:text-sm font-semibold mt-2 hidden">
                  </p>
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

              <!-- always in DOM so JS can store pending_id -->
              <input type="hidden" id="pendingIdHolder" value="">

              <div class="w-3xs gap-1 md:w-sm h-[15%] flex flex-col md:gap-2">
                <button id="verify-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-white bg-blue-500">Verify</button>
                <button id="back-btn" class="cursor-pointer border h-1/2 rounded-xl text-sm md:text-base md:rounded-2xl text-blue-500">Back</button>
              </div>
              
            </div>

          </div>




         <div class="flex flex-col w-1/3 bg-white md:justify-between md:flex-row">

          <div class="gap-2 md:gap-3 w-full h-full flex flex-col justify-center items-center text-nowrap">

            <div class="flex flex-col text-center">
              <p class="text-lg md:text-3xl">
                User ID:
                <span id="accountCodeText" class="text-blue-500">--</span>
              </p>
            </div>

            <div class="h-32 md:h-64">
              <img class="h-full" src="{{ asset('assets/images/otp-success.png') }}" alt="OTP success">
            </div>

            <div class="flex flex-col text-center gap-1 mb-10 md:mb-5 md:gap-5">
              <p class="text-lg md:text-3xl">VERIFIED</p>
              <p class="text-[.5rem] md:text-sm">Your account has been verified successfully</p>
            </div>

            <div class="w-3xs md:w-sm h-[7.5%] flex flex-col">
              <button id="done-btn" class="cursor-pointer border h-full rounded-xl text-sm md:text-base md:rounded-2xl text-white bg-blue-500">
                Done
              </button>
            </div>

          </div>

        </div>


        </div>

      </div>
    
    </div>
    
  </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const wrapper = document.getElementById('wrapper');
    const devOtpMessage = document.getElementById('devOtpMessage');
    const pendingIdHolder = document.getElementById('pendingIdHolder');
    const verifyBtn = document.getElementById('verify-btn');
    const backBtn = document.getElementById('back-btn');
    const accountCodeText = document.getElementById('accountCodeText');
    const doneBtn = document.getElementById('done-btn'); // <-- new

    // OTP input fields interaction
    const otpInputs = document.querySelectorAll('.otp-input');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            // Move to next input field if current field has one character
            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            // Move to previous input field if current field is cleared
            if (this.value.length === 0 && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    // STEP 1: Continue (save registration + show OTP panel)
    form.addEventListener('submit', async function (e) {
        e.preventDefault(); // stop page reload

        const formData = new FormData(form);
        const csrfToken = form.querySelector('input[name="_token"]').value;

        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        });

        if (response.status === 422) {
            const errorData = await response.json();
            console.log('Validation errors (step1):', errorData.errors);
            alert('Please check your inputs:\n' + JSON.stringify(errorData.errors, null, 2));
            return;
        }

        if (!response.ok) {
            const text = await response.text();
            console.error('Registration error status:', response.status);
            console.error('Registration error body:', text);
            alert(
                'Server error during registration.\n\n' +
                'Status: ' + response.status + '\n' +
                'Body: ' + text
            );
            return;
        }

        const data = await response.json();
        // data = { status:"ok", pending_id, otp_preview }

        // stash the pending id so Verify can use it
        pendingIdHolder.value = data.pending_id;

        // show dev OTP
        devOtpMessage.textContent = 'Your OTP (testing): ' + data.otp_preview;
        devOtpMessage.classList.remove('hidden');

        // slide to OTP panel
        wrapper.style.transform = 'translateX(-33.333%)';
    });

    // STEP 2: Verify (check OTP, create final user, show account code)
    verifyBtn.addEventListener('click', async function () {
        const csrfToken = form.querySelector('input[name="_token"]').value;

        // combine the 6 OTP input boxes
        let otpCode = '';
        otpInputs.forEach(inp => {
            otpCode += inp.value.trim();
        });

        const verifyData = new FormData();
        verifyData.append('pending_id', pendingIdHolder.value);
        verifyData.append('otp_code', otpCode);

        const response = await fetch("{{ route('register.verifyOtp') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: verifyData
        });

        if (response.status === 422) {
            const errorData = await response.json();
            console.log('Validation / OTP error:', errorData);
            alert('OTP invalid or expired.');
            return;
        }

        if (!response.ok) {
            const text = await response.text();
            console.error('OTP verify error status:', response.status);
            console.error('OTP verify error body:', text);
            alert(
                'Server error during OTP check.\n\n' +
                'Status: ' + response.status + '\n' +
                'Body: ' + text
            );
            return;
        }

        const data = await response.json();
        // data = { status:"ok", account_code:"01-RIVERA" }

        // Show the account code in last panel
        accountCodeText.textContent = data.account_code;

        // Slide to VERIFIED panel
        wrapper.style.transform = 'translateX(-66.666%)';
    });

    // STEP 2.5: Back (return from OTP panel to form panel without losing data)
    backBtn.addEventListener('click', function () {
        wrapper.style.transform = 'translateX(0%)';
    });

    // STEP 3: Done (go to login page)
    doneBtn.addEventListener('click', function () {
        // Simple redirect to login route
        window.location.href = "{{ route('login') }}";
    });
});
</script>





