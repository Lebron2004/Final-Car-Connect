<?php
session_start(); // Start the session
include('../theme/header.php');
include('../lib/auth.php');

// Handle signup form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Create new user
        if (register_user($email, $password)) {
            $_SESSION['user_email'] = $email; // Store user email in session
            header('Location: ../app/index.php'); // Redirect to homepage after successful signup
            exit;
        } else {
            $error_message = "An error occurred during registration.";
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
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
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

