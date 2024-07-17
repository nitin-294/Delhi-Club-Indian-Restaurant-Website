document.addEventListener("DOMContentLoaded", function() {
    const images = [
        "../Images/Restaurant Photos/Pic1.jpg",
        "../Images/Restaurant Photos/Pic2.jpg",
        "../Images/Restaurant Photos/Pic3.jpg",
        "../Images/Restaurant Photos/Pic4.jpg",
        "../Images/Restaurant Photos/Pic5.jpg",
        "../Images/Restaurant Photos/Pic6.jpg",
        "../Images/Restaurant Photos/Pic7.jpg",
        "../Images/Restaurant Photos/Pic8.jpg",
        "../Images/Restaurant Photos/Pic9.jpg",
        "../Images/Restaurant Photos/Pic10.jpg",
        "../Images/Restaurant Photos/Pic11.jpg",
        "../Images/Restaurant Photos/Pic12.jpg",
        "../Images/Restaurant Photos/Pic13.jpg",
        "../Images/Restaurant Photos/Pic14.jpg",
        "../Images/Restaurant Photos/Pic15.jpg",
        "../Images/Restaurant Photos/Pic16.jpg",
        "../Images/Restaurant Photos/Pic17.jpg"
    ];

    let currentIndex = 0;
    const imgElement = document.getElementById("slideImage");

    function changeImage(index) {
        imgElement.classList.remove("fade");
        void imgElement.offsetWidth;
        currentIndex = (index + images.length) % images.length;
        imgElement.src = images[currentIndex];
        imgElement.classList.add("fade");
    }

    setInterval(function() {
        changeImage(currentIndex + 1);
    }, 3000);

    const prevButton = document.getElementById("prev");
    const nextButton = document.getElementById("next");

    prevButton.addEventListener("click", function() {
        changeImage(currentIndex - 1);
    });

    nextButton.addEventListener("click", function() {
        changeImage(currentIndex + 1);
    });
});