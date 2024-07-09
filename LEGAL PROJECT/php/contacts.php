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

// Delete selected contacts
if (isset($_POST['delete'])) {
    $selected_contacts = isset($_POST['selected_contacts']) ? $_POST['selected_contacts'] : array();

    foreach ($selected_contacts as $contact_id) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM people WHERE person_id = ?");
        $stmt->bind_param("i", $contact_id);
        $stmt->execute();
        $stmt->close();
    }
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

// Search filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where_clause = $search ? "WHERE firstName LIKE '%$search%' OR lastName LIKE '%$search%' OR email LIKE '%$search%'" : '';

// Query to retrieve data from the people table with search filter
$sql = "SELECT * FROM people $where_clause";
$result = $conn->query($sql);

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>


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



<div>


        <!-- Button trigger modal -->
        <div class="d-flex align-items-center pb-3">
            <h3 class="my-3 mx-3 me-4 fw-bold">People</h3>
          
            <ul class="nav nav-pills flex-nowrap m-0 d-print-none">
              <li role="presentation" class="nav-item">
                <a class="nav-link active" data-new-filters="{&quot;show_archived_clients&quot;:false}" href="#">Active</a>
              </li>
              <li role="presentation" class="nav-item">
                <a class="nav-link " data-new-filters="{&quot;show_archived_clients&quot;:true}" href="#"></a>
              </li>
            </ul>
          
              <div class="ms-auto mx-3 d-flex align-items-center d-print-none">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Person
                  </button>
              </div>
          </div>

      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add Person</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
                <div class="modal-body">
                    <!-- Form for adding a person -->
                    <form action="people.php" method="POST" onsubmit="return validateForm()">
            
                      <div class="form-group">
                          <label for="firstName">First Name:</label>
                          <input type="text" class="form-control" name="firstName" required>
                      </div>
                      <div class="form-group">
                          <label for="middleName">Middle Name:</label>
                          <input type="text" class="form-control" name="middleName">
                      </div>
                      <div class="form-group">
                          <label for="lastName">Last Name:</label>
                          <input type="text" class="form-control" name="lastName" required>
                      </div>
                      <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" class="form-control" name="email" required>
                      </div>
                      <div class="form-group">
                          <label for="phone">Cell phone:</label>
                          <input type="text" class="form-control" name="phone" required>
                      </div>
                      <div class="form-group">
                          <label for="home_phone">Home phone:</label>
                          <input type="text" class="form-control" name="home_phone">
                      </div>
                      <div class="form-group">
                          <label for="email">Address:</label>
                          <input type="text" class="form-control" name="address" required>
                      </div>
                      <div class="form-group">
                          <label for="address2">Address 2:</label>
                          <input type="text" class="form-control" name="address2">
                      </div>
                      <div class="form-group">
                          <label for="city">City:</label>
                          <input type="text" class="form-control" name="city" required>
                      </div>
                      <div class="form-group">
                          <label for="country">Country:</label>
                          <input type="text" class="form-control" name="country" required>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </form>
                  </div>
            </div>

          </div>
        </div>
      </div>


    <div class="container-fluid mt-0">
    <form method="get" action="">
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" class="form-control" id="search" name="search" value="<?= htmlspecialchars($search) ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Search</button>
    </form>
    <form method="post" action="">
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-striped-columns">
                <thead class="table-light">
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Home Phone</th>
                    <th>Address</th>
                    <th>Address 2</th>
                    <th>City</th>
                    <th>Country</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Loop through the result set and output data into the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selected_contacts[]' value='{$row['person_id']}'></td>";
                    echo "<td>{$row['person_id']}</td>";
                    echo "<td>{$row['firstName']}</td>";
                    echo "<td>{$row['middleName']}</td>";
                    echo "<td>{$row['lastName']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['home_phone']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['address2']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['country']}</td>";

                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-danger mb-3" name="delete">Delete Selected</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    
    
        
        
    
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    </body>
    </html>

</div>

    

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
    
    
