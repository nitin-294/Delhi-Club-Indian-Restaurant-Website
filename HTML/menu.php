<?php
include 

// Fetch categories
$sql = "SELECT category_name FROM categories";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row['category_name'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurnt</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
</head>

<body>

<header>
    <script src="../JavaScript/header.js"></script>
</header>

<main>
    <div class="mainContent">
        <?php foreach ($categories as $category): ?>
            <div class="itemCategorySection">
                <h2><?php echo htmlspecialchars($category); ?></h2>
                <p>Details about <?php echo htmlspecialchars($category); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer>
    <script src="../JavaScript/footer.js"></script>
</footer>

</body>
</html>