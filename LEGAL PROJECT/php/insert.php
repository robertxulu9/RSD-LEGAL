<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check if connection succeeded
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

// Check if form is submitted
if (!empty($_POST)) {
    // Form was submitted
    // Process form data
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $additional = mysqli_real_escape_string($conn, $_POST['additional']);
    $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO users (gender, role, position, fname, lname, email, password, address, additional, zipcode, city, country, number)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $gender, $role, $position, $fname, $lname, $email, $password, $address, $additional, $zipcode, $city, $country, $number);

    if (mysqli_stmt_execute($stmt)) {
        echo "user has added successfully";
        header("Location:manage_accounts.php");
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    // Form was not submitted
    // Display a message indicating the form was not submitted
    echo "Please fill out the form and submit it.";
}

// Close database connection
mysqli_close($conn);
?>
