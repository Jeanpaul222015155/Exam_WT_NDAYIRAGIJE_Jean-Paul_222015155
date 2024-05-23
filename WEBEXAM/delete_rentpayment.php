<?php
include('database_connection.php');

// Check if 'payment_id' parameter is set in the request
if (isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    // Prepare a statement to delete a record from the 'rentpayments' table where 'Payment_id' matches
    $stmt = $connection->prepare("DELETE FROM rentpayments WHERE Payment_id = ?");
    $stmt->bind_param("i", $payment_id); 

        // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Rent payment record deleted successfully."; // Success message
        } else {
            echo "Error deleting rent payment record: " . $stmt->error; // Error message if deletion fails
        }
    }


    $stmt->close();
} else {
    // If 'payment_id' is not set in the request, show an error message
    echo "Payment ID is not set.";
}

// Ensure proper closure of the database connection

$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Rent Payment</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete this rent payment?");
        }
    </script>
</head>
<body bgcolor="pineapplesky">
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
        <!-- Submit button to delete the rent payment -->
        <input type="submit" value="Delete Rent Payment">
    </form>
    
    <!-- Button to navigate back to the rent payments page -->
    <button onclick="window.location.href='./rentpayment.php'">Back to Rent Payments</button>
</body>
</html>
