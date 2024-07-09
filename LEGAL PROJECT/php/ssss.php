<?php
// Establish a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data for the dropdown
$sqlDropdown = "SELECT DISTINCT case_id, caseName FROM cases";
$resultDropdown = mysqli_query($conn, $sqlDropdown);

// Check for errors
if (!$resultDropdown) {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyIdQ5fST41z6L4N/EDDDSTIOnEefHw3bM" crossorigin="anonymous">
    <title>Your Page Title</title>
</head>
<body>

<div class="container mt-5">
    <form method="post" action="">
        <div class="input-group">
            <select class="custom-select" id="search_option" name="search_option">
                <?php
                // Populate the dropdown with options from the database
                while ($row = mysqli_fetch_assoc($resultDropdown)) {
                    $caseId = $row['case_id'];
                    $caseName = $row['caseName'];
                    $url = "case_details.php?case_id=" . $caseId; // Adjust the URL structure as needed
                    echo "<option value='$caseId'>$caseName</option>";
                }
                ?>
            </select>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">View Case</button>
            </div>
        </div>
    </form>

    <?php
    // Your PHP code to process form submission and display results
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-Lz9J6TEo3+hY4r6IKiQBX/e2IuR/9fWMQjCtT9qU6GoD+lCv15z5S/7orjKuSg0r" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyIdQ5fST41z6L4N/EZFi5K3JmOI16YmTlG" crossorigin="anonymous"></script>

</body>
</html>