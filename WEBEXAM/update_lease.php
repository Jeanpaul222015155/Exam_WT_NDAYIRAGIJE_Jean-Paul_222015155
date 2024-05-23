<?php
include('database_connection.php');

// Fetch existing lease details based on Lease_id if provided

if (isset($_REQUEST['lease_id'])) {
    $lease_id = $_REQUEST['lease_id'];

    $stmt = $connection->prepare("SELECT * FROM leases WHERE Lease_id = ?");
    $stmt->bind_param("i", $lease_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // If the lease record exists

        $row = $result->fetch_assoc();

        // Retrieve values to populate the form

        $lease_id = $row['Lease_id'];
        $unit_id = $row['Unit_id'];
        $tenant_id = $row['Tenant_id'];
        $lease_start_date = $row['Lease_start_date'];
        $lease_end_date = $row['Lease_end_date'];
        $monthly_rent = $row['Monthly_rent'];
    } else {
        echo "Lease not found."; 
        exit(); // Stop execution
    }
} else {
    echo "No Lease ID specified."; 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Lease</title>
    <script>
        function confirmUpdate() {
return confirm('Are you sure you want to update this record?'); // Confirmation before update
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Lease Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Form for updating the lease -->
            <label for="lease_id">Lease ID:</label>
            <input type="number" id="lease_id" name="lease_id" value="<?php echo isset($lease_id) ? $lease_id : ''; ?>" readonly> 
            <br><br>

            <label for="unit_id">Unit ID:</label>
            <input type="number" id="unit_id" name="unit_id" value="<?php echo isset($unit_id) ? $unit_id : ''; ?>" required>
            <br><br>

            <label for="tenant_id">Tenant ID:</label>
            <input type="number" id="tenant_id" name="tenant_id" value="<?php echo isset($tenant_id) ? $tenant_id : ''; ?>" required>
            <br><br>

            <label for="lease_start_date">Lease Start Date:</label>
            <input type="date" id="lease_start_date" name="lease_start_date" value="<?php echo isset($lease_start_date) ? $lease_start_date : ''; ?>" required>
            <br><br>

            <label for="lease_end_date">Lease End Date:</label>
            <input type="date" id="lease_end_date" name="lease_end_date" value="<?php echo isset($lease_end_date) ? $lease_end_date : ''; ?>" required>
            <br><br>

            <label for="monthly_rent">Monthly Rent:</label>
            <input type="number" id="monthly_rent" name="monthly_rent" value="<?php echo isset($monthly_rent) ? $monthly_rent : ''; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> 
            <a href="./lease.php">Go Back Form</a>
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');

if (isset($_POST['update'])) { 

    // Get the values from the form

       $lease_id = $_POST['lease_id'];
       $unit_id = $_POST['unit_id'];
       $tenant_id = $_POST['tenant_id'];
       $lease_start_date = $_POST['lease_start_date'];
       $lease_end_date = $_POST['lease_end_date'];
       $monthly_rent = $_POST['monthly_rent'];

            // Update query to modify the lease record


    $stmt = $connection->prepare("UPDATE leases SET Unit_id = ?, Tenant_id = ?, Lease_start_date = ?, Lease_end_date = ?, Monthly_rent = ? WHERE Lease_id = ?");
    $stmt->bind_param("sssssi", $unit_id, $tenant_id, $lease_start_date, $lease_end_date, $monthly_rent, $lease_id);

    if ($stmt->execute()) { 

          header('Location: lease.php'); 
       } else {

        // If there's an error during query execution

        echo "Error updating data: " . $stmt->error; 
    }
}
?>
