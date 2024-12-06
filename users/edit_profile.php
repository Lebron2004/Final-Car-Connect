<?php
session_start();
include('../lib/auth.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$user = $_SESSION['user']; // Fetch user data from session (replace with database or JSON in real projects)

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Your Profile</h2>
    
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h4>Username: <?php echo htmlspecialchars($user['username']); ?></h4>
            <h4>Email: <?php echo htmlspecialchars($user['email']); ?></h4>
            <h4>Role: <?php echo ucfirst($user['role']); ?></h4>
            <a href="edit_profile.php" class="btn btn-warning mt-3">Edit Profile</a>
        </div>
    </div>
</div>

<?php include('../theme/footer.php'); ?>
