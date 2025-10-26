window.addEventListener("DOMContentLoaded", () => {

  const menuBtn = document.getElementById('menu-btn');
  if (!menuBtn) return;

  const closeBtn = document.getElementById('close-btn');
  const sidebar = document.getElementById('mobile-sidebar');

  menuBtn.addEventListener('click', () => {
    sidebar.classList.remove('translate-x-full');
    document.body.style.overflow = 'hidden';
  });

  closeBtn.addEventListener('click', () => {
    sidebar.classList.add('translate-x-full');
    document.body.style.overflow = ''; 
  });

});