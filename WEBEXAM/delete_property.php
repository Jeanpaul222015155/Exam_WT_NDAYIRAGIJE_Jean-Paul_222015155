<?php
include('database_connection.php');

// Check if 'property_id' parameter is set in the request
if (isset($_REQUEST['property_id'])) {
    // Get the property_id from the request
    $property_id = $_REQUEST['property_id'];
    
    // Prepare a statement to delete a record from the 'properties' table where 'Property_id' matches
    $stmt = $connection->prepare("DELETE FROM properties WHERE Property_id = ?");
    $stmt->bind_param("i", $property_id); // 'i' indicates that 'Property_id' is an integer

    // HTML structure for the page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Property Record</title>
    <script>
          // Function to confirm the deletion when the form is submitted

        function confirmDelete() {
            return confirm("Are you sure you want to delete this property?");
        }
    </script>
</head>
<body>
          <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">
          <!-- Hidden field to carry the property_id value in POST request -->
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
          <!-- Submit button for deleting the property -->
        <input type="submit" value="Delete Property">
    </form>

    <?php
    // Check if the request method is POST

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

          // Execute the delete statement and check for success

        if ($stmt->execute()) {
            echo "Property deleted successfully."; // Success message
        } else {
            echo "Error deleting property: " . $stmt->error; // Error message if deletion fails
        }
    }
    ?>
</body>
</html>
<?php
    // Close the prepared statement after execution
    $stmt->close();
} else {
    echo "Property ID is not set.";
}
?>
<body bgcolor="pineapplesky">
<!-- Button to navigate back to the properties form page -->
<button onclick="window.location.href='./property.php'">Back to Properties List</button>
<?php
// Close the database connection
$connection->close();
?>
