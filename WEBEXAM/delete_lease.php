<?php
// Include database connection file to establish a connection to the database
include('database_connection.php');

// Check if 'lease_id' parameter is set in the request
if (isset($_REQUEST['lease_id'])) {
    $lease_id = $_REQUEST['lease_id'];
    
    
    $stmt = $connection->prepare("DELETE FROM leases WHERE Lease_id = ?");
    $stmt->bind_param("i", $lease_id); // 'i' indicates that 'Lease_id' is an integer

    // HTML structure for the page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Lease</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this lease?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">
        <!-- Hidden field to carry the lease_id value in POST request -->
        <input type="hidden" name="lease_id" value="<?php echo $lease_id; ?>">
        <!-- Submit button for deleting the tenant record -->
        <input type="submit" value="Delete Lease">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Lease record deleted successfully."; 
        } else {
            echo "Error deleting lease record: " . $stmt->error; 
        }
    }
    ?>
</body>
</html>
<?php
      // Close the prepared statement after execution
    $stmt->close();
} else {
    echo "Lease ID is not set.";
}
?>
<body bgcolor="pineapplesky">

    <!-- Button to navigate back to the tenants list -->
<button onclick="window.location.href='./lease.php'">Back to Lease List</button>
<?php
// Close the database connection
$connection->close();
?>
