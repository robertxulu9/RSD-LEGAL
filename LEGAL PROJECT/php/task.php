<?php
ob_start();
include("header.php");

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Fetch tasks from the database
$tasksQuery = "SELECT * FROM tasks";
$tasksResult = mysqli_query($conn, $tasksQuery);

// Check if the query was successful
if ($tasksResult) {
    // Fetch tasks as an associative array
    $tasks = mysqli_fetch_all($tasksResult, MYSQLI_ASSOC);
} else {
    // Handle the error
    $tasks = [];
    echo "Error fetching tasks: " . mysqli_error($conn);
}
// Fetch tasks with associated case names from the database
$tasksQuery = "SELECT tasks.*, cases.caseName 
               FROM tasks 
               LEFT JOIN cases ON tasks.case_id = cases.case_id";
$tasksResult = mysqli_query($conn, $tasksQuery);

// Check if the query was successful
if ($tasksResult) {
    // Fetch tasks as an associative array
    $tasks = mysqli_fetch_all($tasksResult, MYSQLI_ASSOC);
} else {
    // Handle the error
    $tasks = [];
    echo "Error fetching tasks: " . mysqli_error($conn);
}

// Function to get the list of cases
function getCaseList($conn)
{
    $caseListQuery = "SELECT case_id, caseName FROM cases";
    $result = mysqli_query($conn, $caseListQuery);

    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Function to get the case lead based on the case ID
function getCaseLead($conn, $caseId)
{
    // Ensure $caseId is not empty
    if (empty($caseId)) {
        return "N/A";
    }

    $caseLeadQuery = "SELECT CONCAT(fname, ' ', lname) AS fullName FROM users
                    INNER JOIN case_clients ON users.id = case_clients.clientId
                    WHERE case_clients.caseId = $caseId";

    $caseLeadResult = mysqli_query($conn, $caseLeadQuery);

    if ($caseLeadResult) {
        $caseLeadRow = mysqli_fetch_assoc($caseLeadResult);
        return $caseLeadRow ? $caseLeadRow['fullName'] : "N/A";
    } else {
        return "N/A";
    }
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caseId = $_POST['caseId'];
    $taskName = $_POST['taskName'];
    $dueDate = $_POST['dueDate'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];
    $reminderDateTime = $_POST['reminderDateTime'];



    // Insert task into the tasks table (you may need to adjust column names based on your actual table structure)
    $insertTaskQuery = "INSERT INTO tasks (case_id, taskName, dueDate, priority, description, reminderDateTime)
                        VALUES ('$caseId', '$taskName', '$dueDate', '$priority', '$description', '$reminderDateTime')";

    if (mysqli_query($conn, $insertTaskQuery)) {
        echo "Task added successfully!";
        header('Location: tasks.php');
        ob_end_flush();
    } else {
        echo "Error adding task: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Task</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-lg-4 mt-5">
        <h2>Add Task</h2>

        <form method="post">
            <div class="form-group">
                <label for="caseId">Select Case:</label>
                <select class="form-control" name="caseId" id="caseId" required>
                    <?php
                    $caseList = getCaseList($conn);
                    foreach ($caseList as $case) {
                        echo "<option value='{$case['case_id']}'>{$case['caseName']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="taskName">Task Name:</label>
                <input type="text" class="form-control" name="taskName" required>
            </div>
            <div class="form-group">
                <label for="dueDate">Due Date:</label>
                <input type="date" class="form-control" name="dueDate" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select class="form-control" name="priority" required>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="reminderDateTime">Reminder Date and Time:</label>
                <input type="datetime-local" class="form-control" name="reminderDateTime" required>
            </div>

            <span>
                <button type="submit" class="btn btn-primary">Add Task</button>
                <a href="tasks.php" class="btn btn-secondary">Cancel</a>
            </span>
        </form>
    </div>




    <!-- Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- JavaScript to update case lead based on selected case -->
    <script>
        document.querySelector('#caseId').addEventListener('change', function() {
            var caseId = this.value;
            var caseLeadSpan = document.getElementById('caseLead');

            // Fetch case lead and update span text
            <?php
            echo "var caseLead = '" . getCaseLead($conn, '') . "';";
            echo "caseLeadSpan.textContent = caseLead;";
            ?>
        });
    </script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>