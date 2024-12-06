<?php
session_start();
include('../lib/auth.php');
if (!is_admin()) {
    header('Location: ../index.php'); // Redirect if not admin
    exit;
}

// Example array for users - this would come from a JSON or database in a real project
$users = [
    ['id' => 1, 'username' => 'admin', 'role' => 'admin'],
    ['id' => 2, 'username' => 'user1', 'role' => 'user'],
    // Add more users here
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    // Handle delete logic (from a file or session)
    $id = $_POST['user_id'];
    // Delete user logic goes here (remove from the users array or update a JSON file)
}

include('../theme/header.php');
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Manage Users</h2>
    
    <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo ucfirst($user['role']); ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Edit</a>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../theme/footer.php'); ?>
