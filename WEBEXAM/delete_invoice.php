<?php
// Include database connection file to establish a connection to the database
include('database_connection.php'); // Modify to match your actual file path

// Check if 'invoice_id' parameter is set in the request
if (isset($_REQUEST['invoice_id'])) {
    $invoice_id = $_REQUEST['invoice_id'];
    
    // Prepare the SQL statement to delete a record from the invoices table
    $stmt = $connection->prepare("DELETE FROM invoices WHERE invoice_id = ?");
    $stmt->bind_param("i", $invoice_id); // 'i' indicates that 'invoice_id' is an integer

    // HTML structure for the page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Invoice</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this invoice?");
        }
    </script>
</head>
<body bgcolor="pineapplesky"> <!-- Unique background color as mentioned -->

    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">
        <!-- Hidden field to carry the invoice_id value in POST request -->
        <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
        <!-- Submit button for deleting the invoice record -->
        <input type="submit" value="Delete Invoice">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute the delete statement and check for success
        if ($stmt->execute()) {
            echo "Invoice record deleted successfully."; 
        } else {
            echo "Error deleting invoice record: " . $stmt->error; 
        }
    }
    ?>

    <!-- Button to navigate back to the invoices list -->
    <button onclick="window.location.href='./invoice.php'">Back to Invoice List</button>

</body>
</html>
<?php
    // Close the prepared statement after execution
    $stmt->close();
} else {
    echo "Invoice ID is not set.";
}

// Close the database connection
$connection->close();
?>
