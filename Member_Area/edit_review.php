<?php
session_start();
include('../lib/auth.php');
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user']; // Get user information from session
// Simulate fetching reviews from a database or JSON
$reviews = [
    ['car_id' => 1, 'review' => 'Great car, very comfortable.', 'rating' => 5],
    ['car_id' => 2, 'review' => 'Average performance, decent fuel efficiency.', 'rating' => 3],
];

// Get the car ID from the URL query string
$car_id = $_GET['car_id'] ?? null;
$review = null;

foreach ($reviews as $rev) {
    if ($rev['car_id'] == $car_id) {
        $review = $rev;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulate saving the edited review (you would update this in a database or JSON in real implementation)
    $new_review = $_POST['review'];
    $new_rating = $_POST['rating'];

    // Update review in session or data store (implement the save logic here)

    // Redirect back to the member dashboard
    header('Location: member_dashboard.php');
    exit;
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Review</h2>

    <?php if (!$review) : ?>
        <p class="text-danger">Review not found!</p>
    <?php else : ?>
        <form method="POST">
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" class="form-control" id="rating" name="rating" value="<?php echo $review['rating']; ?>" min="1" max="5" required>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea class="form-control" id="review" name="review" rows="4" required><?php echo htmlspecialchars($review['review']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    <?php endif; ?>
</div>

<?php include('../theme/footer.php'); ?>
