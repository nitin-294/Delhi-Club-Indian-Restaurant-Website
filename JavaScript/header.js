document.addEventListener('DOMContentLoaded', function() {
    insertHeader();
});

function insertHeader() {
    var header = document.querySelector("header");
    var currentPage = window.location.href;

    header.innerHTML = `
    <div class="navbar">
        <img src="../Images/Logo.png" alt="Delhi Club Logo">
        <a href="../HTML/homepage.php" ${currentPage.includes('homepage.php') ? 'id="selected"' : ''}>Home</a>
        <div class="navDropdown">
            <button class="dropbutton" ${currentPage.includes('menu.php') ? 'id="selected"' : ''}">Menu</button>
            <div class="dropdownContent">
                <a href="../HTML/menu.php#entrees" ${currentPage.includes('menu.php#entrees') ? 'id="selected"' : ''}>Entrees</a>
                <a href="../HTML/menu.php#curries" ${currentPage.includes('menu.php#curries') ? 'id="selected"' : ''}>Curries</a>
                <a href="../HTML/menu.php#rice" ${currentPage.includes('menu.php#rice') ? 'id="selected"' : ''}>Rice</a>
                <a href="../HTML/menu.php#breads" ${currentPage.includes('menu.php#breads') ? 'id="selected"' : ''}>Breads</a>
                <a href="../HTML/menu.php#desserts" ${currentPage.includes('menu.php#desserts') ? 'id="selected"' : ''}>Desserts</a>
                <a href="../HTML/menu.php#accompaniments" ${currentPage.includes('menu.php#accompaniments') ? 'id="selected"' : ''}>Accompaniments</a>
                <a href="../HTML/menu.php#beverages" ${currentPage.includes('menu.php#beverages') ? 'id="selected"' : ''}>Beverages</a>
                <a href="../HTML/menu.php#indoChinese" ${currentPage.includes('menu.php#indoChinese') ? 'id="selected"' : ''}>Indo-Chinese</a>
            </div>
        </div>
        <a href="../HTML/about.php" ${currentPage.includes('about.php') ? 'id="selected"' : ''}>About Us</a>
        <a href="../HTML/signin.php" ${currentPage.includes('signin.php') ? 'id="selected"' : ''}>Sign In</a>
        <a href="../HTML/shoppingCart.php" class="cartLink" ${currentPage.includes('shoppingCart.php') ? 'id="selected"' : ''}><img src="../Images/shoppingCartIcon.png" alt="shopping cart"></a>
    </div>
    `;
}