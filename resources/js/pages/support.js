document.addEventListener('DOMContentLoaded', () => {
  const toggles = document.querySelectorAll('.faq-toggle');
  toggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const index = toggle.dataset.index;
      const answer = document.querySelectorAll('.faq-answer')[index];
      const icon = toggle.querySelector('svg');
      answer.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });
  });
});