<?php
include('database_connection.php'); 

// Fetch existing invoice details based on invoice_id

if (isset($_REQUEST['invoice_id'])) {
    $invoice_id = $_REQUEST['invoice_id'];

    $stmt = $connection->prepare("SELECT * FROM invoices WHERE invoice_id = ?");
    $stmt->bind_param("i", $invoice_id); // Bind integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // If there's at least one record found
        $row = $result->fetch_assoc(); // Fetch the data

        // Store the values for pre-filling the form

        $payment_id = $row['payment_id'];
        $invoice_date = $row['invoice_date'];
        $amount = $row['amount'];
        $description = $row['description'];
    } else {
        echo "Invoice not found.";
        exit(); // Stop if no matching record
    }
} else {
    echo "No invoice ID specified."; // If no `invoice_id` is provided
    exit(); // Exit to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Invoice</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation prompt
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Invoice Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Form for updating invoice -->
            <!-- Pre-fill form with existing invoice data -->
            <label for="invoice_id">Invoice ID:</label>
            <input type="number" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id; ?>" readonly> <!-- Read-only -->
            <br><br>

            <label for="payment_id">Payment ID:</label>
            <input type="number" id="payment_id" name="payment_id" value="<?php echo $payment_id; ?>" required>
            <br><br>

            <label for="invoice_date">Invoice Date:</label>
            <input type="date" id="invoice_date" name="invoice_date" value="<?php echo $invoice_date; ?>" required>
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $amount; ?>" required>
            <br><br>

            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="<?php echo $description; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> <!-- Submit to update -->
            <a href="./invoice.php">Go Back Form</a> <!-- Link to go back to invoices list -->
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php'); // Reconnect to the database

     // Process form submission to update invoice data

if (isset($_POST['update'])) {

     // Retrieve form data

    $invoice_id = $_POST['invoice_id'];
    $payment_id = $_POST['payment_id'];
    $invoice_date = $_POST['invoice_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Update query to modify the invoice record

    $stmt = $connection->prepare("UPDATE invoices SET payment_id = ?, invoice_date = ?, amount = ?, description = ? WHERE invoice_id = ?");
    $stmt->bind_param("isdsi", $payment_id, $invoice_date, $amount, $description, $invoice_id); 

    if ($stmt->execute()) { // If the query executes successfully

        header('Location: invoice.php'); // Redirect to the list of invoices
        exit(); 
    } else {
        echo "Error updating data: " . $stmt->error; // Display error message
    }
}
?>
