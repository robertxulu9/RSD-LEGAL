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
    // Process form data\
        // Process form data
        $caseName = $_POST['caseName'];
        $caseNumber = $_POST['caseNumber'];
        $caseStage = $_POST['caseStage'];
        $dateOpened = $_POST['dateOpened'];
        $office = $_POST['office'];
        $description = $_POST['description'];
        $statuteOfLimitations = $_POST['statuteOfLimitations'];
    
        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO cases (caseName, caseNumber, caseStage, dateOpened, office, description, statuteOfLimitations)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = mysqli_prepare($conn, $sql);
    
        mysqli_stmt_bind_param($stmt, "sssssss", $caseName, $caseNumber, $caseStage, $dateOpened, $office, $description, $statuteOfLimitations);
    
        if (mysqli_stmt_execute($stmt)) {
            // Data inserted successfully
             header("Location:../cases.html");
        } else {
            // Error inserting data
            echo "Error inserting record: " . mysqli_error($conn);
        }
    
        mysqli_stmt_close($stmt);
    } else {
        // Form was not submitted
        echo "Please submit the form.";
    }
    
    // Close database connection
    mysqli_close($conn);
    
    ?>