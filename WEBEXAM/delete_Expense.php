<?php
include('database_connection.php');

// Check if 'expense_id' parameter is set in the request
if (isset($_REQUEST['expense_id'])) {
    // Get the expense_id from the request
    $expense_id = $_REQUEST['expense_id'];

    // Prepare a statement to delete a record from the 'expenses' table where 'Expense_id' matches
    $stmt = $connection->prepare("DELETE FROM expenses WHERE Expense_id = ?");
    $stmt->bind_param("i", $expense_id); // 'i' indicates that 'Expense_id' is an integer

   ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Expense</title>
    <script>
        // Function to confirm the deletion when the form is submitted
        function confirmDelete() {
            return confirm("Are you sure you want to delete his expense?");
        }
    </script>
</head>
<body>
    <!-- Form to trigger the deletion process upon submission -->
    <form method="post" onsubmit="return confirmDelete();">

       <!-- Hidden field to carry the expense_id value in the POST request -->

        <input type="hidden" name="expense_id" value="<?php echo $expense_id; ?>">

            <!-- Submit button to delete the expense -->
       <input type="submit" value="Delete Expense">
    </form>

    <?php
        // If the HTTP request method is POST, execute the delete statement
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Execute the delete statement and check for success
            if ($stmt->execute()) {
                echo "Expense record deleted successfully."; 
            } else {
                echo "Error deleting expense record: " . $stmt->error; 
        }
    }
    ?>
 ?>
    </body>
    </html>
    <?php
} else {
    // If 'expense_id' is not set in the request, show an error message
    echo "Expense ID is not set.";
}
?>
<body bgcolor="pineapple">
<button onclick="window.location.href='./Expense.php'">Back to Expenses List</button>
<?php
// Close the database connection
$connection->close();
?>
