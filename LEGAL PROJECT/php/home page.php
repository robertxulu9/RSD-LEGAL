<?php
include ("header.php");
// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Assuming you have a table named 'cases'
$queryOpenCases = "SELECT COUNT(*) AS totalCases,
                          SUM(CASE WHEN dateOpened >= NOW() - INTERVAL 30 DAY THEN 1 ELSE 0 END) AS casesOpenedLast30Days,
                          -- SUM(CASE WHEN dateClosed >= NOW() - INTERVAL 30 DAY THEN 1 ELSE 0 END) AS casesClosedLast30Days,
                          SUM(CASE WHEN caseStage = 'discovery' THEN 1 ELSE 0 END) AS casesInDiscovery,
                          SUM(CASE WHEN caseStage = 'In Trial' THEN 1 ELSE 0 END) AS casesInTrial,
                          SUM(CASE WHEN caseStage = 'On Hold' THEN 1 ELSE 0 END) AS casesOnHold
                    FROM cases";

$resultOpenCases = mysqli_query($conn, $queryOpenCases);

// Assuming you have a table named 'tasks'
$queryTasks = "SELECT taskName,  dueDate, Priority, reminderDateTime FROM tasks"; 
// Function to get case name based on case_id
function getCaseName($conn, $case_id) {
  $query = "SELECT caseName FROM cases WHERE case_id = $case_id";
  $result = mysqli_query($conn, $query);
  
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row['caseName'];
  }

  return "N/A"; // Return N/A if no case name found
}

$resultTasks = mysqli_query($conn, $queryTasks);

// if ($resultTasks) {
//     // Close the database connection
//     mysqli_close($conn);
// }

if ($resultOpenCases) {
    $rowOpenCases = mysqli_fetch_assoc($resultOpenCases);

  
}
// Assuming you have a table named 'case_events' and another table named 'cases'
$query = "SELECT case_events.event_date, cases.caseName, cases.dateOpened, case_events.new_state
          FROM case_events
          INNER JOIN cases ON case_events.case_id = cases.case_id
          ORDER BY case_events.event_date DESC
          LIMIT 5";

$result = mysqli_query($conn, $query);
// Fetch today's events from the cases table
$queryCasesToday = "SELECT caseName, dateOpened
                   FROM cases
                   WHERE DATE(dateOpened) = CURDATE()";

$resultCasesToday = mysqli_query($conn, $queryCasesToday);

// Fetch today's events from the case_event table
$queryCaseEventsToday = "SELECT cases.caseName, case_events.event_date, case_events.new_state
                        FROM case_events
                        INNER JOIN cases ON case_events.case_id = cases.case_id
                        WHERE DATE(case_events.event_date) = CURDATE()
                        ORDER BY case_events.event_date DESC
                        LIMIT 5";

$resultCaseEventsToday = mysqli_query($conn, $queryCaseEventsToday);

// Fetch today's tasks from the tasks table
$queryTasksToday = "SELECT taskName, dueDate, Priority, reminderDateTime
                   FROM tasks
                   WHERE DATE(dueDate) = CURDATE()";

$resultTasksToday = mysqli_query($conn, $queryTasksToday);





if ($result) {
    $row = mysqli_fetch_assoc($result);

  
}
  // Close the database connection
  mysqli_close($conn);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>

