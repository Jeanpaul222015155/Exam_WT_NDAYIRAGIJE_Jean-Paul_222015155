<?php
include('database_connection.php'); 

// Fetch existing unit details for the given Unit_id

if (isset($_REQUEST['unit_id'])) {
    $unit_id = $_REQUEST['unit_id'];

    $stmt = $connection->prepare("SELECT * FROM units WHERE Unit_id = ?");
    $stmt->bind_param("i", $unit_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Extract values to display in the form

        $unit_id = $row['Unit_id'];
        $property_id = $row['Property_id'];
        $unit_number = $row['Unit_number'];
        $status = $row['Status'];
    } else {

        echo "Unit not found."; 
        exit(); 
    }

} else {
    echo "No Unit ID specified."; // Error message if no Unit_id provided
    exit(); // Exit script if Unit_id is missing
}
?>

 <!DOCTYPE html>
 <html>
 <head>

    <title>Update Unit</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Unit Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Confirmation before update -->
            
             <label for="unit_id">Unit ID:</label>
            <input type="number" id="unit_id" name="unit_id" value="<?= $unit_id ?>" readonly>
            <br><br>

             <label for="property_id">Property ID:</label>
            <input type="number" id="property_id" name="property_id" value="<?= $property_id ?>" required>
            <br><br>

             <label for="unit_number">Unit Number:</label>
            <input type="number" id="unit_number" name="unit_number" value="<?= $unit_number ?>" required>
            <br><br>

            <label for="status">Status:</label>
             <input type="text" id="status" name="status" value="<?= $status ?>" required>
            <br><br>

             <input type="submit" name="update" value="Update"> <!-- Submission button -->

            <a href="./unit.php">Go Back Form</a> <!-- Link to return to the main units page -->
        </form>
    </center>
</body>
</html>
    
       <?php
      include('database_connection.php'); 

if (isset($_POST['update'])) {

    $unit_id = $_POST['unit_id'];
    $property_id = $_POST['property_id'];
    $unit_number = $_POST['unit_number'];
    $status = $_POST['status'];

    // SQL query to update the unit record

    $stmt = $connection->prepare("UPDATE units SET Property_id = ?, Unit_number = ?, Status = ? WHERE Unit_id = ?");
    $stmt->bind_param("iisi", $property_id, $unit_number, $status, $unit_id);

    if ($stmt->execute()) { 
        header('Location: unit.php');

        exit(); // Exit to prevent further script execution
    } else {
        
        echo "Error updating data: " . $stmt->error; // Display error message
    }
}
?>
