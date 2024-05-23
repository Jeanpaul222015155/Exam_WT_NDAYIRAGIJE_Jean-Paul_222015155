<?php
// Include the database connection file to establish a connection to the database
include('database_connection.php');

// Check if 'request_id' parameter is set in the request
if (isset($_REQUEST['request_id'])) {
    $request_id = $_REQUEST['request_id'];
    
    // Prepare a statement to delete a record from the 'maintenancerequests' table where 'Request_id' matches
    $stmt = $connection->prepare("DELETE FROM maintenancerequests WHERE Request_id = ?");
    $stmt->bind_param("i", $request_id); // 'i' indicates that 'Request_id' is an integer

   ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Maintenancerequest</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Maintenancerequest?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">

        <!-- Hidden field to carry the Maintenancerequest_id value in POST request -->

        <input type="hidden" name="Maintenancerequest_id" value="<?php echo $Maintenancerequest_id; ?>">
        <input type="submit" value="Delete Maintenancerequest">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Maintenancerequest record deleted successfully."; 
        } else {
            echo "Error deleting Maintenancerequest record: " . $stmt->error; 
        }
    }
    ?>
</body>
</html>
<?php
      // Close the prepared statement after execution
    $stmt->close();
} else {
    echo "Maintenancerequest ID is not set.";
}
?>
<body bgcolor="pineapple">

    <!-- Button to navigate back to the Maintenancerequest list -->
<button onclick="window.location.href='./MaintenanceReq.php'">Back to Maintenancerequest List</button>
<?php
// Close the database connection
$connection->close();
?>