<div class="card mt-2 mb-3 ms-3 mx-3 me-1">
      <div class="card-header">
        <h4 class="h5 fw-bold card-title">Add Item</h4>
      </div>

      <div class="card-body p-1 text-nowrap">
        <div class="dashboard-add-item-section d-flex">

          <div class="flex-fill p-3 text-center border-end">
            <div>
            <a href="documents.php">
          <div>
            <span class="material-symbols-outlined">description</span>
            <span class="d-none d-lg-inline">Document</span>
            </div>
            </a>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
          <a href="tasks.php">
          <div>          <span class="material-symbols-outlined">add_task</span>
          <span class="d-none d-lg-inline">Tasks</span>

            </div>
            </a>
            
            
          </div>


          <div class="flex-fill p-3 text-center border-end">
            <div>
            
          <div>
            
              <a href="contacts.php">

            </div><span class="material-symbols-outlined">contacts</span>
              <span class="d-none d-lg-inline"> Contact</span>
            </a>
            </div>
          </div>

          <div class="flex-fill p-3 text-center border-end">
            <div>
            
              <a href="cases.php">
          <div><span class="material-symbols-outlined">business_center</span>
              <span class="d-none d-lg-inline"> Case</span>

            </div>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
       
    <!-- ---------------------------------------------add items card ------------------------------------------------------------>

    
    
    
    <div class="container-flex mx-3">
  <div class="row">
    <div class="col-md-6">
      <div class="card" style="max-height: 500px;">
      <a href="cases.php" class="card-header">
          Cases
        </a>
        <div class="card-body">
        <div class="card-header">
      <h4>Case Statistics</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title text-center">Open Cases</h5>
                  <p class="card-text text-center bold"><?php echo $rowOpenCases['totalCases']; ?></p>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title text-center">In Trial</h5>
                  <p class="card-text text-center"><?php echo $rowOpenCases['casesInTrial']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title text-center">On Hold</h5>
                  <p class="card-text text-center"><?php echo $rowOpenCases['casesOnHold']; ?></p>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title text-center">In Discovery</h5>
                  <p class="card-text text-center"><?php echo $rowOpenCases['casesInDiscovery']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Open in the Last 30 Days</h5>
              <p class="card-text text-center"><?php echo $rowOpenCases['casesOpenedLast30Days']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
          <!-- Your PHP code for My Tasks card content goes here -->
          <!-- <p class="card-text">
                Number of Open Cases: <?php echo $rowOpenCases['totalCases']; ?><br>
                Number of Cases Opened in the Last 30 Days: <?php echo $rowOpenCases['casesOpenedLast30Days']; ?><br>
                Number of Cases Closed in the Last 30 Days: <?php echo $rowOpenCases['casesClosedLast30Days']; ?><br>
                Number of Cases in Discovery: <?php echo $rowOpenCases['casesInDiscovery']; ?><br>
                Number of Cases in Trial: <?php echo $rowOpenCases['casesInTrial']; ?><br>
                Number of Cases on Hold: <?php echo $rowOpenCases['casesOnHold']; ?><br>
            </p> -->
          <?php
            // Your PHP code for My Tasks card content goes here
          ?>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
    <div class="card" style="max-height: 500px; overflow-y: auto;">
        <a href="tasks.php" class="card-header">
            My Tasks
        </a>
        <div class="card-body">
            <h5 class="card-title">My Tasks</h5>
            <?php while ($rowTasks = mysqli_fetch_assoc($resultTasks)): ?>
                <p class="card-text">
                <?php
                    // Check if 'case_id' is set and not NULL
                    if (isset($rowTasks['case_id']) && $rowTasks['case_id'] !== null) {
                        echo 'Case Name: ' . getCaseName($conn, $rowTasks['case_id']) . '<br>';
                    } else {
                        echo 'Case Name: N/A<br>';
                    }
                    ?>
                    Task Name: <?php echo $rowTasks['taskName']; ?><br>
                    Due Date: <?php echo $rowTasks['dueDate']; ?><br>
                    Priority: <?php echo $rowTasks['Priority']; ?><br>
                    Reminder Date and Time: <?php echo $rowTasks['reminderDateTime']; ?><br>
                  </p>
                <hr>
            <?php endwhile; ?>
        </div>
    </div>
    </div>
</div>
      </div>
    </div>
  </div>
