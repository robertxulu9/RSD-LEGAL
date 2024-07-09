<?php
include("header.php");

// Function to get case details
function getCaseDetails($caseId)
{
    $conn = mysqli_connect('localhost', 'root', '', 'legal');

    // Check if connection succeeded
    if (!$conn) {
        echo "Failed to connect to the database: " . mysqli_connect_error();
        exit();
    }



    // Check if $caseId is set and not empty
    if (!empty($caseId)) {
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM cases WHERE case_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $caseId);
        mysqli_stmt_execute($stmt);

        // Get result set
        $result = mysqli_stmt_get_result($stmt);

        // Fetch case details
        $caseDetails = mysqli_fetch_assoc($result);

        // Close statement
        mysqli_stmt_close($stmt);

        // Close database connection
        mysqli_close($conn);

        return $caseDetails;
    } else {
        // Handle caseId not set or empty

        // Close database connection
        mysqli_close($conn);

        return null;
    }
} // Function to update case state in the database and handle cases_closed/cases_open
function updateCaseState1($conn, $caseId, $newState)
{
    $updateQuery = "UPDATE cases SET caseStage = ? WHERE case_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $newState, $caseId);
}
// Function to insert a new event into the case_events table
function insertCaseEvent($conn, $caseId, $newState, $timestamp)
{
    $insertEventQuery = "INSERT INTO case_events (case_id, new_state, event_date) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertEventQuery);
    mysqli_stmt_bind_param($stmt, "iss", $caseId, $newState, $timestamp);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        echo "Error inserting case event: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        return false;
    }
}
function incrementCasesClosed($conn, $userID)
{
    $updateQuery = "UPDATE users SET cases_closed = cases_closed + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "i", $userID);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
    } else {
        // Handle the error as needed
        echo "Error incrementing cases_closed: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
    }
}


// Function to update case state in the database and handle cases_closed/cases_open and events
function updateCaseState($conn, $caseId, $newState)
{
    $updateQuery = "UPDATE cases SET caseStage = ? WHERE case_id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $newState, $caseId);

    if (mysqli_stmt_execute($stmt)) {
        // Case state updated successfully
        mysqli_stmt_close($stmt);

        // Get the timestamp when the case state is changed
        $timestamp = date('Y-m-d H:i:s');

        // Insert a new event with the timestamp
        insertCaseEvent($conn, $caseId, $newState, $timestamp);



        // Function to increment cases_closed in the users table



        return $timestamp;
    } else {
        // Error updating case state
        mysqli_stmt_close($stmt);
        echo "Error updating case state: " . mysqli_error($conn);
        return false;
    }
}
// Function to get case events
function getCaseEvents($conn, $caseId)
{
    $eventsQuery = "SELECT * FROM case_events WHERE case_id = ? ORDER BY event_date DESC";
    $stmt = mysqli_prepare($conn, $eventsQuery);
    mysqli_stmt_bind_param($stmt, "i", $caseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }

    return $events;
}
// Function to get case lead based on the case ID
function getCaseLead($conn, $caseId)
{
    $caseLeadQuery = "SELECT CONCAT(fname, ' ', lname) AS fullName FROM users
                    INNER JOIN case_clients ON users.id = case_clients.clientId
                    WHERE case_clients.caseId = $caseId";

    $caseLeadResult = mysqli_query($conn, $caseLeadQuery);

    if ($caseLeadResult) {
        $caseLeadRow = mysqli_fetch_assoc($caseLeadResult);
        return $caseLeadRow ? $caseLeadRow['fullName'] : null; // Check if $caseLeadRow is not null
    } else {
        return "N/A"; // Return a default value if there is an error
    }
}



// Get the case ID from the URL parameter
$caseId = isset($_GET['case_id']) ? $_GET['case_id'] : null;

// Fetch case details based on the case ID
$caseDetails = getCaseDetails($caseId);

