<?php
// Function to check if the user is an admin or a regular user
function login_user($username, $password) {
    // Define two users: admin and regular user
    $users = [
        'admin' => [
            'username' => 'admin',
            'password' => 'admin',
            'role' => 'admin',
        ],
        'user1' => [
            'username' => 'user1',
            'password' => 'user1',
            'role' => 'user',
        ],
    ];

    // Check if the username exists and password matches
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        // Set the session variables
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role']; // Store user role
        return true;
    }
    return false;
}

// Function to register a new user (for simplicity, we'll skip actual user creation and just simulate)
function register_user($username, $password) {
    // In a real-world scenario, you would insert the user into a database here
    // For now, we're only supporting two users: 'admin' and 'user1'
    if ($username === 'admin' || $username === 'user1') {
        return false; // User already exists
    }
    return true; // Simulate successful registration
}
?>
