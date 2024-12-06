<?php
session_start();
include('../lib/auth.php');
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

$cars = [
    ['id' => 1, 'name' => 'Toyota Corolla', 'year' => 2020, 'description' => 'A compact and efficient car.'],
    ['id' => 2, 'name' => 'Honda Civic', 'year' => 2021, 'description' => 'A reliable and stylish car.'],
    ['id' => 3, 'name' => 'Ford Focus', 'year' => 2019, 'description' => 'A practical and affordable car.'],
];

// Get the car ID from the URL query string
$car_id = $_GET['id'] ?? null;
$car = null;

foreach ($cars as $car_item) {
    if ($car_item['id'] == $car_id) {
        $car = $car_item;
        break;
    }
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4"><?php echo htmlspecialchars($car['name']); ?></h2>

    <?php if (!$car) : ?>
        <p class="text-danger">Car not found!</p>
    <?php else : ?>
        <p><strong>Year:</strong> <?php echo $car['year']; ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
    <?php endif; ?>

    <a href="member_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>

<?php include('../theme/footer.php'); ?>
