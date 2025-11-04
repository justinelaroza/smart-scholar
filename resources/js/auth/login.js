document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('loginForm');
  const loginBtn = document.getElementById('loginBtn');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    loginBtn.disabled = true;

    const formData = new FormData(form);
    const csrfToken = form.querySelector('input[name="_token"]').value;

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'Accept': 'application/json',
        },
        body: formData,
      });

      const data = await response.json();

      if (!response.ok || data.status === 'error') {
        Swal.fire({
          icon: 'error',
          title: 'Login Failed',
          text: data.message || 'Invalid Account ID or password.',
          confirmButtonColor: '#2563eb', // blue
        });
        loginBtn.disabled = false;
        return;
      }

      Swal.fire({
        icon: 'success',
        title: 'Login Successful',
        text: 'Redirecting...',
        timer: 1500,
        showConfirmButton: false,
      });

      setTimeout(() => {
        window.location.href = '/'; // or route('home')
      }, 1600);
    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        text: 'Something went wrong. Please try again later.',
        confirmButtonColor: '#2563eb',
      });
      loginBtn.disabled = false;
    }
  });
});