<?php

$connect = mysqli_connect("Localhost","root", "", "legal");

// Fetch case details based on the case ID
$caseDetails = getCaseDetails($caseId);

// Check if case details are retrieved successfully
if ($caseDetails) {
    // Print the current case stage value
    $currentCaseStage = $caseDetails['caseStage'];
    echo "Current Case Stage: " . $currentCaseStage;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add Task</title>
</head>
<body>
    


<select id="caseStageSelect" name="caseStageSelect" class="form-select">
    <option value="discovery" <?php echo ($currentCaseStage === 'discovery') ? 'selected' : ''; ?>>Discovery</option>
    <option value="In Trial" <?php echo ($currentCaseStage === 'In Trial') ? 'selected' : ''; ?>>In Trial</option>
    <option value="On Hold" <?php echo ($currentCaseStage === 'On Hold') ? 'selected' : ''; ?>>On Hold</option>
</select>

<script>
function updateCaseStage() {
    var selectedState = document.getElementById('caseStageSelect').value;

    // Make an AJAX request to update the case state
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'case_details.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Case state updated successfully.');
                } else {
                    alert('Failed to update case state.');
                }
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };

    // Send the POST request
    xhr.send('update_case_stage=1&case_id=' + encodeURIComponent(<?php echo json_encode($caseId); ?>) + '&new_state=' + encodeURIComponent(selectedState));
}
</script>
</body>
</html>
