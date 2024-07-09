
<?php
include("header.php");
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'legal');

// Check if connection succeeded
if (!$conn) {
    echo "Failed to connect to the database: " . mysqli_connect_error();
    exit();
}

// Check if the search form is submitted
if (isset($_GET['search'])) {
    // Sanitize user input to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Query to retrieve data from the companies table with search filter
    $sql = "SELECT * FROM companies 
            WHERE companyName LIKE '%$search%' 
            OR companyEmail LIKE '%$search%' 
            OR companyWebsite LIKE '%$search%' 
            OR Main_phone LIKE '%$search%' 
            OR fax LIKE '%$search%' 
            OR address LIKE '%$search%' 
            OR address2 LIKE '%$search%' 
            OR country LIKE '%$search%'";
} else {
    // Query to retrieve all data from the companies table if search is not used
    $sql = "SELECT * FROM companies";
}

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    echo "Error retrieving data: " . mysqli_error($conn);
    exit();
}

// Check if the delete form is submitted
if (isset($_POST['delete'])) {
    // Sanitize user input to prevent SQL injection
    $selected_ids = isset($_POST['selected_ids']) ? $_POST['selected_ids'] : [];

    foreach ($selected_ids as $id) {
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, "DELETE FROM companies WHERE company_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Componies</title>
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
  <a class="pendo-subnav-dashboard nav-link " href="contacts.php">People</a>
</li>

<li class="nav-item">
  <a class="pendo-subnav-recent-activity nav-link active" href="companies.php">Companies</a>
</li>


        </ul>
      </nav>
    </div>

    <!---------------------------------------------------------- end of nav bar--------------------------------------------------- -->

  </header>

<div>


  <!-- Button trigger modal -->
  <div class="d-flex align-items-center pb-3">
    <h3 class="my-3 mx-3 me-4 fw-bold">Companies</h3>
    
    <ul class="nav nav-pills flex-nowrap m-0 d-print-none">
        <li role="presentation" class="nav-item">
          <a class="nav-link active" data-new-filters="{&quot;show_archived_clients&quot;:false}" href="#">Active</a>
        </li>
      </ul>
    
        <div class="ms-auto d-flex align-items-center d-print-none">
          <button type="button" class="btn btn-primary mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add Company
            </button>
        </div>
  </div>

      
      <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
            <div class="modal-body">
                <!-- Form for adding a company -->
                <form action="companiesform.php" method="POST" onsubmit="return validateForm()">
                  <div class="form-group">
                    <label for="companyName">Company Name:</label>
                    <input type="text" class="form-control" name="companyName" required>
                  </div>
                  <div class="form-group">
                    <label for="companyEmail">Email:</label>
                    <input type="email" class="form-control" name="companyEmail" required>
                  </div>
                  <div class="form-group">
                    <label for="companyWebsite">Website:</label>
                    <input type="text" class="form-control" name="companyWebsite" required>
                  </div>
                  <div class="form-group">
                    <label for="Main_phone">Main phone:</label>
                    <input type="text" class="form-control" name="Main_phone" required>
                  </div>
                  <div class="form-group">
                    <label for="fax">Fax:</label>
                    <input type="text" class="form-control" name="fax">
                  </div>
                  <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" required>
                  </div>
                  <div class="form-group">
                    <label for="address2">Address 2:</label>
                    <input type="text" class="form-control" name="address2">
                  </div>
                  <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" name="country" required>
                  </div>
                  <div class="form-group">
                    <label for="private_notes" name="private_notes">Private Notes:</label>
                    <textarea name="private_notes" cols="55" rows="5"></textarea>
                  </div>
            
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Company</button>
              </div>
                </form>
              </div>

            </div>
          </div>
        </div>
  </div>
  
  <div>
  <div class="container-fluid mt-0">
    
    <!-- Search Form -->
    <form method="get" action="">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Search</button>
    </form>

    <!-- Delete Form -->
    <form method="post" action="">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th>Select</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Website</th>
                <th>Main Phone</th>
                <th>Fax</th>
                <th>Address</th>
                <th>Address 2</th>
                <th>Country</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Loop through the result set and output data into the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_ids[]' value='{$row['company_id']}'></td>";
                echo "<td>{$row['companyName']}</td>";
                echo "<td>{$row['companyEmail']}</td>";
                echo "<td>{$row['companyWebsite']}</td>";
                echo "<td>{$row['Main_phone']}</td>";
                echo "<td>{$row['fax']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['address2']}</td>";
                echo "<td>{$row['country']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger mb-3" name="delete">Delete Selected</button>
    </form>
</div>
    
  </div>
  
    
        

            
        
    
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

 


    

    

<script>
  function validateForm() {
      var form = document.forms[0];
      if (form.checkValidity() === false) {
          // If the form is not valid, prevent submission
          form.classList.add('was-validated');
          return false;
      }
      return true;
  }
</script>   
</body>

</html>
    
