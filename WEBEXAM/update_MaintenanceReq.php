<?php
include('database_connection.php'); // Connect to the database

// Fetch existing maintenance request details based on Request_id

 if (isset($_REQUEST['request_id'])) { 
    $request_id = $_REQUEST['request_id'];

    $stmt = $connection->prepare("SELECT * FROM maintenancerequests WHERE Request_id = ?");
    $stmt->bind_param("i", $request_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); // Get the result of the query

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc(); // Fetch the data
        $unit_id = $row['Unit_id'];
        $tenant_id = $row['Tenant_id'];
        $request_date = $row['Request_date'];
        $description = $row['Description'];
        $status = $row['Status'];
        $assigned_to = $row['Assigned_to'];
    } else {
        echo "Maintenance request not found.";
        exit(); 
    }
} else {
    echo "No request ID specified.";

    exit(); // Stop if the identifier is not provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Maintenance Request</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation before updating
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Maintenance Request</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- form for updating -->
            <!-- Pre-fill form with existing maintenance request data -->
            <label for="request_id">Request ID:</label>
            <input type="number" id="request_id" name="request_id" value="<?php echo $request_id; ?>" readonly>
            <br><br>

            <label for="unit_id">Unit ID:</label>
            <input type="number" id="unit_id" name="unit_id" value="<?php echo $unit_id; ?>" required>
            <br><br>

            <label for="tenant_id">Tenant ID:</label>
            <input type="number" id="tenant_id" name="tenant_id" value="<?php echo $tenant_id; ?>" required>
            <br><br>

            <label for="request_date">Request Date:</label>
            <input type="date" id="request_date" name="request_date" value="<?php echo $request_date; ?>" required>
            <br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
            <br><br>

            <label for="status">Status:</label>
            <input type="text" id="status" name="status" value="<?php echo $status; ?>" required>
            <br><br>

            <label for="assigned_to">Assigned To:</label>
            <input type="text" id="assigned_to" name="assigned_to" value="<?php echo $assigned_to; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> 
            <a href="./MaintenanceReq.php">Go Back Form</a> <!-- Link to go back to the list -->
        </form>
     </center>
 </body>
 </html>

<?php
include('database_connection.php'); // Reconnect to the database

// Process form submission to update maintenance request data

if (isset($_POST['update'])) { // Check if the form was submitted
    $request_id = $_POST['request_id'];
    $unit_id = $_POST['unit_id'];
    $tenant_id = $_POST['tenant_id'];
    $request_date = $_POST['request_date'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $assigned_to = $_POST['assigned_to'];

    // Update query for modifying the maintenance request record

    $stmt = $connection->prepare("UPDATE maintenancerequests SET Unit_id = ?, Tenant_id = ?, Request_date = ?, Description = ?, Status = ?, Assigned_to = ? WHERE Request_id = ?");
    $stmt->bind_param("iissssi", $unit_id, $tenant_id, $request_date, $description, $status, $assigned_to, $request_id);

    if ($stmt->execute()) { // If the update is successful

        header('Location: MaintenanceReq.php'); // Redirect to the list of requests
        exit(); // Exit to prevent further code execution
    } else {

        // If there's an error during query execution

        echo "Error updating data: " . $stmt->error; 
    }
}
?>
