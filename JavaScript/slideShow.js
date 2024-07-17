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
    const slideShowContainer = document.getElementById("slideShow");

    const imgElement = document.createElement("img");
    imgElement.src = images[currentIndex];
    imgElement.style.width = "100%";
    slideShowContainer.appendChild(imgElement);

    function changeImage() {
        currentIndex = (currentIndex + 1) % images.length;
        imgElement.src = images[currentIndex];
    }

    setInterval(changeImage, 3000);
});