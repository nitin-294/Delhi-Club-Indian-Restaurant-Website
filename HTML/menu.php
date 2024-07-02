<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/menu.css">
</head>

<body>

<header>
    <script src="../JavaScript/header.js"></script>
</header>

<main>

    <div class="mainContent">

        <section id="entrees">
            <div class="itemCategories">
                <h2>Vegeterian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/vegEntrees.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories">
                <h2>Non-Vegeterian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/nonVegEntrees.php'; ?>
                </div>
            </div>
        </section>
        
        <section id="curries">
            <div class="itemCategories">
                <h2>Main-Course Chicken</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseChicken.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories">
                <h2>Main-Course Lamb</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseLamb.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories">
                <h2>Main-Course Goat</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseGoat.php'; ?>
                </div>
            </div>
        </section>
        
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>