import '../echo';

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

  function createNotification() {
    let notification = document.getElementById('realtime-notification');
    if (!notification) {
      notification = document.createElement('div');
      notification.id = 'realtime-notification';
      notification.className = 'hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center gap-4 max-w-md';
      notification.innerHTML = `
        <span id="notification-message" class="flex-1">Update available!</span>
        <button onclick="window.location.reload()" class="bg-white text-blue-600 px-4 py-1 rounded font-medium hover:bg-blue-50 transition text-sm">
          Refresh
        </button>
        <button onclick="document.getElementById('realtime-notification').classList.add('hidden')" class="text-white hover:text-gray-200 text-xl font-bold">
          ✕
        </button>
      `;
      document.body.appendChild(notification);
    }
    return notification;
  }

  // Show notification
  function showNotification(message) {
    const notification = createNotification();
    const messageEl = document.getElementById('notification-message');
    messageEl.textContent = message;
    
    notification.classList.remove('hidden');
    notification.style.animation = 'slideDown 0.3s ease-out';
    
    // Auto-hide after 10 seconds
    setTimeout(() => {
      notification.classList.add('hidden');
    }, 10000);
  }

  function updateApplicationInList(data) {
    // For desktop table view
    const desktopRow = document.querySelector(`tr[data-application-id="${data.application_id}"]`);
    if (desktopRow) {
      updateDesktopRow(desktopRow, data);
    }

    // For mobile card view
    const mobileCard = document.querySelector(`div[data-application-id="${data.application_id}"]`);
    if (mobileCard) {
      updateMobileCard(mobileCard, data);
    }
  }

  function updateDesktopRow(row, data) {
    const statusCell = row.querySelector('td:nth-child(2) span');
    
    if (statusCell) {
      // Update status badge
      statusCell.className = getStatusClass(data.progress);
      statusCell.textContent = data.progress;
      
      // Add highlight animation
      row.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'transition-all');
      row.style.transform = 'scale(1.02)';
      
      setTimeout(() => {
        row.style.transform = 'scale(1)';
      }, 200);
      
      setTimeout(() => {
        row.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50');
      }, 2000);
    }
  }

  function updateMobileCard(card, data) {
    const statusSpan = card.querySelector('p:nth-child(2) span');
    
    if (statusSpan) {
      // Update status badge
      statusSpan.className = getStatusClass(data.progress);
      statusSpan.textContent = data.progress;
      
      // Add highlight animation
      card.classList.add('ring-2', 'ring-blue-500', 'transition-all');
      card.style.transform = 'scale(1.02)';
      
      setTimeout(() => {
        card.style.transform = 'scale(1)';
      }, 200);
      
      setTimeout(() => {
        card.classList.remove('ring-2', 'ring-blue-500');
      }, 2000);
    }
  }

  function getStatusClass(progress) {
    const baseClasses = 'px-3 py-1 rounded-full responsive-text-xs font-medium text-nowrap shadow-sm';
    switch (progress) {
      case 'Approved':
        return `${baseClasses} bg-green-100 text-green-700`;
      case 'Rejected':
        return `${baseClasses} bg-red-100 text-red-700`;
      case 'Requires Revision':
        return `${baseClasses} bg-yellow-100 text-yellow-700`;
      default:
        return `${baseClasses} bg-blue-100 text-blue-700`;
    }
  }

  function attachQrButtonEvent(btn) {
    if (!btn) return;
    
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
  }

  // Listen for application progress updates
  if (window.userId) {
    window.Echo.channel(`user.${window.userId}`)
      .listen('.application.progress.updated', (data) => {
        
        if (data.progress === 'Approved') {
          showNotification(`✅ Application approved: ${data.scholarship_title} - Reloading page...`);
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          updateApplicationInList(data);
          
          const statusIcon = data.progress === 'Rejected' ? '❌' : 
                            data.progress === 'Requires Revision' ? '⚠️' : '📝';
          showNotification(`${statusIcon} Application updated: ${data.scholarship_title} - ${data.progress}`);
        }
      });
  }

  // Add CSS animation
  const style = document.createElement('style');
  style.textContent = `
    @keyframes slideDown {
      from {
        transform: translate(-50%, -100%);
        opacity: 0;
      }
      to {
        transform: translate(-50%, 0);
        opacity: 1;
      }
    }
  `;
  document.head.appendChild(style);
});