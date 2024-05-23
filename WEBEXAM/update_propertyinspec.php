<?php
// Connect to the database
include('database_connection.php');

// Fetch existing inspection details based on Inspection_id

if (isset($_REQUEST['inspection_id'])) {
    $inspection_id = $_REQUEST['inspection_id'];

    $stmt = $connection->prepare("SELECT * FROM propertyinspections WHERE Inspection_id = ?");
    $stmt->bind_param("i", $inspection_id); // Bind integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) { // Check if at least one record is found
        $row = $result->fetch_assoc(); // Fetch the data

               // Store the fetched values to pre-fill the form

        $property_id = $row['Property_id'];
        $inspection_date = $row['Inspection_date'];
        $inspector = $row['Inspector'];
        $notes = $row['Notes'];
    } else {
        echo "Inspection not found."; // If no record is found

        exit(); // Stop if no matching record
    }
} else {
    echo "No inspection ID specified."; // If no `inspection_id` is provided

    exit(); // Exit to prevent further code execution
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Update Property Inspection</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?'); // Confirmation prompt
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Property Inspection Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();"> <!-- Form to update property inspection -->
            <!-- Pre-fill the form with existing inspection data -->
            <label for="inspection_id">Inspection ID:</label>
            <input type="number" id="inspection_id" name="inspection_id" value="<?php echo $inspection_id; ?>" readonly> <!-- Read-only -->
            <br><br>

            <label for="property_id">Property ID:</label>
            <input type="number" id="property_id" name="property_id" value="<?php echo $property_id; ?>" required>
            <br><br>

            <label for="inspection_date">Inspection Date:</label>
            <input type="date" id="inspection_date" name="inspection_date" value="<?php echo $inspection_date; ?>" required>
            <br><br>

            <label for="inspector">Inspector:</label>
            <input type="text" id="inspector" name="inspector" value="<?php echo $inspector; ?>" required>
            <br><br>

            <label for="notes">Notes:</label>
            <input type="text" id="notes" name="notes" value="<?php echo $notes; ?>">
            <br><br>

            <input type="submit" name="update" value="Update"> 
            <a href="./propertyinspec.php">Go Back Form</a> <!-- Link to return to the list of inspections -->
        </form>
    </center>
</body>
</html>

<?php
        // Reconnect to the database
include('database_connection.php'); 

          // Process form submission to update property inspection data

if (isset($_POST['update'])) {

            // Get values from the form

    $inspection_id = $_POST['inspection_id'];
    $property_id = $_POST['property_id'];
    $inspection_date = $_POST['inspection_date'];
    $inspector = $_POST['inspector'];
    $notes = $_POST['notes'];

              // Update query to modify the property inspection record

    $stmt = $connection->prepare("UPDATE propertyinspections SET Property_id = ?, Inspection_date = ?, Inspector = ?, Notes = ? WHERE Inspection_id = ?");
    $stmt->bind_param("isssi", $property_id, $inspection_date, $inspector, $notes, $inspection_id); // Corrected parameter types

    if ($stmt->execute()) { // If the update is successful
        header('Location: propertyinspec.php'); // Redirect to the list of property inspections

        exit(); // Exit to prevent further execution
    } else {
        echo "Error updating data: " . $stmt->error; // If there's an error, display it
    }
}
?>
