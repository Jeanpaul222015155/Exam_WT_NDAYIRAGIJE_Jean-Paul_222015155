<?php
include('database_connection.php'); // Connect to the database

// Check if the request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Correct the syntax by adding missing closing parentheses
    $first_name  = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $date_of_birth = $_POST['date_of_birth']; // Consider additional date validation
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Ensure valid email
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING); // Sanitize phone input
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing
    $referral_code = filter_var($_POST['referral_code'], FILTER_SANITIZE_STRING);

    // Prepare the SQL query to insert data into re_users
    $sql = "INSERT INTO re_users (first_name, last_name,  date_of_birth, username, email, password, phone, referral_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql); // Prepare the statement
    $stmt->bind_param("ssssssss", $first_name, $last_name, $date_of_birth, $username, $email, 
        $password, $phone, $referral_code); // Bind parameters

    // Execute the query and check if it's successful
    if ($stmt->execute()) {
        header("Location: login.html"); // Redirect after successful registration
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error; // Display error message if the query fails
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
