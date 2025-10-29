window.addEventListener("DOMContentLoaded", () => {

  const form = document.getElementById('registerForm');
    const wrapper = document.getElementById('wrapper');
    const devOtpMessage = document.getElementById('devOtpMessage');
    const pendingIdHolder = document.getElementById('pendingIdHolder');
    const verifyBtn = document.getElementById('verify-btn');
    const backBtn = document.getElementById('back-btn');
    const accountCodeText = document.getElementById('accountCodeText');
    const doneBtn = document.getElementById('done-btn'); // <-- new

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
        const otpInputs = document.querySelectorAll('.otp-input');
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
