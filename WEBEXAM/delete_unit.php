<?php
include('database_connection.php');

// Check if 'unit_id' parameter is set in the request

if (isset($_REQUEST['unit_id'])) {

    // Get the unit_id from the request

    $unit_id = $_REQUEST['unit_id'];
    
       // Prepare a statement to delete a record from the 'units' table where 'Unit_id' matches

    $stmt = $connection->prepare("DELETE FROM units WHERE Unit_id = ?");
    $stmt->bind_param("i", $unit_id); // 'i' indicates that 'Unit_id' is an integer

?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Unit</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this unit?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="unit_id" value="<?php echo $unit_id; ?>">

        <!-- Submit button for deleting the unit -->
        <input type="submit" value="Delete Unit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Unit deleted successfully."; 

        } else {
            echo "Error deleting unit: " . $stmt->error; 
        }
    }
    ?>
</body>
</html>
<?php
      // Close the prepared statement after execution
    $stmt->close();
} else {
        // If 'unit_id' is not set in the request, show an error message
    echo "Unit ID is not set.";
}
?>
<body bgcolor="pineapplesky">
<!-- Button to navigate back to the units form page -->
<button onclick="window.location.href='./unit.php'">Back to Units</button>

<?php
$connection->close();
?>
