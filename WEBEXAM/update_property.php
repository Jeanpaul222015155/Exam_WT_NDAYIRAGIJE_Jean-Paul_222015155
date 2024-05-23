<?php
include('database_connection.php'); 

// Fetch property details to display for updating

if (isset($_REQUEST['property_id'])) {
    $property_id = $_REQUEST['property_id'];

    $stmt = $connection->prepare("SELECT * FROM properties WHERE Property_id = ?");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Assign retrieved values to appropriate variables for display in the form

        $property_id = $row['Property_id'];
        $owner_id = $row['Owner_id'];
        $address = $row['Address'];
        $property_type = $row['Property_type'];
        $number_of_units = $row['Number_of_units'];
    } else {
        echo "Property not found.";
        exit();        // Exit if the property is not found
    }
} else {
    echo "No property ID specified.";
    exit();   // Exit if property_id is not provided
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Property</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Property Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="property_id">Property ID:</label>
            <input type="number" id="property_id" name="property_id" value="<?= $property_id ?>" readonly>
            <br><br>

            <label for="owner_id">Owner ID:</label>
            <input type="number" id="owner_id" name="owner_id" value="<?= $owner_id ?>" required>
            <br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?= $address ?>" required>
            <br><br>

            <label for="property_type">Property Type:</label>
            <input type="text" id="property_type" name="property_type" value="<?= $property_type ?>" required>
            <br><br>

            <label for="number_of_units">Number of Units:</label>
            <input type="number" id="number_of_units" name="number_of_units" value="<?= $number_of_units ?>" required>
            <br><br>

            <input type="submit" name="update" value="Update"> <!-- Changed button name to 'update' -->
            <a href="./property.php">Go Back Form</a>
        </form>
    </center>
</body>
</html>

<?php

// Handle form submission to update property data

if (isset($_POST['update'])) {
      $property_id = $_POST['property_id']; 
      $owner_id = $_POST['owner_id'];
       $address = $_POST['address'];
        $property_type = $_POST['property_type'];
       $number_of_units = $_POST['number_of_units'];

    $stmt = $connection->prepare("UPDATE properties SET Owner_id = ?, Address = ?, Property_type = ?, Number_of_units = ? WHERE Property_id = ?");
    $stmt->bind_param("isssi", $owner_id, $address, $property_type, $number_of_units, $property_id); 


    if ($stmt->execute()) {
        header('Location: property.php'); // Corrected redirect path
        exit();
        
    } else {
        echo "Error updating data: " . $stmt->error; // Show detailed error
    }
}
?>
