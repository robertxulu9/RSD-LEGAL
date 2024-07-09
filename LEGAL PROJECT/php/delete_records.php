<?php
// Ensure that the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "legal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if records are selected for deletion
    if (isset($_POST['record']) && is_array($_POST['record'])) {
        $recordsToDelete = implode(',', $_POST['record']);
        $sql = "DELETE FROM people WHERE person_id IN ($recordsToDelete)";
        
        if ($conn->query($sql) === TRUE) {
            echo "Selected records deleted successfully";
        } else {
            echo "Error deleting records: " . $conn->error;
        }
    } else {
        echo "No records selected for deletion";
    }

// Ensure that the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'record' key is set in $_POST
    $recordIds = isset($_POST['record']) ? $_POST['record'] : [];

    // Debugging: Output received checkbox values
    echo '<pre>';
    print_r($recordIds);
    echo '</pre>';

    // Database connection and existing code...
    
    // The rest of your existing code for deletion...
    
} else {
    // Redirect to the main page if accessed directly
    header("Location: displaytable.php");
    exit();
}


    $conn->close();
} else {
    // Redirect to the main page if accessed directly
    header("Location: index.php");
    exit();
}
?>
