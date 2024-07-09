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
    $practiceArea = mysqli_real_escape_string($conn, $_POST['practiceArea']);


    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO practice_area (practiceArea)
            VALUES (?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $practiceArea);

    if (mysqli_stmt_execute($stmt)) {
        header("Location:../practice_area.html");
    } else {
        echo "Error adding task: " . mysqli_error($conn);
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
