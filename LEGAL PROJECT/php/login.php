<?php
// login.php

// Start a session
session_start();

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check if connection succeeded
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

// Initialize user ID and role variables
$userID = null;
$userRole = null;

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    // Form was submitted
    // Process login form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check the database for the user
    $loginSql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $loginSql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, login successful

            // Save user ID and role in session variables
            $_SESSION['userID'] = $row['id'];
            $_SESSION['userRole'] = $row['role'];

            // Check if the user is an admin
            if ($row['role'] == 'admin') {
                // Redirect to admin home page
                header("Location: admin_home.php");
            } else {
                // Redirect to regular user home page
                header("Location: home page.php");
            }
            exit(); // Ensure that code execution stops after the redirect
        } else {
            // Password is incorrect
            echo "Invalid email or password";
        }
    } else {
        // User is not registered
        echo "Invalid email or password";
    }
} else {
    // Form data is incomplete
    echo "Please enter both email and password";
}

// Close database connection
mysqli_close($conn);
?>
