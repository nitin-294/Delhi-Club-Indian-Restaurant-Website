document.addEventListener("DOMContentLoaded", function () {
    let slideInterval;
    fetch("../PHP/getReviews.php")
        .then(res => res.text())
        .then(data => {
            const reviewsContainer = document.querySelector(".reviewsContainer");
            reviewsContainer.innerHTML = "";

            const wrapper = document.createElement("div");
            wrapper.classList.add("reviewWrapper");
            reviewsContainer.appendChild(wrapper);

            const tempDiv = document.createElement("div");
            tempDiv.innerHTML = data;

            const reviews = tempDiv.querySelectorAll(".reviewSlide");
            const totalSlides = reviews.length;
            let currentSlide = 0;

            reviews.forEach(review => {
                review.style.display = "none";
                wrapper.appendChild(review);
            });

            const dotContainer = document.createElement("div");
            dotContainer.classList.add("dot-container");
            wrapper.appendChild(dotContainer);

            const dots = [];

            reviews.forEach((_, index) => {
                const dot = document.createElement("span");
                dot.classList.add("dot");
                dot.addEventListener("click", () => {
                    setSlide(index);
                    resetAutoSlideTimer();
                });
                dotContainer.appendChild(dot);
                dots.push(dot);
            });

            function setSlide(index) {
                if (index >= totalSlides) currentSlide = 0;
                else if (index < 0) currentSlide = totalSlides - 1;
                else currentSlide = index;
                renderSlide();
            }

            function renderSlide() {
                reviews.forEach(r => (r.style.display = "none"));
                dots.forEach(d => d.classList.remove("active"));
                reviews[currentSlide].style.display = "block";
                dots[currentSlide].classList.add("active");
            }

            function resetAutoSlideTimer() {
                if (slideInterval) clearInterval(slideInterval);
                slideInterval = setInterval(() => setSlide(currentSlide + 1), 5000);
            }

            setSlide(0);
            resetAutoSlideTimer(); 

        })
        .catch(error => {
            console.error("Error loading reviews:", error);
            document.querySelector(".reviewsContainer").innerHTML = "Error loading reviews.";
        });
});
