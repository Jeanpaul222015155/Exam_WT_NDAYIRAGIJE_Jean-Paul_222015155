<?php
// Include the database connection file to establish a connection to the database
include('database_connection.php');

// Check if 'technician_id' parameter is set in the request
if (isset($_REQUEST['technician_id'])) {
    $technician_id = $_REQUEST['technician_id'];

    // Prepare a statement to delete a record from the 'technicians' table where 'Technician_id' matches
    $stmt = $connection->prepare("DELETE FROM technicians WHERE Technician_id = ?");
    $stmt->bind_param("i", $technician_id); 
     ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Technician</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Technician?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">

        <!-- Hidden field to carry the Technician_id value in POST request -->

        <input type="hidden" name="Technician_id" value="<?php echo $Technician_id; ?>">
        <input type="submit" value="Delete Technician">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Technician record deleted successfully."; 
        } else {
            echo "Error deleting Technician record: " . $stmt->error; 
        }
    }
    ?>
</body>
</html>
<?php
      // Close the prepared statement after execution
    $stmt->close();
} else {
    echo "Technician ID is not set.";
}
?>
<body bgcolor="pineapple">

    <!-- Button to navigate back to the Technician list -->
<button onclick="window.location.href='./technician.php'">Back to Technician List</button>
<?php
// Close the database connection
$connection->close();
?>
