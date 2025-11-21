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
        showDenyButton: true,
        denyButtonText: 'Download',
        denyButtonColor: '#4f46e5',
      }).then((result) => {
        if (result.isDenied) {
          const link = document.createElement('a');
          link.href = qrImage;
          link.download = 'scholarship-qr-code.png';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);

          Swal.fire({
            icon: 'success',
            title: 'Downloaded!',
            text: 'QR code has been downloaded.',
            timer: 2000,
            showConfirmButton: false
          });
        }
      });
    });
  });
});