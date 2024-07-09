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
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $homePhone = mysqli_real_escape_string($conn, $_POST['home_phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $peopleGroup = mysqli_real_escape_string($conn, $_POST['peopleGroup']);
    $clientPortal = isset($_POST['clientPortal']) ? 1 : 0;

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO people (firstName, middleName, lastName, email, phone, home_Phone, address, address2, city, country, peopleGroup, clientPortal)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssssi", $firstName, $middleName, $lastName, $email, $phone, $homePhone, $address, $address2, $city, $country, $peopleGroup, $clientPortal);

    if (mysqli_stmt_execute($stmt)) {
        header("Location:contacts.php");
    } else {
        echo "Error adding person: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    // Form was not submitted
    // Display a message indicating the form was not submitted
    echo "Please submit the form.";
}

// Close database connection
mysqli_close($conn);
?>
