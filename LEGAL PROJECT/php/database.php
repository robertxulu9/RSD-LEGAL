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

    $sql = "INSERT INTO users (fname, lname) VALUES ('$fname', '$lname')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
} else {
    // Form was not submitted
    // Display a message indicating the form was not submitted
    echo "Please fill out the form and submit it.";
}

// Retrieve data from the database
$sql = "SELECT fname, lname FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<h2>List of Users</h2>';
    echo '<table>';
    echo '<tr><th>First Name</th><th>Last Name</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['fname'] . '</td>';
        echo '<td>' . $row['lname'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No users found';
}

// Close database connection
mysqli_close($conn);

?>
