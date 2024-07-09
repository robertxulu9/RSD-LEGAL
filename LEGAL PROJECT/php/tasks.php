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
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POSTi') {
  $taskId = $_POST['taskId'];

  // Update the task status to "Done" in the tasks table (you may need to adjust column names based on your actual table structure)
  $updateTaskQuery = "UPDATE tasks SET status = 'Done' WHERE task_id = '$taskId'";

  if (mysqli_query($conn, $updateTaskQuery)) {
     // echo "Task marked as done successfully!";

  } else {
      echo "Error marking task as done: " . mysqli_error($conn);
  }
}





// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $taskId = $_POST['taskId'];

  // Update the task status to "Done" in the tasks table (you may need to adjust column names based on your actual table structure)
  $updateTaskQuery = "UPDATE tasks SET status = 'Done' WHERE task_id = '$taskId'";

  if (mysqli_query($conn, $updateTaskQuery)) {
      // echo "Task marked as done successfully!";
      echo "<script>$('#success-toast').toast('show');</script>";
      echo "<script>setTimeout(function(){ window.location.href = 'tasks.php'; }, 5000);</script>";
  } else {
      echo "Error marking task as done: " . mysqli_error($conn);
  }
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
if ($_SERVER['REQUEST_METHOD'] === 'POSTi') {
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
  } else {
    echo "Error adding task: " . mysqli_error($conn);
  }
}
// Handle task deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTaskId'])) {
  $deleteTaskId = $_POST['deleteTaskId'];

  // Delete the task from the tasks table
  $deleteTaskQuery = "DELETE FROM tasks WHERE task_id = '$deleteTaskId'";
  
  if (mysqli_query($conn, $deleteTaskQuery)) {
      echo "Task deleted successfully!";
      // Redirect to the same page after deletion
      header('Location: ' . $_SERVER['PHP_SELF']);
      ob_end_flush();
  } else {
      echo "Error deleting task: " . mysqli_error($conn);
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <style type="text/css">
    @media (min-width: 576px) {
      .dropdown:hover>.dropdown-menu {
        display: block;

      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

  <body>
    <header>

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->
    <div class="d-flex align-items-center pb-3">
      <h3 class="my-3 mx-3 me-4 fw-bold"> Tasks</h3>

      <ul class="nav nav-pills flex-nowrap m-0 d-print-none">
        <li role="presentation" class="nav-item">

        </li>
        <li role="presentation" class="nav-item">
          <a class="nav-link " data-new-filters="{&quot;show_archived_clients&quot;:true}" href="#"></a>
        </li>
      </ul>

      <div class="ms-auto mx-3 d-flex align-items-center d-print-none">
          <a href="task.php" class="btn btn-primary">Add Task</a>

      </div>
    </div>



    <form method="post">
    <!-- Display table of tasks -->
    <div class="">
      <div class="container-flex">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Case Name</th>
              <th scope="col">Task Name</th>
              <th scope="col">Due Date</th>
              <th scope="col">Priority</th>
              <th scope="col">Description</th>
              <th scope="col">Reminder Date/Time</th>
              <th scope="col">Status</th>

              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
                    <?php foreach ($tasks as $task) : ?>
                        <tr>
                            <td><?php echo $task['caseName']; ?></td>
                            <td><?php echo $task['taskName']; ?></td>
                            <td><?php echo $task['dueDate']; ?></td>
                            <td><?php echo $task['priority']; ?></td>
                            <td><?php echo $task['description']; ?></td>
                            <td><?php echo $task['reminderDateTime']; ?></td>
                            <td><?php echo $task['status']; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="deleteTaskId" value="<?php echo $task['task_id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="taskId" value="<?php echo $task['task_id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Mark as Done</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
          </form>


          </header>
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