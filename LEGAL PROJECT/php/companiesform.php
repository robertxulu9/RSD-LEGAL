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
    $companyName = mysqli_real_escape_string($conn, $_POST['companyName']);
    $companyEmail = mysqli_real_escape_string($conn, $_POST['companyEmail']);
    $companyWebsite = mysqli_real_escape_string($conn, $_POST['companyWebsite']);
    $mainPhone = mysqli_real_escape_string($conn, $_POST['Main_phone']);
    $fax = mysqli_real_escape_string($conn, $_POST['fax']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $privateNotes = mysqli_real_escape_string($conn, $_POST['private_notes']);

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO companies (companyName, companyEmail, companyWebsite, Main_Phone, fax, address, address2, country, private_notes)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssss", $companyName, $companyEmail, $companyWebsite, $mainPhone, $fax, $address, $address2, $country, $privateNotes);

    if (mysqli_stmt_execute($stmt)) {
        header("Location:companies.php");
    } else {
        echo "Error adding company: " . mysqli_error($conn);
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
