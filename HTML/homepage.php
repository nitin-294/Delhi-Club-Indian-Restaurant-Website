<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Homepage</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/homepage.css">
</head>

<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div class="mainContent">
        <div class="welcomeMessage">  
            <p><b>Welcome to Delhi Club Indian Restaurant!</b></p>
            <p>Located in the heart of Parkdale, Victoria, Delhi Club is your gateway to the vibrant and diverse flavors of India. Since our founding in 2019, we have been committed to bringing you an authentic dining experience with a modern twist.</p>
            <p>Join us for a culinary journey that celebrates traditional Indian cuisine, made with the freshest ingredients and a passion for excellence. Whether you're here for a casual takeaway, a romantic dinner, or a family celebration, we promise to make your visit unforgettable.</p>
            <p>Experience the true essence of India at Delhi Club Indian Restaurant – where every meal is a celebration!</p>
        </div>
        <br>
        <div id="buttonAbout">
            <form action="..\HTML\reservation.php" method="get">
                <button type="submit">Make a Reservation</button>
            </form>
            <form action="..\HTML\menu.php" method="get">
                <button type="submit">Order Online</button>
            </form>
        </div>
        <br>
        <div class="slideShowContainer">
            <button id="prev" class="nav-button">❮</button>
            <div class="slideShow" id="slideShow">
                <img id="slideImage" src="../Images/Restaurant Photos/Pic1.jpg" alt="Restaurant Image">
            </div>
            <button id="next" class="nav-button">❯</button>
        </div>
        <br>
        <br>
        <div class="reviewsContainer">
            <div class="reviewWrapper">
            </div>
        </div>
        <br>
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
    <script src="../JavaScript/slideShow.js"></script>
    <script src="../JavaScript/reviewsSlideshow.js"></script>
</footer>

</body>
</html>