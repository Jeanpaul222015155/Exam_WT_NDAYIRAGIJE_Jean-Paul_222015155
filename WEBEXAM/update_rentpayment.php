<?php
include('database_connection.php');

// Fetch existing rent payment details based on Payment_id

if (isset($_REQUEST['payment_id'])) { // Check if payment_id is provided
    $payment_id = $_REQUEST['payment_id'];

    $stmt = $connection->prepare("SELECT * FROM rentpayments WHERE Payment_id = ?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute(); 
    $result = $stmt->get_result();


    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc(); 
        $payment_id = $row['Payment_id']; 
        $lease_id = $row['Lease_id'];
        $payment_date = $row['Payment_date'];
        $amount = $row['Amount'];
        $payment_method = $row['Payment_method'];
        $payment_status = $row['Payment_status'];
    } else {
        echo "Rent payment not found."; // If no matching record
        exit(); 
    }
} else {
    echo "No payment ID specified."; 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Update Rent Payment</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation prompt
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Rent Payment Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> 
            <label for="payment_id">Payment ID:</label>
            <input type="number" id="payment_id" name="payment_id" value="<?php echo $payment_id; ?>" readonly>
            <br><br>

            <label for="lease_id">Lease ID:</label>
            <input type="number" id="lease_id" name="lease_id" value="<?php echo $lease_id; ?>" required>
            <br><br>

            <label for="payment_date">Payment Date:</label>
            <input type="date" id="payment_date" name="payment_date" value="<?php echo $payment_date; ?>" required>
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $amount; ?>" required>
            <br><br>

            <label for="payment_method">Payment Method:</label>
            <input type="text" id="payment_method" name="payment_method" value="<?php echo $payment_method; ?>" required>
            <br><br>

            <label for="payment_status">Payment Status:</label>
            <input type="text" id="payment_status" name="payment_status" value="<?php echo $payment_status; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> 
            <a href="./rentpayment.php">Go Back Form </a> 
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');

// Process form submission to update rent payment data

if (isset($_POST['update'])) { 
    $payment_id = $_POST['payment_id'];
    $lease_id = $_POST['lease_id'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $payment_status = $_POST['payment_status'];


    $stmt = $connection->prepare("UPDATE rentpayments SET Lease_id = ?, Payment_date = ?, Amount = ?, Payment_method = ?, Payment_status = ? WHERE Payment_id = ?");
    $stmt->bind_param("issssi", $lease_id, $payment_date, $amount, $payment_method, $payment_status, $payment_id); 
    
    if ($stmt->execute()) { 
        header('Location: rentpayment.php'); 
        exit(); 
    } else {
        
        echo "Error updating data: " . $stmt->error; // Display error message
    }
}
?>