// Check if case details are retrieved successfully
if ($caseDetails) {
    // Establish a database connection
    $conn = mysqli_connect('localhost', 'root', '', 'legal');

    // Check if connection succeeded
    if (!$conn) {
        echo "Failed to connect to the database: " . mysqli_connect_error();
        exit();
    }
    // Handle button events
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the case ID and new state are provided
        if (isset($_POST['caseId']) && isset($_POST['newState'])) {
            $caseId = $_POST['caseId'];
            $newState = $_POST['newState'];

            // Update the case state
            if (updateCaseState($conn, $caseId, $newState)) {
                // Case state updated successfully
                echo "Case state updated to $newState";
                // Check if the new state is "Close case"
                if (isset($_POST['newState']) && $_POST['newState'] === "Close case") {
                    // Get the user_id associated with the case from the session
                    $userID = $_SESSION['id'] ?? null;

                    // Update cases_closed in the users table
                    if ($userID !== null) {
                        incrementCasesClosed($conn, $userID);

                        // Disable other buttons
                        echo '<script>
                            document.querySelectorAll("button[name=newState]").forEach(function(button) {
                                button.disabled = true;
                            });
                        </script>';
                    } else {
                        echo "Error: User ID not found in the session.";
                        echo ("id here: " . $userID);
                    }
                }
            } else {
                // Error updating case state
                echo "Error updating case state.";
            }

            // Close database connection
            mysqli_close($conn);
            exit();
        } else {
            // Handle case details not retrieved
            echo "Error: Case details not found.";
        }
    }
    function deleteCase (){
        $conn = mysqli_connect('localhost', 'root', '', 'legal');

        if (isset($_GET['case_id'])) {
            $case_id = $_GET['case_id'];
    
            // Perform the deletion query
            // Replace 'your_table_name' with the actual name of your cases table
            $sql = "DELETE FROM cases WHERE case_id = $case_id";
    
            // Execute the query
            // Replace 'your_connection_variable' with your database connection variable
            if (mysqli_query($conn, $sql)) {
                // Redirect back to the case listing page or any other appropriate page
                header('Location: cases.php');
                exit;
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid case_id";
        }
    

    }
   
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Add your head content here, e.g., meta tags, title, stylesheets -->
        <title>Case Details</title>
        <!-- Bootstrap CSS -->
        <script>
            function confirmClose() {
                var confirmResult = confirm("Are you sure you want to close this case?");
                if (confirmResult) {
                    // If the user clicks "OK," submit the form
                    document.forms[0].submit(); // Assumes the form is the first form on the page
                } else {
                    // If the user clicks "Cancel," do nothing
                }
            }
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>

        <div class="container-flex mt-3 mx-3">

            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Contact Info:</h5>
                            <p>Lead Attorney: <?php
                                                $caseLead = getCaseLead($conn, $caseId);
                                                echo '<td>' . ($caseLead !== null ? $caseLead : 'N/A') . '</td>'; ?></p>
                            <p>Description: <?php echo isset($caseDetails['description']) ? $caseDetails['description'] : 'N/A'; ?></p>
                            <p>Date Created: <?php echo isset($caseDetails['dateOpened']) ? $caseDetails['dateOpened'] : 'N/A'; ?></p>
                            <p>Case State:
                                <span id="caseState"><?php echo isset($caseDetails['caseStage']) ? $caseDetails['caseStage'] : 'N/A'; ?></span>
                            <form method="post">
                                <button type="submit" name="newState" value="In Trial" class="btn btn-primary">In Trial</button>
                                <button type="submit" name="newState" value="Discovery" class="btn btn-primary">Discovery</button>
                                <br>
                                <div class="mt-1"></div>
                                <button type="submit" name="newState" value="On Hold" class="btn btn-primary">On Hold</button>
                                <button type="submit" name="newState" value="Close case" class="btn btn-danger" onclick="confirmClose()">Close Case</button>
                                 <input type="hidden" name="caseId" value="<?php echo $caseId; ?>">
                                 <!-- <a href="#" class="btn btn-danger" id="deleteButton">Delete</a> -->
                            </form>
                            </p>
                        </div>
                    </div>


                <div class="card mt-3">
                    <div class="card-body">
                    <h5 class="card-title">Case Documents</h5>
                    <ul>
                        <?php
                        // Establish a new connection for retrieving files
                        $filesConn = mysqli_connect('localhost', 'root', '', 'legal');

                        // Check if connection succeeded
                        if (!$filesConn) {
                            echo "Failed to connect to the database: " . mysqli_connect_error();
                            exit();
                        }

                        // Query to get file names and file IDs from the files table
                        $filesQuery = "SELECT file_id, file_name FROM files WHERE case_id = ?";
                        $filesStmt = mysqli_prepare($filesConn, $filesQuery);
                        mysqli_stmt_bind_param($filesStmt, "i", $caseId);
                        mysqli_stmt_execute($filesStmt);
                        $filesResult = mysqli_stmt_get_result($filesStmt);

                        // Display the list of files
                        while ($file = mysqli_fetch_assoc($filesResult)) {
                            echo "<li>{$file['file_name']} (File ID: {$file['file_id']})</li>";

                        }

                        // Close the statement and the connection
                        mysqli_stmt_close($filesStmt);
                        mysqli_close($filesConn);
                        ?>
                            <!-- Button to Navigate to documents.php with case_id Filter -->
                        <a href="documents.php?case_id=<?php echo $caseId; ?>" class="btn btn-primary mt-3">View Case Documents</a>
                    </ul>
                </div>
                    </div>
                </div>
                

                

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Case Timeline</h5>
                            <p>Date Created: <?php echo isset($caseDetails['dateOpened']) ? $caseDetails['dateOpened'] : 'N/A'; ?></p>

                            <?php
                            $caseEvents = getCaseEvents($conn, $caseId);
                            if (!empty($caseEvents)) {
                                foreach ($caseEvents as $event) {
                                    echo "<p>{$event['new_state']}:  {$event['event_date']} </p>";
                                }
                            } else {
                                echo "<p>No events found.</p>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Case Information</h5>
                            <p>Case Name: <?php echo $caseDetails['caseName']; ?></p>
                            <p>Case Number: <?php echo $caseDetails['caseNumber']; ?></p>
                            <p>Case ID: <?php echo $caseDetails['case_id']; ?></p>
                            <p>Description: <?php echo $caseDetails['description']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tasks</h5>
                            <!-- Display tasks related to the case -->
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Events</h5>
                            <?php

                            $caseEvents = getCaseEvents($conn, $caseId);
                            if (!empty($caseEvents)) {
                                foreach ($caseEvents as $event) {

                                    echo "<p>{$caseDetails['caseName']}</p>";
                                    echo "Case state changed";
                                    echo "<p>{$event['event_date']} - {$event['new_state']}</p>";
                                }
                            } else {
                                echo "<p>No events found.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- ... (existing code) ... -->

        <!-- Bootstrap JS and Popper.js scripts -->
        <script>
            document.getElementById('deleteButton').addEventListener('click', function() {
                var confirmDelete = confirm("Are you sure you want to delete this case?");
                if (confirmDelete) {
                    // Redirect to the PHP script that handles the deletion
                    window.location.href = 'delete_case.php?case_id=<?php echo $_GET["case_id"]; ?>';
                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.2/js/bootstrap.min.js"></script>

    </body>

    </html>
<?php
} else {
    // Handle case details not retrieved
    echo "Error: Case details not found.";
}
?>