<?php
include('database_connection.php');

// Check if 'tenant_id' parameter is set in the request
if (isset($_REQUEST['tenant_id'])) {

      // Get the tenant_id from the request
     $tenant_id = $_REQUEST['tenant_id'];
    
       // Prepare a statement to delete a record from the 'tenants' table where 'Tenant_id' matches

    $stmt = $connection->prepare("DELETE FROM tenants WHERE Tenant_id = ?");
    $stmt->bind_param("i", $tenant_id); 

    // HTML structure for the page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Tenant</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this tenant?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">
        <!-- Hidden field to carry the tenant_id value in POST request -->
        <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
        <input type="submit" value="Delete Tenant">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Tenant record deleted successfully."; // Success message
        } else {
            echo "Error deleting tenant record: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php
    $stmt->close();
} else {
    // If 'tenant_id' is not set in the request, show an error message
    echo "Tenant ID is not set.";
}
?>
<body bgcolor="pineapplesky">
<!-- Button to navigate back to the tenant page -->
<button onclick="window.location.href='./tenant.php'">Back to Tenants</button>
<?php
// Close the database connection
$connection->close();
?>
