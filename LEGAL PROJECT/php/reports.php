<?php
include("header.php");

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Cases Queries
$totalCasesQuery = "SELECT COUNT(*) as total_cases FROM cases";
$openCasesQuery = "SELECT COUNT(*) as open_cases FROM cases WHERE caseStage != 'Close case' ";
$casesInTrialQuery = "SELECT COUNT(*) as in_trial_cases FROM cases WHERE caseStage = 'In Trial'";
$closedCasesQuery = "SELECT COUNT(*) as closed_cases FROM cases WHERE caseStage = 'Close case'";
$casesLast30DaysQuery = "SELECT COUNT(*) as cases_last_30_days FROM cases WHERE dateOpened >= NOW() - INTERVAL 30 DAY";
// $closedLast30DaysQuery = "SELECT COUNT(*) as closed_last_30_days FROM cases WHERE caseStage = 'Close case' AND date_closed >= NOW() - INTERVAL 30 DAY";

// Execute queries
$totalCasesResult = mysqli_query($conn, $totalCasesQuery);
$openCasesResult = mysqli_query($conn, $openCasesQuery);
$casesInTrialResult = mysqli_query($conn, $casesInTrialQuery);
$closedCasesResult = mysqli_query($conn, $closedCasesQuery);
$casesLast30DaysResult = mysqli_query($conn, $casesLast30DaysQuery);
// $closedLast30DaysResult = mysqli_query($conn, $closedLast30DaysQuery);

// Fetch results
$totalCases = mysqli_fetch_assoc($totalCasesResult)['total_cases'];
$openCases = mysqli_fetch_assoc($openCasesResult)['open_cases'];
$casesInTrial = mysqli_fetch_assoc($casesInTrialResult)['in_trial_cases'];
$closedCases = mysqli_fetch_assoc($closedCasesResult)['closed_cases'];
$casesLast30Days = mysqli_fetch_assoc($casesLast30DaysResult)['cases_last_30_days'];
// $closedLast30Days = mysqli_fetch_assoc($closedLast30DaysResult)['closed_last_30_days'];


// Tasks Queries
$totalPeopleQuery = "SELECT COUNT(*) as total_people FROM people";
$totalCompaniesQuery = "SELECT COUNT(*) as total_companies FROM companies";
$totalTasksQuery = "SELECT COUNT(*) as total_tasks FROM tasks";
$tasksDoneQuery = "SELECT COUNT(*) as tasks_done FROM tasks WHERE status = 'Done'";

// Today's Tasks
$todayTasksQuery = "SELECT COUNT(*) as today_tasks FROM tasks WHERE DATE(dueDate) = CURDATE()";

// Tomorrow's Tasks
$tomorrowTasksQuery = "SELECT COUNT(*) as tomorrow_tasks FROM tasks WHERE DATE(dueDate) = CURDATE() + INTERVAL 1 DAY";

// Execute queries
$totalPeopleResult = mysqli_query($conn, $totalPeopleQuery);
$totalCompaniesResult = mysqli_query($conn, $totalCompaniesQuery);
$totalTasksResult = mysqli_query($conn, $totalTasksQuery);
$tasksDoneResult = mysqli_query($conn, $tasksDoneQuery);
$todayTasksResult = mysqli_query($conn, $todayTasksQuery);
$tomorrowTasksResult = mysqli_query($conn, $tomorrowTasksQuery);

// Fetch results
$totalPeople = mysqli_fetch_assoc($totalPeopleResult)['total_people'];
$totalCompanies = mysqli_fetch_assoc($totalCompaniesResult)['total_companies'];
$totalTasks = mysqli_fetch_assoc($totalTasksResult)['total_tasks'];
$tasksDone = mysqli_fetch_assoc($tasksDoneResult)['tasks_done'];
$todayTasks = mysqli_fetch_assoc($todayTasksResult)['today_tasks'];
$tomorrowTasks = mysqli_fetch_assoc($tomorrowTasksResult)['tomorrow_tasks'];

// Free up the result sets
mysqli_free_result($totalPeopleResult);
mysqli_free_result($totalCompaniesResult);
mysqli_free_result($totalTasksResult);
mysqli_free_result($tasksDoneResult);
mysqli_free_result($todayTasksResult);
mysqli_free_result($tomorrowTasksResult);

// Assuming you have a table named 'tasks'
$queryTasks = "SELECT taskName,  dueDate, Priority, reminderDateTime FROM tasks";
// Function to get case name based on case_id
function getCaseName($conn, $case_id)
{
    $query = "SELECT caseName FROM cases WHERE case_id = $case_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['caseName'];
    }

    return "N/A"; // Return N/A if no case name found
}

