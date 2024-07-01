document.addEventListener('DOMContentLoaded', function() {
    insertHeader();
});

function insertHeader() {
    var header = document.querySelector("header");
    var currentPage = window.location.href;

    header.innerHTML = `
    <div class="navbar">
        <img src="../Images/Logo.png" alt="Delhi Club Logo">
        <a href="../HTML/homepage.html" ${currentPage.includes('homepage.html') ? 'id="selected"' : ''}>Home</a>
        <div class="navDropdown">
            <button class="dropbutton" ${currentPage.includes('menu.html') ? 'id="selected"' : ''}">Menu</button>
            <div class="dropdownContent">
                <a href="../HTML/menu.html#entrees" ${currentPage.includes('menu.html#entrees') ? 'id="selected"' : ''}>Entrees</a>
                <a href="../HTML/menu.html#curries" ${currentPage.includes('menu.html#curries') ? 'id="selected"' : ''}>Curries</a>
                <a href="../HTML/menu.html#rice" ${currentPage.includes('menu.html#rice') ? 'id="selected"' : ''}>Rice</a>
                <a href="../HTML/menu.html#breads" ${currentPage.includes('menu.html#breads') ? 'id="selected"' : ''}>Breads</a>
                <a href="../HTML/menu.html#desserts" ${currentPage.includes('menu.html#desserts') ? 'id="selected"' : ''}>Desserts</a>
                <a href="../HTML/menu.html#accompaniments" ${currentPage.includes('menu.html#accompaniments') ? 'id="selected"' : ''}>Accompaniments</a>
                <a href="../HTML/menu.html#beverages" ${currentPage.includes('menu.html#beverages') ? 'id="selected"' : ''}>Beverages</a>
                <a href="../HTML/menu.html#indoChinese" ${currentPage.includes('menu.html#indoChinese') ? 'id="selected"' : ''}>Indo-Chinese</a>
            </div>
        </div>
        <a href="../HTML/about.html" ${currentPage.includes('about.html') ? 'id="selected"' : ''}>About Us</a>
        <a href="../HTML/signin.html" ${currentPage.includes('signin.html') ? 'id="selected"' : ''}>Sign In</a>
        <a href="../HTML/shoppingCart.html" class="cartLink" ${currentPage.includes('shoppingCart.html') ? 'id="selected"' : ''}><img src="../Images/shoppingCartIcon.png" alt="shopping cart"></a>
    </div>
    `;
}