<?php
session_start();
include('../lib/auth.php');
if (!is_admin()) {
    header('Location: ../index.php'); // Redirect if not admin
    exit;
}

// Example array for cars - this would come from a JSON or database in a real project
$cars = [
    ['id' => 1, 'name' => 'Toyota Corolla', 'model' => '2020', 'price' => '$20,000'],
    ['id' => 2, 'name' => 'Honda Civic', 'model' => '2021', 'price' => '$22,000'],
    // Add more cars here
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_car'])) {
    // Handle delete logic (from a file or session)
    $id = $_POST['car_id'];
    // Delete car logic goes here (remove from the cars array or update a JSON file)
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Cars</h2>
    
    <a href="add_car.php" class="btn btn-primary mb-3">Add New Car</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Model</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo $car['name']; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td><?php echo $car['price']; ?></td>
                    <td>
                        <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn btn-warning">Edit</a>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                            <button type="submit" name="delete_car" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../theme/footer.php'); ?>
