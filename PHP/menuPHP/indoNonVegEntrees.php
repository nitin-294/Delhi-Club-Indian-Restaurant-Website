<?php
    include "../PHP/dbConnection.php";

    $sql = "SELECT item_name, item_description, item_price FROM menuitems WHERE category_id = 17";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menuItem">';
            echo '<h3>' . htmlspecialchars($row["item_name"]) . '</h3>';
            echo '<p class="itemDescription">' . htmlspecialchars($row["item_description"]) . '</p>';
            echo '<p>$' . htmlspecialchars($row["item_price"]) . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } 
    else 

    {echo "No items found.";}

    $conn->close();
?>