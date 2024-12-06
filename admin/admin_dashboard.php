<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../index.php'); // Redirect to homepage if the user is not an admin
    exit;
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Manage Pages</h4>
                </div>
                <div class="card-body">
                    <p>Here you can manage the pages of the website, create new pages, and update content.</p>
                    <a href="manage.php" class="btn btn-success">Manage Pages</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4>Manage Users</h4>
                </div>
                <div class="card-body">
                    <p>Here you can manage users, view user profiles, and modify user roles.</p>
                    <a href="manage_users.php" class="btn btn-danger">Manage Users</a>
                </div>
            </div>
        </div>
    </div>

    <p><a href="../index.php" class="btn btn-secondary">Back to Home</a></p>
</div>

<?php include('../theme/footer.php'); ?>
