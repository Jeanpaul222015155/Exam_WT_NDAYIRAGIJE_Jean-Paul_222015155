<?php
include('database_connection.php'); 

// Fetch existing expense details based on Expense_id

if (isset($_REQUEST['expense_id'])) {
    $expense_id = $_REQUEST['expense_id'];

    $stmt = $connection->prepare("SELECT * FROM expenses WHERE Expense_id = ?");
    $stmt->bind_param("i", $expense_id); // Bind integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the data

        // Store the values for pre-filling the form

        $property_id = $row['Property_id'];
        $expense_type = $row['Expense_type'];
        $amount = $row['Amount'];
        $date_incurred = $row['Date_incurred'];
    } else {
        echo "Expense not found."; 
        exit(); // Stop if no matching record
    }
} else {
    echo "No expense ID specified."; // If no `expense_id` is provided

    exit(); // Exit to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Expense</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation prompt
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Expense Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Form for updating expense -->
            <!-- Pre-fill form with existing expense data -->
            <label for="expense_id">Expense ID:</label>
            <input type="number" id="expense_id" name="expense_id" value="<?php echo $expense_id; ?>" readonly> <!-- Read-only -->
            <br><br>

            <label for="property_id">Property ID:</label>
            <input type="number" id="property_id" name="property_id" value="<?php echo $property_id; ?>" required>
            <br><br>

            <label for="expense_type">Expense Type:</label>
            <input type="text" id="expense_type" name="expense_type" value="<?php echo $expense_type; ?>" required>
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $amount; ?>" required>
            <br><br>

            <label for="date_incurred">Date Incurred:</label>
            <input type="date" id="date_incurred" name="date_incurred" value="<?php echo $date_incurred; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> <!-- Submit to update -->
            <a href="./expense.php">Go Back Form </a> <!-- Link to go back to the list of expenses -->
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php'); // Reconnect to the database

// Process form submission to update expense data

if (isset($_POST['update'])) { // Check if the form was submitted
    $expense_id = $_POST['expense_id'];
    $property_id = $_POST['property_id'];
    $expense_type = $_POST['expense_type'];
    $amount = $_POST['amount'];
    $date_incurred = $_POST['date_incurred'];

    // Update query to modify the expense record

    $stmt = $connection->prepare("UPDATE expenses SET Property_id = ?, Expense_type = ?, Amount = ?, Date_incurred = ? WHERE Expense_id = ?");
    $stmt->bind_param("isdsi", $property_id, $expense_type, $amount, $date_incurred, $expense_id);
    if ($stmt->execute()) { // If the update is successful

        header('Location: expense.php'); // Redirect to the list of expenses
        exit(); 

        echo "Error updating data: " . $stmt->error; 
    }
}
?>
