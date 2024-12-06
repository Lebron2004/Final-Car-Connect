<?php
session_start();

// Authenticate user (ensure they are logged in as admin)
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Simulate a list of cars (replace this with actual data retrieval)
$cars = [
    ['id' => 1, 'name' => 'Toyota Corolla', 'year' => 2020, 'description' => 'Compact and reliable.'],
    ['id' => 2, 'name' => 'Honda Civic', 'year' => 2021, 'description' => 'Fuel-efficient and stylish.'],
    // Add more cars here...
];

?>
<!-- Display all cars -->
<h2>Car Listings</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Year</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo htmlspecialchars($car['name']); ?></td>
            <td><?php echo $car['year']; ?></td>
            <td><?php echo htmlspecialchars($car['description']); ?></td>
            <td>
                <a href="edit_car.php?id=<?php echo $car['id']; ?>">Edit</a> |
                <a href="delete_car.php?id=<?php echo $car['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="create_car.php">Add New Car</a>
