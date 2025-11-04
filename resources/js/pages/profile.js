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
});