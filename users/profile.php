<?php
session_start();
include('../lib/auth.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

$user = $_SESSION['user']; // Fetch user data from session (replace with database or JSON in real projects)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update profile logic here
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Update session or save changes to a file or database (implement saving here)
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['email'] = $email;
    
    header('Location: profile.php'); // Redirect to profile page after saving changes
    exit;
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Edit Profile</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<?php include('../theme/footer.php'); ?>
