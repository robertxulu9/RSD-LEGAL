<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "legal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete selected contacts
if (isset($_POST['delete'])) {
    $selected_contacts = isset($_POST['selected_contacts']) ? $_POST['selected_contacts'] : array();

    foreach ($selected_contacts as $contact_id) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM people WHERE person_id = ?");
        $stmt->bind_param("i", $contact_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Search filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where_clause = $search ? "WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%' OR email LIKE '%$search%'" : '';

// Query to retrieve data from the people table with search filter
$sql = "SELECT * FROM people $where_clause";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Data Table</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>People Data</h2>
    <form method="get" action="">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" name="search" value="<?= htmlspecialchars($search) ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Search</button>
    </form>
    <form method="post" action="">
        <div class="table-responsive">
            <table class="table table-striped-columns">
                <thead class="table-light">
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Home Phone</th>
                    <th>Address</th>
                    <th>Address 2</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>People Group</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Loop through the result set and output data into the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selected_contacts[]' value='{$row['person_id']}'></td>";
                    echo "<td>{$row['person_id']}</td>";
                    echo "<td>{$row['firstName']}</td>";
                    echo "<td>{$row['middleName']}</td>";
                    echo "<td>{$row['lastName']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['home_phone']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['address2']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['country']}</td>";
                    echo "<td>{$row['peopleGroup']}</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-danger mb-3" name="delete">Delete Selected</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
