<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Reservations Confirmation</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/reservation.css">
</head>

<body>

<header>
</header>

<main>
    <div id="logo">
        <a href="..\HTML\homepage.php"><img src="../Images/Logo.png" alt="Delhi Club Logo"></a>
    </div>
    <br>
    <div class="confirmation-content">
        <h2>Reservation Confirmed</h2>
        <p><strong>Thank you for reserving a table at Delhi Club. We look forward to serving you!</strong></p><br>
        
        <?php
        session_start();
        
        if (isset($_SESSION['reservation'])) {
            $reservation = $_SESSION['reservation'];
            echo "<div class='reservation-details'>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($reservation['fullName']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($reservation['email']) . "</p>";
            echo "<p><strong>Contact Number:</strong> " . htmlspecialchars($reservation['contactNumber']) . "</p>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($reservation['date']) . "</p>";
            echo "<p><strong>Time:</strong> " . htmlspecialchars($reservation['time']) . "</p>";
            echo "<p><strong>Number of People:</strong> " . htmlspecialchars($reservation['numPeople']) . "</p>";
            echo "<p><strong>Notes:</strong> " . htmlspecialchars($reservation['notes']) . "</p>";
            echo "</div>";
        } else {
            echo "<p><strong>Error:</strong> Reservation details could not be retrieved. Please contact the restaurant for assistance.</p>";
        }
        
        unset($_SESSION['reservation']);
        ?>

        <p><br>If you need to modify or cancel your reservation, please contact us at <strong>0385107697</strong> or email us at <strong>delhiclub.parkdale@gmail.com.</strong></p>

        <br><a href="..\HTML\homepage.php" class="button">Return to Home</a>
    </div>
</main>

<footer>
</footer>

</body>
</html>