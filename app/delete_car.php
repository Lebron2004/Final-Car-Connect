<?php
session_start();

// Authenticate user (ensure they are logged in as admin)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Simulate deleting the car (replace this with actual deletion logic)
    // For example, remove the car from the session array or file.
    // Example: unset($_SESSION['cars'][$car_id]);

    header('Location: car_listings.php');  // Redirect to car listings page
    exit;
} else {
    echo "Car ID not provided.";
}
?>
