<?php
// Assuming you have a database connection established
$conn = mysqli_connect('your_host', 'your_username', 'root', 'legal');

// Fetch practice areas from the database
$sql = "SELECT id, area_name FROM practice_areas";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    // Start the dropdown list
    echo '<select class="form-control" name="practiceArea" required>';
    
    // Iterate through the result set and create an option for each practice area
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['id'] . '">' . $row['area_name'] . '</option>';
    }

    // Close the dropdown list
    echo '</select>';

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle the case where the query fails
    echo "Error fetching practice areas: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
