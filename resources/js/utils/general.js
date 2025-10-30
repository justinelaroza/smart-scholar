document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('registerForm');
  const wrapper = document.getElementById('wrapper');
  const pendingIdHolder = document.getElementById('pendingIdHolder');
  const verifyBtn = document.getElementById('verify-btn');
  const backBtn = document.getElementById('back-btn');
  const accountCodeText = document.getElementById('accountCodeText');
  const doneBtn = document.getElementById('done-btn');
  const continueBtn = document.getElementById('continueBtn');

  const otpInputs = document.querySelectorAll('.otp-input');
  
  otpInputs.forEach((input, index) => {
    input.addEventListener("input", () => {
      if (input.value.length === 1 && index < 5) {
        otpInputs[index + 1].focus(); 
      }
    });

    input.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && input.value === "" && index > 0) {
        otpInputs[index - 1].focus(); 
      }
    });
  });

  // STEP 1
  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    continueBtn.disabled = true;

    const formData = new FormData(form);
    const csrfToken = form.querySelector('input[name="_token"]').value;

    const response = await fetch(form.action, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: formData
    });

    if (response.status === 422) {
      const errorData = await response.json();
      alert('Please check your inputs:\n' + JSON.stringify(errorData.errors, null, 2));
      continueBtn.disabled = false;
      return;
    }

    if (!response.ok) {
      const text = await response.text();
      alert('Server error during registration.\nStatus: ' + response.status + '\nBody: ' + text);
      continueBtn.disabled = false;
      return;
    }

    const data = await response.json();
    console.log('Step1 response:', data);

    if (data.status === 'ok') {
      if (data.pending_id) pendingIdHolder.value = data.pending_id;
        wrapper.style.transform = 'translateX(-33.333%)';
      } else {
        alert(data.message || 'Error during OTP sending.');
    }

    continueBtn.disabled = false;
  });

  // STEP 2
  verifyBtn.addEventListener('click', async function () {
    const csrfToken = form.querySelector('input[name="_token"]').value;

    let otpCode = '';
    otpInputs.forEach(inp => otpCode += (inp.value || '').trim());

    const verifyData = new FormData();
    verifyData.append('pending_id', pendingIdHolder.value);
    verifyData.append('otp_code', otpCode);

    const response = await fetch("{{ route('register.verifyOtp') }}", {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: verifyData
    });

    if (response.status === 422) {
      const err = await response.json();
      alert(err.message || 'OTP invalid or expired.');
      return;
    }

    if (!response.ok) {
      const text = await response.text();
      alert('Server error during OTP check.\nStatus: ' + response.status + '\nBody: ' + text);
      return;
    }

    const data = await response.json();
    if (data.status === 'ok') {
      accountCodeText.textContent = data.account_code || '--';
      wrapper.style.transform = 'translateX(-66.666%)';
    } else {
      alert(data.message || 'OTP invalid or expired.');
    }
  });

  // Back
  backBtn.addEventListener('click', function () {
    wrapper.style.transform = 'translateX(0%)';
  });

  // Done
  doneBtn.addEventListener('click', function () {
    window.location.href = "{{ route('login') }}";
  });
});