</div>
<!-- _____________________________________________________________________________________ -->
    
    <div class="container-flex mx-3">
  <div class="row mt-3">
    <div class="col-md-6">
      <div class="card" style="max-height: 500px; overflow-y: auto;">
      <a href="cases.php" class="card-header">
          Recent Case Activities
        </a>
        <div class="card-body">
          <!-- Your PHP code for My Tasks card content goes here -->
          <h5 class="card-title">Recent Activities</h5>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <p class="card-text">
                Case Name: <?php echo $row['caseName']; ?><br>
                Date Created: <?php echo $row['dateOpened']; ?><br>
                Case State: <?php echo $row['new_state']; ?><br>
                Time Case State Was Changed: <?php echo $row['event_date']; ?><br>
            </p>
            <hr>
        <?php endwhile; ?>
          <?php
            // Your PHP code for My Tasks card content goes here
          ?>
        </div>
      </div>
    </div>
    
    <div class="col-md-6">
      <div class="card">
      <a href="tasks.php" class="card-header">
         Todays Events
        </a>
        <div class="card-body">
          <!-- Your PHP code for Open Cases card content goes here -->

                      <!-- Display today's events from the cases table -->
                      <?php if (mysqli_num_rows($resultCasesToday) > 0): ?>
                <?php while ($rowCasesToday = mysqli_fetch_assoc($resultCasesToday)): ?>
                    <p class="card-text">
                        Case Name: <?php echo $rowCasesToday['caseName']; ?><br>
                        Date Opened: <?php echo $rowCasesToday['dateOpened']; ?><br>
                    </p>
                    <hr>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="card-text">No cases opened today.</p>
            <?php endif; ?>

            <!-- Display today's events from the case_event table -->
            <?php if (mysqli_num_rows($resultCaseEventsToday) > 0): ?>
                <?php while ($rowCaseEventsToday = mysqli_fetch_assoc($resultCaseEventsToday)): ?>
                    <p class="card-text">
                        Case Name: <?php echo $rowCaseEventsToday['caseName']; ?><br>
                        Event Date: <?php echo $rowCaseEventsToday['event_date']; ?><br>
                        Case State: <?php echo $rowCaseEventsToday['new_state']; ?><br>
                    </p>
                    <hr>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="card-text">No case events today.</p>
            <?php endif; ?>

            <!-- Display today's tasks from the tasks table -->
            <?php if (mysqli_num_rows($resultTasksToday) > 0): ?>
                <?php while ($rowTasksToday = mysqli_fetch_assoc($resultTasksToday)): ?>
                    <p class="card-text">
                        Task Name: <?php echo $rowTasksToday['taskName']; ?><br>
                        Due Date: <?php echo $rowTasksToday['dueDate']; ?><br>
                        Priority: <?php echo $rowTasksToday['Priority']; ?><br>
                        Reminder Date and Time: <?php echo $rowTasksToday['reminderDateTime']; ?><br>
                    </p>
                    <hr>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="card-text">No tasks today.</p>
            <?php endif; ?>
          
        </div>
      </div>
    </div>
  </div>
</div>


    

      
      <script>
    // Function to calculate the countdown
    function calculateCountdown(reminderDateTime) {
        const now = new Date();
        const reminderDate = new Date(reminderDateTime);
        const timeDifference = reminderDate - now;

        const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));

        return { days, hours, minutes };
    }

    // Function to update the countdown in the HTML
    function updateCountdown(elementId, reminderDateTime) {
        const countdown = calculateCountdown(reminderDateTime);
        const countdownElement = document.getElementById(elementId);

        if (countdownElement) {
            countdownElement.innerHTML = `Countdown: ${countdown.days} days, ${countdown.hours} hours, ${countdown.minutes} minutes`;
        }
    }

    // Update the countdown on page load
    updateCountdown('reminderCountdown', '<?php echo $rowTasks['reminderDateTime']; ?>');
</script>


<!-- 

// <style>
// .material-symbols-outlined {
//   font-variation-settings;
//   'FILL' 0,
//   'wght' 400,
//   'GRAD' 0,
//   'opsz' 24
// }
// </style> -->
   


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
   integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
   crossorigin="anonymous"></script>

</body>
</html>
