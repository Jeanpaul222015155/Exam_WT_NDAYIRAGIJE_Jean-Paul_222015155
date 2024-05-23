<?php
include('database_connection.php'); 

// Fetch existing tenant details based on Tenant_id


if (isset($_REQUEST['tenant_id'])) { // Check if tenant_id is provided
    $tenant_id = $_REQUEST['tenant_id'];

    $stmt = $connection->prepare("SELECT * FROM tenants WHERE Tenant_id = ?");
    $stmt->bind_param("i", $tenant_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();


        // Store the fetched values to pre-fill the form

        $tenant_id = $row['Tenant_id'];
        $first_name = $row['First_name'];
        $last_name = $row['Last_name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $address = $row['Address'];
        $lease_start_date = $row['Lease_start_date'];
        $lease_end_date = $row['Lease_end_date'];
    } else {
        echo "Tenant not found."; // If no matching record is found
    }
} else {
    echo "No Tenant ID specified."; 
    exit(); // Exit to prevent further execution
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Tenant</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); 
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Tenant Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Confirmation prompt -->
        <label for="tenant_id">Tenant ID:</label>
        <input type="number" id="tenant_id" name="tenant_id" value="<?php echo isset($tenant_id) ? $tenant_id : ''; ?>" readonly> 
            <br><br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
            <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
            <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
            <br><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
            <br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
            <br><br>

        <label for="lease_start_date">Lease Start Date:</label>
        <input type="date" id="lease_start_date" name="lease_start_date" value="<?php echo isset($lease_start_date) ? $lease_start_date : ''; ?>" required>
            <br><br>

         <label for="lease_end_date">Lease End Date:</label>
         <input type="date" id="lease_end_date" name="lease_end_date" value="<?php echo isset($lease_end_date) ? $lease_end_date : ''; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> <!-- Button to submit form -->
            <a href="./tenant.php">Go Back Form</a> 
        </form>
    </center>
</body>
</html>

<?php
    // Include database connection

include('database_connection.php');

// Process form submission to update tenant data

if (isset($_POST['update'])) {
     $tenant_id = $_POST['tenant_id'];
     $first_name = $_POST['first_name'];
     $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $lease_start_date = $_POST['lease_start_date'];
      $lease_end_date = $_POST['lease_end_date'];

   
    $stmt = $connection->prepare("UPDATE tenants SET First_name = ?, Last_name = ?, Email = ?, Phone = ?, Address = ?, Lease_start_date = ?, Lease_end_date = ? WHERE Tenant_id = ?");
    $stmt->bind_param("sssssssi", $first_name, $last_name, $email, $phone, $address, $lease_start_date, $lease_end_date, $tenant_id);

    if ($stmt->execute()) { 
        header('Location: tenant.php'); 
        exit();
    } else {

        echo "Error updating data: " . $stmt->error; // Display error message
    }
}
?>
