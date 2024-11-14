<!DOCTYPE html>
<html>
<head>
    <title>Delhi Club Indian Restaurant - Reservations</title>
    <link rel="stylesheet" href="../CSS/basicLayout.css">
    <link rel="stylesheet" href="../CSS/reservation.css">
    <script src="../JavaScript/reserveValidation.js"></script>
</head>

<body>

<header>
</header>

<main>
    <div id="logo">
        <a href="..\HTML\homepage.php"><img src="../Images/Logo.png" alt="Delhi Club Logo"></a>
    </div>
    <div class="mainContent">
        <div class="bookingForm">
            <h1>Reserve Table</h1>
            <br>
            <form action="../PHP/handlingReservation.php" method="post" onsubmit="return validateForm()">
                <div class="form-row">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName">
                    <span id="fullNameError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date">
                    <span id="dateError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email">
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="contactNumber">Contact Number:</label>
                    <input type="tel" id="contactNumber" name="contactNumber" pattern="[0-9]{10}">
                    <span id="contactNumberError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time">
                    <span id="timeError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="numPeople">Number of People:</label>
                    <input type="number" id="numPeople" name="numPeople" min="1">
                    <span id="numPeopleError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <label for="notes">Notes:</label>
                    <textarea id="notes" name="notes" rows="4" cols="50"></textarea>
                    <span id="notesError" class="error-message"></span>
                </div>
                <div class="form-row">
                    <button type="submit">Book Now</button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer>
</footer>

</body>
</html>
