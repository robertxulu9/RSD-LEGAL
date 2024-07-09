<?php
include("header.php");

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

// Fetch cases from the database
$caseResult = $conn->query("SELECT case_id, caseName FROM cases");
$cases = [];
if ($caseResult->num_rows > 0) {
    while ($row = $caseResult->fetch_assoc()) {
        $cases[$row['case_id']] = $row['caseName'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_single_file'])) {
        // Handle single file upload
        $file_name = $_FILES['single_file']['name'];
        $file_tmp = $_FILES['single_file']['tmp_name'];

        move_uploaded_file($file_tmp, "uploads/" . $file_name);

        // Get the selected case_id and caseName from the form
        $caseId = $_POST['case_id'];
        $caseName = $cases[$caseId]; // Get case name based on case_id

        // Insert file details into the database
        $sql = "INSERT INTO files (file_name, case_id, caseName) VALUES ('$file_name', $caseId, '$caseName')";
        $conn->query($sql);
    } elseif (isset($_POST['add_multiple_files'])) {
        // Handle multiple file upload
        $file_names = [];

        foreach ($_FILES['multiple_files']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['multiple_files']['name'][$key];
            move_uploaded_file($tmp_name, "uploads/" . $file_name);
            $file_names[] = $file_name;
        }

        // Get the selected case_id and caseName from the form
        $caseId = $_POST['case_id'];
        $caseName = $cases[$caseId]; // Get case name based on case_id

        // Insert file details into the database
        foreach ($file_names as $file_name) {
            $sql = "INSERT INTO files (file_name, case_id, caseName) VALUES ('$file_name', $caseId, '$caseName')";
            $conn->query($sql);
        }
    } elseif (isset($_POST['delete_selected'])) {
        // Check if the delete button is clicked
        $selectedFiles = isset($_POST['selected_files']) ? $_POST['selected_files'] : [];

        if (!empty($selectedFiles)) {
            $fileIds = implode(',', $selectedFiles);

            // Delete selected records from the database
            $conn->query("DELETE FROM files WHERE file_id IN ($fileIds)");
        }
    }
}

// Initialize the case filter variable
$selectedCaseId = isset($_GET['case_id']) ? $_GET['case_id'] : '';

// Fetch files based on the selected case_id
$filesResult = $selectedCaseId
    ? $conn->query("SELECT * FROM files WHERE case_id = $selectedCaseId")
    : $conn->query("SELECT * FROM files");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Documents</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style type="text/css">
    @media (min-width: 576px) {
      .dropdown:hover>.dropdown-menu {
        display: block;

      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
        
                <!-- -------------------------------------------------------too bar---------------------------------------------- -->

                <div class="my-1"></div>

                <div id="subbar-navigation" class="clearfix d-print-none d-none d-lg-block">
                <nav class="navbar navbar-expand-lg navbar-light bg-light ps-4 pe-1 py-0 border-bottom test-subbar-nav">
                    <ul class="navbar-nav me-auto">
                    
            <li class="nav-item">
            <a class="pendo-subnav-recent-activity nav-link active" href="documents.php">Case Documents</a>
            </li>
            
            <li class="nav-item">
            <a class="pendo-subnav-recent-activity nav-link active" href="Firm documents.php"> Firm Documents</a>
            </li>

            
                    </ul>
                </nav>
                </div>
            
                <!---------------------------------------------------------- end of nav bar--------------------------------------------------- -->
            

    


        <div class="d-flex align-items-center pb-3">
    <h3 class="my-3 mx-3 me-4 fw-bold">Case Documents</h3>

    <ul class="nav nav-pills flex-nowrap m-0 d-print-none">
        <li role="presentation" class="nav-item">
            <a class="nav-link " data-new-filters="{&quot;show_archived_clients&quot;:true}" href="#"></a>
        </li>
    </ul>

    <div class="ms-auto d-flex align-items-center d-print-none">
        <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#addsinglefile">
            Add single file
        </button>

        <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#AddMultipleFiles">
            Add Multiple files
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addsinglefile" tabindex="-1" aria-labelledby="addsinglefile" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addsinglefile">Add Single file</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
         <label for="case_id">Select Case:</label>
        <select name="case_id" required>
            <?php
            // Generate options for the dropdown based on cases fetched from the database
            foreach ($cases as $caseId => $caseName) {
                echo "<option value=\"$caseId\">$caseName</option>";
            }
            ?>
        </select>
        <div class="my-1"></div>

        <label for="single_file">File:</label>
        <input type="file" name="single_file" required>

               <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="add_single_file" value="Add File">
        </div>
    </form>
        
          
        </div>

      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="AddMultipleFiles" tabindex="-1" aria-labelledby="AddMultipleFiles" aria-hidden="true">
<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="AddMultipleFiles">Add Multiple Files</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <form method="post" enctype="multipart/form-data">
                <label for="case_id">Select Case:</label>
        <select name="case_id" required>
            <?php
            // Generate options for the dropdown based on cases fetched from the database
            foreach ($cases as $caseId => $caseName) {
                echo "<option value=\"$caseId\">$caseName</option>";
            }
            ?>
        </select>

        <div class="my-2"></div>

       
    
        <label for="multiple_files">Files:</label>
        <input type="file" name="multiple_files[]" multiple required>
        <div class="my-2"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="add_multiple_files" value="Add Files">
        </div>

    </form>
        </div>

      </div>
    </div>
</div>

<div class="container-flex mx-3">
    <div>
        <h4>Filter Files by Case</h4>
        <form method="get">
            <label for="case_id">Select Case:</label>
            <select name="case_id">
                <option value="">All Files</option>
                <?php
                // Generate options for the dropdown based on cases fetched from the database
                foreach ($cases as $caseId => $caseName) {
                    $selected = ($selectedCaseId == $caseId) ? 'selected' : '';
                    echo "<option value=\"$caseId\" $selected>$caseName</option>";
                }
                ?>
            </select>
            <input type="submit" value="Filter">
        </form>
    </div>

    <form method="post">

        <?php
        // Display files based on the selected case_id
        if ($filesResult->num_rows > 0) {
            echo '<table class=" table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Case Name</th>
                            <th>File ID</th>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';

            while ($row = $filesResult->fetch_assoc()) {
                echo '<tr>
                        <td><input type="checkbox" name="selected_files[]" value="' . $row["file_id"] . '"></td>
                        <td>' . $row["caseName"] . '</td>
                        <td>' . $row["file_id"] . '</td>
                        <td>' . $row["file_name"] . '</td>
                        <td>
                            <a href="uploads/' . $row["file_name"] . '" target="_blank" class="btn btn-info btn-sm">Open</a>
                            <a href="#" onclick="printFile(\'' . $row["file_name"] . '\')" class="btn btn-secondary btn-sm">Print</a>
                            <a href="download.php?file=' . $row["file_name"] . '" class="btn btn-success btn-sm">Download</a>
                        </td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<p>No files found.</p>';
        }
        ?>
                <button type="submit" class="btn btn-danger" name="delete_selected">Delete Selected</button>

    </form>

    <!-- ... (Remaining HTML content remains unchanged) -->

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script>
    function printFile(fileName) {
        var printWindow = window.open("uploads/" + fileName, "_blank");
        printWindow.print();
    }

    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.delete-file');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var fileId = this.getAttribute('data-id');

                // You can implement AJAX to handle file deletion on the server
                // For simplicity, I'm just reloading the page in this example
                window.location.href = 'delete_file.php?id=' + fileId;
            });
        });
    });
</script>
</body>
</html>
