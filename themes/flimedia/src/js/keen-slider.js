import KeenSlider from "keen-slider";

// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Vertical Slider
    const verticalSlider = new KeenSlider(".vertical-slider", {
        vertical: true,
        loop: false,
        slides: {
            perView: 1,
        },
    });

    // Initialize Fader Slider (for images)
    const faderSlider = new KeenSlider(".fader-slider", {
        loop: true,
        slides: {
            perView: 1,
        },
        mode: "fade",
        created() {
            this.container.style.opacity = "1";
        },
        slideChanged() {
            this.container.style.opacity = "1";
        }
    });

    // Optionally synchronize the sliders
    verticalSlider.on("slideChanged", (slider) => {
        const currentSlide = slider.track.details.rel;
        faderSlider.moveToSlideRelative(currentSlide);
    });
});
