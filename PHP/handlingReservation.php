<?php
session_start();

include 'dbConnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $contactNumber = htmlspecialchars($_POST['contactNumber']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $numPeople = htmlspecialchars($_POST['numPeople']);
    $notes = htmlspecialchars($_POST['notes']);

    if (empty($fullName) || empty($email) || empty($contactNumber) || empty($date) || empty($time) || empty($numPeople)) {
        header("Location: ../HTML/reservation.php?error=All fields are required.");
        exit();
    } elseif ($numPeople < 1 || $numPeople > 8) {
        header("Location: ../HTML/reservation.php?error=Number of people must be between 1 and 8.");
        exit();
    } else {
        $sql = "INSERT INTO reservations (fullName, email, contactNumber, date, time, numPeople, notes) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssis", $fullName, $email, $contactNumber, $date, $time, $numPeople, $notes);

            if ($stmt->execute()) {
                $_SESSION['reservation'] = [
                    'fullName' => $fullName,
                    'email' => $email,
                    'contactNumber' => $contactNumber,
                    'date' => $date,
                    'time' => $time,
                    'numPeople' => $numPeople,
                    'notes' => $notes
                ];

                header("Location: ../HTML/reservationConfirmation.php");
                exit();
            } else {
                header("Location: ../HTML/reservation.php?error=Error executing query. Please try again later.");
                exit();
            }
            $stmt->close();
        } else {
            header("Location: ../HTML/reservation.php?error=Error preparing query. Please try again later.");
            exit();
        }
    }
}