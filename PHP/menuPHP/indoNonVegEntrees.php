<?php
    include "../PHP/dbConnection.php";

    $sql = "SELECT item_name, item_description, item_price FROM menuitems WHERE category_id = 17";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menuItem">';
            echo '<div class="itemDetails">';
            echo '<h3><span class="itemName">' . htmlspecialchars($row["item_name"]) . '</span><span class="itemPrice">$' . htmlspecialchars($row["item_price"]) . '</span></h3>';
            echo '<p class="itemDescription">' . htmlspecialchars($row["item_description"]) . '</p>';
            echo '</div>';

            echo '<div class="formWithMessage">';

            echo '<form class="addToCartForm" method="post" action="../PHP/addToCart.php">';
            echo '<input type="hidden" name="item_name" value="' . htmlspecialchars($row['item_name']) . '">';
            echo '<input type="hidden" name="price" value="' . htmlspecialchars($row['item_price']) . '">';
            echo '<label for="quantity_' . htmlspecialchars($row['item_name']) . '">Quantity:</label> ';
            echo '<input type="number" name="quantity" id="quantity_' . htmlspecialchars($row['item_name']) . '" value="1" min="1">';
            echo '<button type="submit" class="addToCartButton">Add</button>';
            echo '</form>';

            echo '<div class="add-msg" style="height: 1.125rem; visibility: hidden;"></div>';

            echo '</div>';
            echo '</div>'; 
        }
    } else {
        echo "No items found.";
    }

    $conn->close();
?>