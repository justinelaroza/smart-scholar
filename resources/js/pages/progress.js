document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  
  form.addEventListener('submit', function (e) {
    e.preventDefault(); // prevent default submission
    Swal.fire({
      title: 'Are you sure?',
      text: "Please confirm that all information is correct.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, submit!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: 'Uploading...',
          text: 'Please wait while your files are being uploaded.',
          allowOutsideClick: false,
          allowEscapeKey: false,
          showConfirmButton: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });
        form.submit(); // submit form after showing loader
      }
    });
  });
});