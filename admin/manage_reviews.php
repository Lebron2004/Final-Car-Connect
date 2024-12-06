<?php
session_start();
include('../lib/auth.php');
if (!is_admin()) {
    header('Location: ../index.php'); // Redirect if not admin
    exit;
}

// Example array for reviews - this would come from a JSON or database in a real project
$reviews = [
    ['id' => 1, 'car_name' => 'Toyota Corolla', 'reviewer' => 'John Doe', 'rating' => 5, 'comment' => 'Great car!'],
    ['id' => 2, 'car_name' => 'Honda Civic', 'reviewer' => 'Jane Smith', 'rating' => 4, 'comment' => 'Good, but a bit pricey.'],
    // Add more reviews here
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_review'])) {
    // Handle delete logic (from a file or session)
    $id = $_POST['review_id'];
    // Delete review logic goes here (remove from the reviews array or update a JSON file)
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Reviews</h2>
    
    <a href="add_review.php" class="btn btn-primary mb-3">Add New Review</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Car Name</th>
                <th>Reviewer</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?php echo $review['car_name']; ?></td>
                    <td><?php echo $review['reviewer']; ?></td>
                    <td><?php echo $review['rating']; ?></td>
                    <td><?php echo $review['comment']; ?></td>
                    <td>
                        <a href="edit_review.php?id=<?php echo $review['id']; ?>" class="btn btn-warning">Edit</a>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                            <button type="submit" name="delete_review" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../theme/footer.php'); ?>
