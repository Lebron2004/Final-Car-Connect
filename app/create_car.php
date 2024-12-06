<?php
session_start();

// Authenticate user (ensure they are logged in as admin)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate saving car data
    $car_name = $_POST['name'];
    $car_year = $_POST['year'];
    $car_description = $_POST['description'];

    // Save the car to the session or a file (Replace with actual saving logic)
    // Example: $_SESSION['cars'][] = ['name' => $car_name, 'year' => $car_year, 'description' => $car_description];

    header('Location: car_listings.php');  // Redirect to car listings page
    exit;
}
?>

<h2>Create a New Car</h2>
<form method="POST">
    <label for="name">Car Name:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label for="year">Year:</label>
    <input type="text" name="year" id="year" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea><br><br>

    <button type="submit">Create Car</button>
</form>
