<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the POST data is set
if (isset($_POST['fname']) && isset($_POST['lname'])) {
    // Get the POST data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Print the POST data
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    echo "First Name: " . $fname . "<br>";
    echo "Last Name: " . $lname . "<br>";
} else {
    // Handle the case where the POST data is not set
    echo "Error: Please provide both first name and last name.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h2>Add User</h2>
    <form method="POST">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required>

        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
