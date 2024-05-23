<?php
// Include the database connection file to establish a connection to the database
include('database_connection.php');

// Check if 'inspection_id' parameter is set in the request
if (isset($_REQUEST['inspection_id'])) {
    // Get the inspection_id from the request
    $inspection_id = $_REQUEST['inspection_id'];

    // Prepare a statement to delete a record from the 'propertyinspections' table where 'Inspection_id' matches
    $stmt = $connection->prepare("DELETE FROM propertyinspections WHERE Inspection_id = ?");
    $stmt->bind_param("i", $inspection_id); // 'i' indicates that 'Inspection_id' is an integer

    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Property Inspection</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this property inspection?");
        }
    </script>
</head>
<body>
   <!-- Form to trigger the deletion process upon submission -->
        <form method="post" onsubmit="return confirmDelete();">
            <!-- Hidden field to carry the inspection_id value in POST request -->
            <input type="hidden" name="inspection_id" value="<?php echo $inspection_id; ?>">
            <!-- Submit button to delete the property inspection -->
            <input type="submit" value="Delete Property Inspection">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Property Inspectionrecord deleted successfully."; 
        } else {
            echo "Error deleting property inspection record: " . $stmt->error; 
        }
    }
    ?>
</body>
</html>
<?php
       // Close the prepared statement after execution
    $stmt->close();
} else {
      // If 'inspection_id' is not set in the request, show an error message
    echo "Inspection ID is not set.";
}
?>
<body bgcolor="pineapple">

    <!-- Button to navigate back to the property inspections list -->
<button onclick="window.location.href='./propertyinspec.php'">Back to property inspection List</button>
<?php
// Close the database connection
$connection->close();
?>
