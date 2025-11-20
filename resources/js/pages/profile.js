document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.toggle-section').forEach(button => {
    button.addEventListener('click', () => {
      const targetId = button.dataset.target;
      const section = document.getElementById(targetId);
      const icon = button.querySelector('svg');

      section.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });
  });

   document.querySelectorAll('.qr-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const qrImage = btn.dataset.qr;

      if (!qrImage) {
          Swal.fire({
              icon: 'error',
              title: 'No QR code available',
              text: 'The system could not load the QR code.'
          });
          return;
      }

      Swal.fire({
          title: 'Your QR Code',
          imageUrl: qrImage,
          imageWidth: 250,
          imageHeight: 250,
          confirmButtonText: 'Close',
      });
    });
  });
});