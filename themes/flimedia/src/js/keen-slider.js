document.addEventListener("DOMContentLoaded", function() {
    // Initialize the Fader Slider (Images)
    const faderSlider = new KeenSlider(".fader-slider", {
        loop: false,
        vertical: true,
        drag: false,
        slides: {
            perView: 1,
        },
        defaultAnimation: {
            duration: 800,
        },
        detailsChanged: (s) => {
            s.slides.forEach((element, idx) => {
                element.style.opacity = s.track.details.slides[idx].portion;
            });
        },
        renderMode: "custom",
    });

    // Initialize scrolling
    function WheelControls(slider) {
        var touchTimeout;
        var position;
        var wheelActive;

        function dispatch(e, name) {
            position.x -= e.deltaX;
            position.y -= e.deltaY;
            slider.container.dispatchEvent(
                new CustomEvent(name, {
                    detail: {
                        x: position.x,
                        y: position.y,
                    },
                })
            );
        }

        function wheelStart(e) {
            position = {
                x: e.pageX,
                y: e.pageY,
            };
            dispatch(e, "ksDragStart");
        }

        function wheel(e) {
            dispatch(e, "ksDrag");
        }

        function wheelEnd(e) {
            dispatch(e, "ksDragEnd");
        }

        function eventWheel(e) {
            e.preventDefault();
            if (!wheelActive) {
                wheelStart(e);
                wheelActive = true;
            }
            wheel(e);
            clearTimeout(touchTimeout);
            touchTimeout = setTimeout(() => {
                wheelActive = false;
                wheelEnd(e);
            }, 50);
        }

        slider.on("created", () => {
            slider.container.addEventListener("wheel", eventWheel, {
                passive: false,
            });
        });
    }

    // Initialize the Vertical Slider (Text)
    const verticalSlider = new KeenSlider(".vertical-slider", {
        vertical: true,
        loop: false,
        rubberband: false,
        mode: "free",
        slides: {
            perView: 1,
            spacing: 100,
        },
        },
        [WheelControls]
    );

    // Sync the two sliders
    verticalSlider.on("slideChanged", (s) => {
        const slideIndex = s.track.details.rel;
        faderSlider.moveToIdx(slideIndex);
        updateClasses(verticalSlider);
    });

    faderSlider.on("slideChanged", (s) => {
        const slideIndex = s.track.details.rel;
        verticalSlider.moveToIdx(slideIndex);
        updateClasses(faderSlider);
    });

    // Function to update the active class
    function updateClasses(instance) {
        const slide = instance.track.details.rel; // Get the current active slide
        const activeSlide = document.querySelectorAll(".vertical-slider-slides")[slide]; // Select the current active slide
        const cardNumbers = activeSlide.querySelectorAll(".card-numbers"); // Find the card numbers within the active slide

        // Remove 'card--active' class from all card numbers
        document.querySelectorAll(".card-numbers").forEach(function(cardNumber) {
            cardNumber.classList.remove("card--active");
        });

        // Add 'card--active' class to the correct card number on the current slide
        if (cardNumbers[slide]) {
            cardNumbers[slide].classList.add("card--active");
        }

        console.log(`Active slide: ${slide}`);
    }

    // Call updateClasses initially to set card1 of the first slide as active on page load
    updateClasses(verticalSlider);
});
