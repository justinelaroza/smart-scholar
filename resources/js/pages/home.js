window.addEventListener("DOMContentLoaded", () => {

  const wrapper = document.getElementById("wrapper-home");
  if (!wrapper) return;

  const nextBtn = document.getElementById("next-pic-btn");
  const prevBtn = document.getElementById("previous-pic-btn");

  const totalPics = wrapper.children.length;
  let currentIndex = 0;

  // Function to update the transform
  function updateCarousel() {
    const translatePercent = -(currentIndex * (100 / totalPics));
    wrapper.style.transform = `translateX(${translatePercent}%)`;
  }

  function nextPic() {
    currentIndex = (currentIndex + 1) % totalPics;
    updateCarousel();
  }

  function previousPic() {
    currentIndex = (currentIndex - 1 + totalPics) % totalPics;
    updateCarousel();
  }

  nextBtn.addEventListener("click", nextPic);
  prevBtn.addEventListener("click", previousPic);

  setInterval(nextPic, 5000);

  //Facebook script
  async function loadFeed() {
      try {
          const response = await fetch('/facebook-feed-ajax');
          const data = await response.json();
          const feedDiv = document.getElementById('feed');
          feedDiv.innerHTML = data.html;
      } catch (err) {
          console.error('Error loading feed:', err);
      }
  }

  loadFeed();
  setInterval(loadFeed, 60000);
});