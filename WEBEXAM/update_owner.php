<?php
include('database_connection.php');

if (isset($_REQUEST['owner_id'])) {
    $owner_id = $_REQUEST['owner_id'];
    
    $stmt = $connection->prepare("SELECT * FROM owners WHERE owner_id = ?");
    $stmt->bind_param("i", $owner_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $owner_id = $row['Owner_id'];
        $first_name = $row['First_name'];
        $last_name = $row['Last_name'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $address = $row['Address'];
        $company = $row['Company'];
    } else {
        echo "Owner not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Owner</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body style="background-color: skyblue;">
    <center>
        <h2><u>Update Owner Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="owner_id">Owner ID:</label>
            <input type="number" id="owner_id" name="owner_id" value="<?php echo isset($owner_id) ? $owner_id : ''; ?>" readonly>
            <br><br>

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">
            <br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">
            <br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            <br><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
            <br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
            <br><br>

            <label for="company">Company:</label>
            <input type="text" id="company" name="company" value="<?php echo isset($company) ? $company : ''; ?>">
            <br><br>

            <input type="submit" name="update" value="Update">
            <a href="./owner.php">Go Back to Form</a>
        </form>
    </center>
</body>
</html>
<?php
include('database_connection.php');

if (isset($_POST['update'])) {
    $owner_id = $_POST['owner_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $company = $_POST['company'];

    $stmt = $connection->prepare("UPDATE owners SET First_name = ?, Last_name = ?, Email = ?, Phone = ?, Address = ?, Company = ? WHERE owner_id = ?");
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $phone, $address, $company, $owner_id);

    if ($stmt->execute()) {
        header('Location: owner.php'); // Redirect after successful update
        exit();
    } else {
        echo "Error updating data: " . $stmt->error;
    }
}
?>
