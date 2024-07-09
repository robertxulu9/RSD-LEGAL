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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $fileId = $_GET['id'];

    // Fetch file name from the database
    $result = $conn->query("SELECT file_name FROM files WHERE id = $fileId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fileName = $row['file_name'];

        // Check if the file exists before attempting to delete it
        $filePath = "uploads/$fileName";
        if (file_exists($filePath)) {
            // Delete record from the database
            $conn->query("DELETE FROM files WHERE id = $fileId");

            // Delete the file from the server
            unlink($filePath);

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File not found on the server']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File not found in the database']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

$conn->close();
?>
