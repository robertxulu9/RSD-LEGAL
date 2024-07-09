<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Case</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">


    <h1>Add New Case</h1>

    <?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check if connection succeeded
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

// Fetch clients from the people table
$clientQuery = "SELECT person_id, firstName FROM people";
$clientResult = mysqli_query($conn, $clientQuery);

// Fetch users from the users table for case lead selection
$userQuery = "SELECT id, CONCAT(fname, ' ', lname) AS fullName FROM users";
$userResult = mysqli_query($conn, $userQuery);

// Check if form is submitted
if (!empty($_POST)) {
    // Process form data
    $caseName = $_POST['caseName'];
    $caseNumber = $_POST['caseNumber'];
    $caseStage = $_POST['caseStage'];
    $dateOpened = $_POST['dateOpened'];
    $office = $_POST['office'];
    $description = $_POST['description'];
    $statuteOfLimitations = $_POST['statuteOfLimitations'];
    $selectedClients = isset($_POST['selectedClients']) ? $_POST['selectedClients'] : [];

    // Retrieve selected case lead ID
    $caseLeadId = $_POST['case_lead'];

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO cases (caseName, caseNumber, caseStage, dateOpened, office, description, statuteOfLimitations)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssssss", $caseName, $caseNumber, $caseStage, $dateOpened, $office, $description, $statuteOfLimitations);

    if (mysqli_stmt_execute($stmt)) {
        // Get the case ID of the newly inserted case
        $caseId = mysqli_insert_id($conn);

        // Associate selected clients with the case
        foreach ($selectedClients as $clientId) {
            $sql = "INSERT INTO case_clients (caseId, clientId) VALUES (?, ?)";
            $stmtClient = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmtClient, "ii", $caseId, $clientId);
            mysqli_stmt_execute($stmtClient);
            mysqli_stmt_close($stmtClient);
        }
                // Associate selected case lead with the case
                $sql = "INSERT INTO case_clients (caseId, clientId) VALUES (?, ?)";
                $stmtLead = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmtLead, "ii", $caseId, $caseLeadId);
                mysqli_stmt_execute($stmtLead);
                mysqli_stmt_close($stmtLead);
        
                // Increment the ncases field for the selected case lead
                $sqlIncrementNcases = "UPDATE users SET ncases = ncases + 1 WHERE id = ?";
                $stmtIncrementNcases = mysqli_prepare($conn, $sqlIncrementNcases);
                mysqli_stmt_bind_param($stmtIncrementNcases, "i", $caseLeadId);
                mysqli_stmt_execute($stmtIncrementNcases);
                mysqli_stmt_close($stmtIncrementNcases);
        
                // Data inserted successfully
                echo '<div class="alert alert-success" role="alert">Case added successfully.</div>';

        // Associate selected case lead with the case
        $sql = "INSERT INTO case_clients (caseId, clientId) VALUES (?, ?)";
        $stmtLead = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmtLead, "ii", $caseId, $caseLeadId);
        mysqli_stmt_execute($stmtLead);
        mysqli_stmt_close($stmtLead);

        // Data inserted successfully
        echo '<div class="alert alert-success" role="alert">Case added successfully.</div>';
    } else {
        // Error inserting data
        echo '<div class="alert alert-danger" role="alert">Error inserting record: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt); // Close the main statement after both operations
}

    // Fetch clients from the people table
    $clientQuery = "SELECT person_id, firstName FROM people";
    $clientResult = mysqli_query($conn, $clientQuery);

    // Fetch users from the users table for case lead selection
    $userQuery = "SELECT id, CONCAT(fname, ' ', lname) AS fullName FROM users";
    $userResult = mysqli_query($conn, $userQuery);

        // Function to get Case Lead based on case ID
        function getCaseLead($conn, $caseId) {
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
  
    
?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add case
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Case</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="form-group">
          <label for="selectedClients">Select Clients:</label>
          <select class="form-control" name="selectedClients[]" multiple>
              <?php
              // Populate clients in the dropdown
              while ($row = mysqli_fetch_assoc($clientResult)) {
                  echo '<option value="' . $row['person_id'] . '">' . $row['firstName'] . '</option>';
              }
              ?>
          </select>
      </div>
      <div class="form-group">
            <label for="caseLead">Select Case Lead:</label>
            <select class="form-control" name="case_lead" required>
                <?php
                // Populate case leads in the dropdown
                while ($userRow = mysqli_fetch_assoc($userResult)) {
                    echo '<option value="' . $userRow['id'] . '">' . $userRow['fullName'] . '</option>';
                }
                ?>
            </select>
        </div>
      <div class="form-group">
        <label for="caseName">Case Name:</label>
        <input type="text" name="caseName" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="caseNumber">Case Number:</label>
        <input type="text" name="caseNumber" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="caseStage">Case Stage:</label>
        <select class="form-control" name="caseStage" required>
            <option value="discovery">Discovery</option>
            <option value="In Trial">In Trial</option>
            <option value="On Hold">On Hold</option>
        </select>
    </div>
    

    <div class="form-group">
        <label for="dateOpened">Date Opened:</label>
        <input type="date" name="dateOpened" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="office">Office:</label>
        <input type="text" name="office" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="statuteOfLimitations">Statute of Limitations:</label>
        <input type="date" name="statuteOfLimitations" class="form-control" required>
    </div>


      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"data-bs-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>


  

<form action="" method="post">


</form>


<?php
    // Fetch cases and associated clients from the database
    $query = "SELECT case_id, caseName, caseNumber, caseStage, dateOpened, office, description, statuteOfLimitations FROM cases";
    $result = mysqli_query($conn, $query);
    ?>

    <table class="table">
        <thead>
            <tr>
                <th>Case ID</th>
                <th>Case Name</th>
                <th>Case Number</th>
                <th>Case Stage</th>
                <th>Date Opened</th>
                <th>Office</th>
                <th>Description</th>
                <th>Statute of Limitations</th>
                <th>Associated Clients</th>
                <th>Case Lead</th> <!-- New column for Case Lead -->
            </tr>
        </thead>
        <tbody>
            <?php
            // New column for Case Lead and Actions

    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch associated clients for each case
        $caseId = $row['case_id'];

        // Check if $caseId is defined and not empty
        if (!empty($caseId)) {
            $clientQuery = "SELECT firstName FROM people INNER JOIN case_clients ON people.person_id = case_clients.clientId WHERE case_clients.caseId = $caseId";
            $clientResult = mysqli_query($conn, $clientQuery);
            $clients = [];

            // Fetch clients only if the query is successful
            if ($clientResult) {
                while ($clientRow = mysqli_fetch_assoc($clientResult)) {
                    $clients[] = $clientRow['firstName'];
                }
            } else {
                // Handle query error
                echo "Error in client query: " . mysqli_error($conn);
            }

            echo '<tr>';
            echo '<td>' . $row['case_id'] . '</td>';
            // Make the case name a clickable link
            echo '<td><a href="case_details.php?case_id=' . $row['case_id'] . '">' . $row['caseName'] . '</a></td>';
            echo '<td>' . $row['caseNumber'] . '</td>';
            echo '<td>' . $row['caseStage'] . '</td>';
            echo '<td>' . $row['dateOpened'] . '</td>';
            echo '<td>' . $row['office'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>' . $row['statuteOfLimitations'] . '</td>';
            echo '<td>' . implode(', ', $clients) . '</td>';
            $caseLead = getCaseLead($conn, $row['case_id']);
            echo '<td>' . ($caseLead !== null ? $caseLead : 'N/A') . '</td>';
            
            
            echo '</tr>';
        } else {
            // Handle caseId not defined or empty
            echo "Error: caseId is not defined or empty.";
        }
    }
    ?>
    </tbody>
    </table>


    <!-- Add Bootstrap JS and Popper.js scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>
</html>