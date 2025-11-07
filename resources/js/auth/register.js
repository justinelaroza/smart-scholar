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

      const messages = Object.values(errorData.errors)
      .flat()
      .map(msg => `${msg}`)
      .join('<br>');

      Swal.fire({
        icon: 'error',
        title: 'Please check your inputs',
        html: messages,
        confirmButtonColor: '#2563eb'
      });

      continueBtn.disabled = false;
      return;
    }

    if (response.status === 429) {
      Swal.fire({
        icon: 'error',
        title: 'Too Many Attempts',
        text: 'Please wait a few seconds before trying again.',
        confirmButtonColor: '#2563eb'
      });
      continueBtn.disabled = false;
      return;
    }

    if (response.status === 500) {
      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: 'Something went wrong on our end. Please try again later.',
        confirmButtonColor: '#2563eb'
      });
      continueBtn.disabled = false;
      return;
    }

    if (!response.ok) {
      const text = await response.text();

      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: `Status: ${response.status}\n${text}`,
        confirmButtonColor: '#2563eb'
      });

      continueBtn.disabled = false;
      return;
    }

    const data = await response.json();
    console.log('Step1 response:', data);

    if (data.status === 'ok') {
      if (data.pending_id) pendingIdHolder.value = data.pending_id;
        
      Swal.fire({
        icon: 'success',
        title: 'OTP Sent!',
        text: 'A verification code has been sent to your registered phone number.',
        confirmButtonColor: '#2563eb'
      }).then(() => {
        wrapper.style.transform = 'translateX(-33.333%)';
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: data.message || 'Error during OTP sending.',
        confirmButtonColor: '#2563eb'
      });

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
      Swal.fire({
        icon: 'error',
        title: 'Invalid OTP',
        text: err.message || 'OTP invalid or expired.',
        confirmButtonColor: '#2563eb'
      });
      verifyBtn.disabled = false;
      return;
    }

    if (response.status === 429) {
      Swal.fire({
        icon: 'error',
        title: 'Too Many Attempts',
        text: 'Please wait a few seconds before trying again.',
        confirmButtonColor: '#2563eb'
      });
      verifyBtn.disabled = false;
      return;
    }

    if (response.status === 500) {
      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: text || 'Something went wrong on our end. Please try again later.',
        confirmButtonColor: '#2563eb'
      });
      verifyBtn.disabled = false;
      return;
    }

    if (!response.ok) {
      const text = await response.text();
      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: `Status: ${response.status}\n${text}`,
        confirmButtonColor: '#2563eb'
      });
      verifyBtn.disabled = false;
      return;
    }

    const data = await response.json();
    if (data.status === 'ok') {
      Swal.fire({
        icon: 'success',
        title: 'Verification Successful!',
        text: 'Your account has been successfully verified.',
        confirmButtonColor: '#2563eb'
      }).then(() => {
        accountCodeText.textContent = data.account_code || '--';
        wrapper.style.transform = 'translateX(-66.666%)';
      });
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Verification Failed',
        text: data.message || 'OTP invalid or expired.',
        confirmButtonColor: '#2563eb'
      });
    }

    verifyBtn.disabled = false;
  });

  // Back
  backBtn.addEventListener('click', function () {
    wrapper.style.transform = 'translateX(0%)';
  });
  
});
