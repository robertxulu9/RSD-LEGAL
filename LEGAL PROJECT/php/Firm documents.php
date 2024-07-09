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

// Handle record deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_records'])) {
    $selectedRecords = $_POST['selected_records'];

    if (!empty($selectedRecords)) {
        $selectedRecords = implode(',', $selectedRecords);
        $sql = "DELETE FROM firm_documents WHERE firm_document_id IN ($selectedRecords)";

        if ($conn->query($sql) === TRUE) {
            header("Location: firm documents.php");
        } else {
            echo "Error deleting records: " . $conn->error;
        }
    } else {
        echo "No records selected for deletion.";
    }
}

// Handle search
$searchKeyword = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $sql = "SELECT * FROM firm_documents 
            WHERE firm_document_id LIKE '%$searchKeyword%' 
               OR file_tag LIKE '%$searchKeyword%'
               OR file_name LIKE '%$searchKeyword%'
               OR file_note LIKE '%$searchKeyword%'";
} else {
    // Fetch all records by default
    $sql = "SELECT * FROM firm_documents";
}

$result = $conn->query($sql);

// Check if the form is submitted and files are present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['files'])) {
    // Process each file
    foreach ($_FILES['files']['name'] as $key => $name) {
        // Check if the file details are available
        if (!empty($name)) {
            $file_tag = $_POST['file_tag'][$key] ?? '';
            $file_note = $_POST['file_note'][$key] ?? '';

            // File details
            $file_name = $_FILES['files']['name'][$key];
            $file_tmp = $_FILES['files']['tmp_name'][$key];

            // Move the file to the desired directory
            $uploads_dir = "firmdocuments/";
            move_uploaded_file($file_tmp, $uploads_dir . $file_name);

            // Insert file details into the database
            $sql = "INSERT INTO firm_documents (file_tag, file_name, file_note) VALUES ('$file_tag', '$file_name', '$file_note')";
            if ($conn->query($sql) === TRUE) {
                header("Location: firm documents.php");

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Firm Documents</title>
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
      <a class="pendo-subnav-recent-activity nav-link active" href="Firm documents.html"> Firm Documents</a>


    
            </ul>
          </nav>
        </div>
    
        <!---------------------------------------------------------- end of nav bar--------------------------------------------------- -->
    


  </header>

  <body>
        <!-- Button trigger modal -->
        <div class="d-flex align-items-center pb-3">
            <h3 class="my-3 mx-3 me-4 fw-bold">Firm Documents</h3>
          
            <ul class="nav nav-pills flex-nowrap m-0 d-print-none">

              <li role="presentation" class="nav-item">
                <a class="nav-link " data-new-filters="{&quot;show_archived_clients&quot;:true}" href="#"></a>
              </li>
            </ul>
          
              <div class="ms-auto d-flex align-items-center d-print-none">
                <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Firm Document
                  </button>
              </div>
          </div>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Practice Area</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <!-- Form for adding a person -->
                    <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="file_tag">File Tag:</label>
                          <input type="text" name="file_tag[]" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="file_note">File Note:</label>
                          <textarea name="file_note[]" class="form-control" required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="files">Choose File(s):</label>
                          <input type="file" name="files[]" class="form-control-file" multiple required>
                      </div>
                      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>

            </div>
                  </form>
                  </div>
              
            </div>

          </div>
        </div>
      </div>
      <div class="container-flex mx-3"> 
          <!-- Search Form -->
        <form action="" method="get" class="form-inline mb-3">
            <div class="form-group">
                <label for="search" class="mr-2">Search:</label>
                <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($searchKeyword) ?>">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>
        
        <?php
    // Check if there are records
    if ($result->num_rows > 0) {
        echo "<form action='' method='post'>"; // Added form element here
        echo "<table class='table'>
                <thead>
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>File Tag</th>
                    <th>File Name</th>
                    <th>File Note</th>
                    <th>Action</th> <!-- Added Action column for opening files -->
                </tr>
    </thead>
    <tbody>";

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                <td><input type='checkbox' name='selected_records[]' value='" . $row["firm_document_id"] . "'></td>
                <td>" . $row["firm_document_id"] . "</td>
                <td>" . $row["file_tag"] . "</td>
                <td>" . $row["file_name"] . "</td>
                <td>" . $row["file_note"] . "</td>
                <td>
                <button type='button' class='btn btn-success' onclick='openFile(\"firmdocuments/" . $row["file_name"] . "\")'>Open</button>
                <button type='button' class='btn btn-info' onclick='printFile(\"firmdocuments/" . $row["file_name"] . "\")'>Print</button>
                <a href='firmdocuments/" . $row["file_name"] . "' download><button type='button' class='btn btn-primary'>Download</button></a>
            </td>
          </tr>";
        }

        echo "</tbody></table>";
        echo "<button type='submit' name='delete_records' class='btn btn-danger'>Delete</button>";
        echo "</form>"; // Added form closing tag here
    } else {
        echo "No records found.";
    }
    ?>



      </div>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

    <script>
    function openFile(fileUrl) {
        window.open(fileUrl, '_blank');
    }

    function printFile(fileUrl) {
        var printWindow = window.open(fileUrl, '_blank');
        printWindow.print();
    }
    </script>
</body>
</html>