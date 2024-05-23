<?php
include('database_connection.php'); // Connect to the database

// Fetch existing technician details based on Technician_id

if (isset($_REQUEST['technician_id'])) {
    $technician_id = $_REQUEST['technician_id'];

    $stmt = $connection->prepare("SELECT * FROM technicians WHERE Technician_id = ?");
    $stmt->bind_param("i", $technician_id); // Bind parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the data

         // Store the values for pre-filling the form

        $technician_id = $row['Technician_id'];
        $first_name = $row['First_name'];
        $last_name = $row['Last_name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $specialty = $row['Specialty'];
    } else {
        echo "Technician not found."; 
        exit(); // Stop if no matching record
    }
} else {
    echo "No technician ID specified."; // If no `technician_id` is provided
    exit(); // Exit to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Technician</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation prompt
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Technician Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Form to update technician -->
            
            <!-- Pre-fill form with existing technician data -->
            <label for="technician_id">Technician ID:</label>
            <input type="number" id="technician_id" name="technician_id" value="<?php echo $technician_id; ?>" readonly> <!-- Read-only -->
            <br><br>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
            <br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
            <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <br><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            <br><br>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" value="<?php echo $specialty; ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> <!-- Submit to update -->
            <a href="./technician.php">Go Back to Form</a> <!-- Link to go back to technicians list -->
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php'); // Reconnect to the database

    // Process form submission to update technician data

if (isset($_POST['update'])) {
    $technician_id = $_POST['technician_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialty = $_POST['specialty'];

    // Update query to modify the technician record

    $stmt = $connection->prepare("UPDATE technicians SET First_name = ?, Last_name = ?, Email = ?, Phone = ?, Specialty = ? WHERE Technician_id = ?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $specialty, $technician_id); // Corrected parameter types

    if ($stmt->execute()) { // If the query executes successfully
        header('Location: technician.php'); // Redirect to the list of technicians
        exit(); // Exit to avoid further code execution
    } else {
        
        // If there's an error during query execution
        echo "Error updating data: " . $stmt->error; 
    }
}
?>
