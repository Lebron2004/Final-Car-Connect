<?php
session_start();

// Authenticate user (ensure they are logged in as admin)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    // Simulate fetching car data (replace with actual retrieval logic)
    // Example: $car = $_SESSION['cars'][$car_id];
    $car = ['name' => 'Toyota Corolla', 'year' => '2020', 'description' => 'Compact and reliable.']; // Example data

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the updated car data from the form
        $car_name = $_POST['name'];
        $car_year = $_POST['year'];
        $car_description = $_POST['description'];

        // Simulate updating car data (replace with actual update logic)
        // Example: $_SESSION['cars'][$car_id] = ['name' => $car_name, 'year' => $car_year, 'description' => $car_description];

        header('Location: car_listings.php');  // Redirect to car listings page
        exit;
    }
} else {
    echo "Car ID not provided.";
}
?>

<h2>Edit Car</h2>
<form method="POST">
    <label for="name">Car Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($car['name']); ?>" required><br><br>

    <label for="year">Year:</label>
    <input type="text" name="year" id="year" value="<?php echo htmlspecialchars($car['year']); ?>" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required><?php echo htmlspecialchars($car['description']); ?></textarea><br><br>

    <button type="submit">Update Car</button>
</form>
