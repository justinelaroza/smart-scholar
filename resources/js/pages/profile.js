document.getElementById('supportBtn')?.addEventListener('click', () => {
  Swal.fire({
    icon: 'info',
    title: 'Request Edit - General Information',
    text: 'A support request will be sent to the administrator to review and allow edits to your General Info.',
    showCancelButton: true,
    confirmButtonText: 'Send Request',
    cancelButtonText: 'Cancel',
    confirmButtonColor: '#2563eb',
  }).then(result => {
    if (result.isConfirmed) {
      Swal.fire('Request Sent!', 'Your request has been forwarded.', 'success');
      // TODO: send POST request (AJAX or form) to support route
    }
  });
});