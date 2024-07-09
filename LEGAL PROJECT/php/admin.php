<?php
include ('admin_header.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    <title>Administrator Dashboard</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (Administrator Menu) -->
        <div class="col-2">
            <div class="card">
                <div class="card-header">
                    Administrator Menu
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="manage_accounts.php">User Management</a></li>
                        <li class="list-group-item"><a href="#logs-auditing">Logs and Auditing</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-10">
            <!-- Logs and Auditing Card -->
            <div class="card">
                <div class="card-header text-center" >
                    Logs and Auditing
                </div>
                <div class="card-body">
                    <!-- Add your Logs and Auditing content here -->
                    <p> User Logs and Audits.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-e3JpLsEgzNlxb2rWqb4vWV+qUgSdU/d0PINAtRZ9gq7dJpEV5eBGO5a6dF7cx3b" crossorigin="anonymous"></script>

</body>
</html>
