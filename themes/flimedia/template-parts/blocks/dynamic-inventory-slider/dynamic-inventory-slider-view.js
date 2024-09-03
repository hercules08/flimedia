console.log("Frontend Script");

document.addEventListener("DOMContentLoaded", function () {
  let currentIndex = 0;
  const sliderContainer = document.querySelector(".dynamic-slider-container");

  // adding conditional to fix error if slider is hidden on blocksy template
  if (sliderContainer) {

    const slides = sliderContainer.querySelectorAll(".dynamic-slide");
    const totalSlides = slides.length;
    const prevButton = document.querySelector(".dynamic-slider-prev");
    const nextButton = document.querySelector(".dynamic-slider-next");
    const autoplay = sliderContainer.getAttribute("data-autoplay") === "true";
    const navThumbnails = document.querySelectorAll(".dynamic-thumbnail");
    const thumbnailTrack = document.querySelector(".dynamic-thumbnail-container");
    const thumbnailRightMargin = 10;
    let trackCurrentLeftPos = 0;
  
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
        updateThumbs(currentIndex);
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
  
  
    function updateThumbs(selectedIndex) {
      let prevIndex = 0;
      let thumbWidth = 0;
      
      navThumbnails.forEach((thumbnail, index) => {
        const isPrevIndex = thumbnail.classList.contains("active");
        prevIndex = isPrevIndex ? index : prevIndex;
        const isSelectedIndex = index === selectedIndex;
        thumbWidth = thumbnail.offsetWidth + thumbnailRightMargin; 
        thumbnail.classList.toggle("active", isSelectedIndex);
      });
      
      if (totalSlides > 6) {
        let indexDiff = selectedIndex - prevIndex;
        trackCurrentLeftPos = thumbnailTrack.offsetLeft ? thumbnailTrack.offsetLeft : 0;
        if (indexDiff !== 0) {
          let pxToMove = thumbWidth * indexDiff;
          thumbnailTrack.style.left = trackCurrentLeftPos - pxToMove + 'px';
        }
      }
    }
  
    function updateThumbTrackPos() {
        let activeSlideIndex = 0;
        let thumbWidth = 0;
        navThumbnails.forEach((thumbnail, index) => {
          const isActiveSlide = thumbnail.classList.contains("active");
          activeSlideIndex = isActiveSlide ? index : activeSlideIndex;
          thumbWidth = thumbnail.offsetWidth + thumbnailRightMargin; 
        });
        let trackLeftPos = thumbWidth * activeSlideIndex;
        thumbnailTrack.style.left =  -trackLeftPos + 'px';
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
  
    // Event listener for thumbnail nav
    navThumbnails.forEach((thumbnail, index) => {
      thumbnail.addEventListener("click", () => {
        currentIndex = index;
        updateSlides();
        updateThumbs(index);
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
    
    let inventorySliderResizeTimer;
    
    window.addEventListener('resize', function(event) {
      if(inventorySliderResizeTimer) {
        window.clearTimeout(inventorySliderResizeTimer);
      }
    
      inventorySliderResizeTimer = window.setTimeout(function() {
        if (totalSlides > 6) {
          updateThumbTrackPos();
        }
      }, 175);
    });

  } // end if slider container


});

