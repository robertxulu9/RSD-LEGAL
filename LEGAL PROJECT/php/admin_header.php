<?php
// header.php

// Start a session (if not started already)
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID'])) {
    // The user is logged in, you can use $_SESSION['userID'] to get the user ID
    $userID = $_SESSION['userID'];

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'legal');

    // Check if connection succeeded
    if (!$conn) {
        echo "Failed to connect to the database: " . mysqli_connect_error();
        exit();
    }

    // Fetch user information from the database
    $userSql = "SELECT fname, lname FROM users WHERE id='$userID'";
    $userResult = mysqli_query($conn, $userSql);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userRow = mysqli_fetch_assoc($userResult);
        $fname = $userRow['fname'];
        $lname = $userRow['lname'];
    } else {
        // Handle the case where user information is not found
        $fname = "";
        $lname = "";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    header("Location: login.html");
    exit();
}
// Check if the logout button is clicked
if (isset($_POST['logout'])) {
  // Destroy the session
  session_destroy();

  // Redirect to the login page
  header("Location: login.html");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
    @media (min-width: 576px) {
      .dropdown:hover>.dropdown-menu {
        display: block;

      }
    }
  </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
  <main>
    <!------------------------------------------ navigation bar ------------------------------------------------->
    <form method="post">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">RSD LEGAL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
              <a class="nav-link" href="admin.php">Admin</a>
            </li>
            </li>

        <!-- Logout Button (Moved to the end of the right side) -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" style="padding-left: 100px;">
                <span class="nav-link">
                    <?php echo " $fname $lname"; ?>
                </span>
            </li>
            <li class="nav-item">
            <button type="submit" class="btn btn-secondary" name="logout">Logout</button>
             </li>
        </ul>
  </main>
        </div>
      </div>
    </nav>
  </form>
  <div id="success-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
    <div class="toast-header">
        <strong class="mr-auto">Success!</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
      successfully!
    </div>
</div>




    <!-- -------------------------------------------------------too bar---------------------------------------------- -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

</body>

</html>