document.addEventListener('DOMContentLoaded', function() {
    insertHeader();
    setupArrows();
    setupScrollOffset();
});

function insertHeader() {
    var header = document.querySelector("header");
    var currentPage = window.location.href;

    header.innerHTML = `
    <div class="navbar">
        <img src="../Images/Logo.png" alt="Delhi Club Logo">
        <a href="../HTML/homepage.php" ${currentPage.includes('homepage.php') ? 'id="selected"' : ''}>Home</a>
        <a href="../HTML/menu.php" ${currentPage.includes('menu.php') ? 'id="selected"' : ''}>Menu</a>
        <a href="../HTML/about.php" ${currentPage.includes('about.php') ? 'id="selected"' : ''}>About Us</a>
        <a href="../HTML/signin.php" ${currentPage.includes('signin.php') ? 'id="selected"' : ''}>Sign In</a>
        <a href="../HTML/shoppingCart.php" class="cartLink" ${currentPage.includes('shoppingCart.php') ? 'id="selected"' : ''}><img src="../Images/shoppingCartIcon.png" alt="shopping cart"></a>
    </div>
    `;
}

function setupArrows() {
    var arrowLeft = document.getElementById('arrowLeft');
    var arrowRight = document.getElementById('arrowRight');
    var navContent = document.querySelector('.nav-content');

    function updateArrows() {
        var scrollLeft = navContent.scrollLeft;
        var scrollWidth = navContent.scrollWidth;
        var clientWidth = navContent.clientWidth;

        arrowLeft.style.display = scrollLeft > 0 ? 'block' : 'none';
        arrowRight.style.display = (scrollWidth - clientWidth - scrollLeft) > 1 ? 'block' : 'none';
    }

    arrowLeft.addEventListener('click', function() {
        navContent.scrollBy({ left: -400, behavior: 'smooth' });
    });

    arrowRight.addEventListener('click', function() {
        navContent.scrollBy({ left: 400, behavior: 'smooth' }); 
    });

    navContent.addEventListener('scroll', updateArrows);

    updateArrows();
}

function setupScrollOffset() {
    var navbarHeight = document.getElementById('stickyNavbar').offsetHeight;

    document.querySelectorAll('#stickyNavbar a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            var targetId = this.getAttribute('href').substring(1);
            var targetElement = document.getElementById(targetId);
            if (targetElement) {
                var targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 10;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}