$resultTasks = mysqli_query($conn, $queryTasks);



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




// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Reports</title>
</head>

<body>

    <div class="container-flex mt-3 mx-4">
        <div class="row">

            <!-- Cases Card -->
            <div class="col-md-6 mb-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cases</h5>
                        <p class="card-text">Total: <?php echo $totalCases; ?></p>
                        <p class="card-text">Open: <?php echo $openCases; ?></p>
                        <p class="card-text">In Trial: <?php echo $casesInTrial; ?></p>
                        <p class="card-text">Closed: <?php echo $closedCases; ?></p>
                        <p class="card-text">Opened in Last 30 Days: <?php echo $casesLast30Days; ?></p>
                        <!-- <p class="card-text">Closed in Last 30 Days: <?php echo $closedLast30Days; ?></p> -->
                    </div>
                </div>
            </div>
            


            <!-- Contacts Card -->
            <div class="col-md-6 mb-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contacts</h5>
                        <p class="card-text">Total People Contacts: <?php echo $totalPeople; ?></p>
                        <p class="card-text">Total Companie: <?php echo $totalCompanies; ?></p>

                    </div>
                </div>
            </div>

            <!-- Account Activity Card -->
            <!-- <div class="col-md-6 mb-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Account Activity</h5>
                        Add relevant details based on your requirements
                    </div>
                </div>
            </div> -->

        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card" style="max-height: 500px; overflow-y: auto;">
                    <a href="tasks.php" class="card-header">
                        My Tasks
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">My Tasks</h5>
                        <?php while ($rowTasks = mysqli_fetch_assoc($resultTasks)) : ?>
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
    
    

    <!-- _____________________________________________________________________________________ -->

        <div class="container-flex">
            <div class="row mt-3">
                <div class="col">
                    <div class="card" style="max-height: 500px; overflow-y: auto;">
                        <a href="cases.php" class="card-header">
                            Recent Case Activities
                        </a>
                        <div class="card-body">
                            <!-- Your PHP code for My Tasks card content goes here -->
                            <h5 class="card-title">Recent Activities</h5>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <p class="card-text">
                                    Case Name: <?php echo $row['caseName']; ?><br>
                                    Date Created: <?php echo $row['dateOpened']; ?><br>
                                    Case State changed To: <?php echo $row['new_state']; ?><br>
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

                <div class="col">
                    <div class="card">
                        <a href="tasks.php" class="card-header">
                            Todays Events
                        </a>
                        <div class="card-body">
                            <!-- Your PHP code for Open Cases card content goes here -->

                            <!-- Display today's events from the cases table -->
                            <?php if (mysqli_num_rows($resultCasesToday) > 0) : ?>
                                <?php while ($rowCasesToday = mysqli_fetch_assoc($resultCasesToday)) : ?>
                                    <p class="card-text">
                                        Case Name: <?php echo $rowCasesToday['caseName']; ?><br>
                                        Date Opened: <?php echo $rowCasesToday['dateOpened']; ?><br>
                                    </p>
                                    <hr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p class="card-text">No cases opened today.</p>
                            <?php endif; ?>

                            <!-- Display today's events from the case_event table -->
                            <?php if (mysqli_num_rows($resultCaseEventsToday) > 0) : ?>
                                <?php while ($rowCaseEventsToday = mysqli_fetch_assoc($resultCaseEventsToday)) : ?>
                                    <p class="card-text">
                                        Case Name: <?php echo $rowCaseEventsToday['caseName']; ?><br>
                                        Event Date: <?php echo $rowCaseEventsToday['event_date']; ?><br>
                                        Case State: <?php echo $rowCaseEventsToday['new_state']; ?><br>
                                    </p>
                                    <hr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p class="card-text">No case events today.</p>
                            <?php endif; ?>

                            <!-- Display today's tasks from the tasks table -->
                            <?php if (mysqli_num_rows($resultTasksToday) > 0) : ?>
                                <?php while ($rowTasksToday = mysqli_fetch_assoc($resultTasksToday)) : ?>
                                    <p class="card-text">
                                        Task Name: <?php echo $rowTasksToday['taskName']; ?><br>
                                        Due Date: <?php echo $rowTasksToday['dueDate']; ?><br>
                                        Priority: <?php echo $rowTasksToday['Priority']; ?><br>
                                        Reminder Date and Time: <?php echo $rowTasksToday['reminderDateTime']; ?><br>
                                    </p>
                                    <hr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p class="card-text">No tasks today.</p>
                            <?php endif; ?>

                        </div>
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

            return {
                days,
                hours,
                minutes
            };
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


    </div>
    </div>

</body>

</html>