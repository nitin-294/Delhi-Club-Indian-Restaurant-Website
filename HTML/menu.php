<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Menu</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/menu.css">
</head>

<body>

<header>
    <?php include '../PHP/header.php'; ?>
</header>

<main>
    <div id="stickyNavbar">
    <div class="arrow" id="arrowLeft">❮</div>
    <div class="nav-content">
        <ul>
            <li><a href="#vegEntrees">Vegetarian Entrees</a></li>
            <li><a href="#nonVegEntrees">Non-Vegetarian Entrees</a></li>
            <li><a href="#chickenCurries">Main-Course Chicken</a></li>
            <li><a href="#lambCurries">Main-Course Lamb</a></li>
            <li><a href="#goatCurries">Main-Course Goat</a></li>
            <li><a href="#beefCurries">Main-Course Beef</a></li>
            <li><a href="#seafoodCurries">Main-Course Seafood</a></li>
            <li><a href="#vegCurries">Main-Course Vegetarian</a></li>
            <li><a href="#rice">Rice</a></li>
            <li><a href="#wholemealBread">Wholemeal Bread</a></li>
            <li><a href="#plainflourBread">Plain Flour Bread</a></li>
            <li><a href="#desserts">Desserts</a></li>
            <li><a href="#accompaniments">Accompaniments</a></li>
            <li><a href="#beverages">Beverages</a></li>
            <li><a href="#indoSoups">Indo-Chinese Soups</a></li>
            <li><a href="#indoVegEntrees">Indo-Chinese Vegetarian Entrees</a></li>
            <li><a href="#indoNonVegEntrees">Indo-Chinese Non-Vegetarian Entrees</a></li>
            <li><a href="#indoNoodles">Indo-Chinese Noodles</a></li>
            <li><a href="#indoRice">Indo-Chinese Rice</a></li>
        </ul>
    </div>
    <div class="arrow" id="arrowRight">❯</div>
</div>

    <div>

        <section id="entrees">
            <div class="itemCategories" id="vegEntrees">
                <h2>Vegeterian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/vegEntrees.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories" id="nonVegEntrees">
                <h2>Non-Vegeterian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/nonVegEntrees.php'; ?>
                </div>
            </div>
        </section>
        
        <section id="curries">
            <div class="itemCategories" id="chickenCurries">
                <h2>Main-Course Chicken</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseChicken.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories" id="lambCurries">
                <h2>Main-Course Lamb</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseLamb.php'; ?>
                </div>
            </div>
            
            <div class="itemCategories" id="goatCurries">
                <h2>Main-Course Goat</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseGoat.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="beefCurries">
                <h2>Main-Course Beef</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseBeef.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="seafoodCurries">
                <h2>Main-Course Seafood</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseSeafood.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="vegCurries">
                <h2>Main-Course Vegeterian</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/mainCourseVegeterian.php'; ?>
                </div>
            </div>

        </section>

        <section id="rice">
            <div class="itemCategories">
                <h2>Rice</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/rice.php'; ?>
                </div>
            </div>
        </section>

        <section id="breads">
            <div class="itemCategories" id="wholemealBread">
                <h2>Wholemeal Bread</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/wholemealBread.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="plainflourBread">
                <h2>Plain Flour Bread</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/plainflourBread.php'; ?>
                </div>
            </div>
        </section>

        <section id="desserts">
            <div class="itemCategories">
                <h2>Desserts</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/desserts.php'; ?>
                </div>
            </div>
        </section>

        <section id="accompaniments">
            <div class="itemCategories">
                <h2>Accompaniments</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/accompaniments.php'; ?>
                </div>
            </div>
        </section>

        <section id="beverages">
            <div class="itemCategories">
                <h2>Beverages</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/beverages.php'; ?>
                </div>
            </div>
        </section>

        <section id="indoChinese">

            <div class="itemCategories" id="indoSoups">
                <h2>Indo-Chinese Soups</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/indoSoups.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="indoVegEntrees">
                <h2>Indo-Chinese Vegetarian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/indoVegEntrees.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="indoNonVegEntrees">
                <h2>Indo-Chinese Non-Vegetarian Entrees</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/indoNonVegEntrees.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="indoNoodles">
                <h2>Indo-Chinese Noodles</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/indoNoodles.php'; ?>
                </div>
            </div>

            <div class="itemCategories" id="indoRice">
                <h2>Indo-Chinese Rice</h2>
                <div class="itemContainer">
                    <?php include '../PHP/menuPHP/indoRice.php'; ?>
                </div>
            </div>

        </section>
        
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
    <script src="../JavaScript/addingItem.js"></script>
</footer>

</body>
</html>