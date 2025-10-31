document.addEventListener('DOMContentLoaded', function () {

  const wrapper = document.getElementById('wrapper');

  const form = document.getElementById('registerForm');
  const pendingIdHolder = document.getElementById('pendingIdHolder');
  const continueBtn = document.getElementById('continueBtn');

  const verifyForm = document.getElementById('verifyForm');
  const otpInputs = document.querySelectorAll('.otp-input');
  const accountCodeText = document.getElementById('accountCodeText');

  const verifyBtn = document.getElementById('verify-btn');
  const backBtn = document.getElementById('back-btn');
  const doneBtn = document.getElementById('done-btn');

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

  verifyForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    verifyBtn.disabled = true;

    const csrfToken = verifyForm.querySelector('input[name="_token"]').value;
    const formData = new FormData(verifyForm);

    const otpInputs = verifyForm.querySelectorAll('.otp-input');
    let otpCode = '';
    otpInputs.forEach(inp => otpCode += (inp.value || '').trim());
    formData.append('otp_code', otpCode);

    const response = await fetch(verifyForm.action, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: formData
    });

    if (response.status === 422) {
      const err = await response.json();
      alert(err.message || 'OTP invalid or expired.');
      verifyBtn.disabled = false;
      return;
    }

    if (!response.ok) {
      const text = await response.text();
      alert('Server error during OTP check.\nStatus: ' + response.status + '\nBody: ' + text);
      verifyBtn.disabled = false; 
      return;
    }

    const data = await response.json();
    if (data.status === 'ok') {
      accountCodeText.textContent = data.account_code || '--';
      wrapper.style.transform = 'translateX(-66.666%)';
    } else {
      alert(data.message || 'OTP invalid or expired.');
    }

    verifyBtn.disabled = false;
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
