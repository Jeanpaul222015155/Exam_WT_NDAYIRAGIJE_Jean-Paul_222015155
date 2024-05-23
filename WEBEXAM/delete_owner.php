<?php
     // Include database connection file to establish a connection to the database
include('database_connection.php');

   // Check if 'owner_id' parameter is set in the request
if(isset($_REQUEST['owner_id'])) {
    $owner_id = $_REQUEST['owner_id'];

     // Prepare a statement to delete a record from the 'owners' table where the 'owner_id' matches
     $stmt = $connection->prepare("DELETE FROM owners WHERE owner_id=?");
     $stmt->bind_param("i", $owner_id);// 'i' indicates that 'owner_id' is an integer

    // HTML structure for the page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
         // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="owner_id" value="<?php echo $owner_id; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
     // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php
      // Close the prepared statement after execution
    $stmt->close();
} else {
    // If 'owner_id' is not set in the request, show an error message
    echo "Owner ID is not set.";
}
?>
<body bgcolor="pineapplesky">
<button onclick="window.location.href='./owner.php'">Back to Form</button>
<?php
// Close the database connection
$connection->close();
?>
