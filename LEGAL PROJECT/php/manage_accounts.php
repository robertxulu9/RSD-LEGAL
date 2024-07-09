<?php
include ('admin_header.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <main>
    <div class="ms-auto mt-2 mb-2 d-flex align-items-center d-print-none">
                    <a type="button" href="registration_form.html" class="btn btn-primary mx-3">
                        Add User
    </a>
                  </div>
    </main>

    <?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check if connection succeeded
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

// Function to delete a user by ID
function deleteUser($conn, $userId) {
    $deleteQuery = "DELETE FROM users WHERE id = $userId";
    return mysqli_query($conn, $deleteQuery);
}

// Check if the "Delete" button is clicked
if (!empty($_POST['action']) && $_POST['action'] === 'delete' && !empty($_POST['userId'])) {
    $userIdToDelete = mysqli_real_escape_string($conn, $_POST['userId']);
    deleteUser($conn, $userIdToDelete);
}

// Retrieve user data from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch user data
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Display the table
    echo '<table>';
    echo '<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Gender</th><th>Position</th><th>Zipcode</th><th>City</th><th>Country</th><th>Number</th><th>Address</th><th>Action</th></tr>';

    foreach ($users as $user) {
        echo '<tr>';
        echo '<td><input type="text" name="fname" value="'.$user['fname'].'"></td>';
        echo '<td><input type="text" name="lname" value="'.$user['lname'].'"></td>';
        echo '<td><input type="text" name="email" value="'.$user['email'].'"></td>';
        echo '<td><input type="text" name="gender" value="'.$user['gender'].'"></td>';
        echo '<td><input type="text" name="position" value="'.$user['position'].'"></td>';
        echo '<td><input type="text" name="zipcode" value="'.$user['zipcode'].'"></td>';
        echo '<td><input type="text" name="city" value="'.$user['city'].'"></td>';
        echo '<td><input type="text" name="country" value="'.$user['country'].'"></td>';
        echo '<td><input type="text" name="number" value="'.$user['number'].'"></td>';
        echo '<td><input type="text" name="address" value="'.$user['address'].'"></td>';
        echo '<td>
                <button onclick="saveUser('.$user['id'].')">Save</button>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="userId" value="'.$user['id'].'">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit">Delete</button>
                </form>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

<script>
    function saveUser(userId) {
        // Implement AJAX or form submission to save the edited values to the database
        // For simplicity, this example just alerts the user ID and edited values
        alert('Save button clicked for user ID: ' + userId);
    }
</script>

</body>
</html>