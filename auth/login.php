<?php
session_start(); // Start the session
include('../theme/header.php');
include('../lib/auth.php');

// Handle signup form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Register the user (in this case, it's just checking if the user already exists)
        if (!register_user($username, $password)) {
            $error_message = "Username already taken or not allowed (admin/user1 only allowed).";
        } else {
            $_SESSION['username'] = $username;
            header('Location: ../app/index.php'); // Redirect to homepage after successful signup
            exit;
        }
    }
}
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Sign Up</h2>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="signup.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>

    <!-- Link to go back to the homepage -->
    <p class="mt-3"><a href="../app/index.php" class="btn btn-secondary">Back to Home</a></p>
</div>

<?php include('../theme/footer.php'); ?>

