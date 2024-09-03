console.log("Frontend Script");

document.addEventListener("DOMContentLoaded", function () {
  let currentIndex = 0;
  const sliderContainer = document.querySelector(".dynamic-slider-container");
  const slides = sliderContainer.querySelectorAll(".dynamic-slide");
  const totalSlides = slides.length;
  const prevButton = document.querySelector(".dynamic-slider-prev");
  const nextButton = document.querySelector(".dynamic-slider-next");
  const autoplay = sliderContainer.getAttribute("data-autoplay") === "true";
  const tabTitles = document.querySelectorAll(".dynamic-tab-title");
  const tabContents = document.querySelectorAll(".dynamic-tab");

  let touchStartX = 0;
  let touchEndX = 0;
  const threshold = 50; // Minimum distance of swipe to trigger slide change

  function handleSwipe() {
    if (touchEndX < touchStartX - threshold) moveSlide("next");
    if (touchEndX > touchStartX + threshold) moveSlide("prev");
  }

  function moveSlide(direction) {
    if (
      (direction === "next" && currentIndex < totalSlides - 1) ||
      (direction === "prev" && currentIndex > 0)
    ) {
      currentIndex += direction === "next" ? 1 : -1;
      updateSlides();
      updateTabs(currentIndex);
      if (autoplay) clearInterval(autoPlayInterval);
    }
  }

  function updateSlides() {
    slides.forEach((slide, index) => {
      slide.classList.toggle("active", index === currentIndex);
    });

    // Set inline style for navigation buttons
    prevButton.style.display = currentIndex === 0 ? "none" : "flex";
    nextButton.style.display =
      currentIndex === totalSlides - 1 ? "none" : "flex";
  }

  function updateTabs(selectedIndex) {
    tabTitles.forEach((title, index) => {
      const isActive = index === selectedIndex;
      title.classList.toggle("active", isActive);
      tabContents[index].classList.toggle("active", isActive);
    });
  }

  let autoPlayInterval;

  // Autoplay logic
  if (autoplay) {
    autoPlayInterval = setInterval(function () {
      if (currentIndex < totalSlides - 1) moveSlide("next");
      else clearInterval(autoPlayInterval); // Stop the autoplay at the last slide
    }, 3000); // Change slides every 3 seconds
  }

  // Event listeners for navigation buttons
  prevButton.addEventListener("click", () => {
    if (currentIndex > 0) moveSlide("prev");
    if (autoplay) clearInterval(autoPlayInterval);
  });

  nextButton.addEventListener("click", () => {
    if (currentIndex < totalSlides - 1) moveSlide("next");
    if (autoplay) clearInterval(autoPlayInterval);
  });

  // Event listener for tab titles
  tabTitles.forEach((title, index) => {
    title.addEventListener("click", () => {
      currentIndex = index;
      updateSlides();
      updateTabs(index);
      if (autoplay) clearInterval(autoPlayInterval);
    });
  });

  // Event listeners for touch events
  sliderContainer.addEventListener("touchstart", (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  sliderContainer.addEventListener("touchend", (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  });

  // Initialize
  updateSlides();
});
