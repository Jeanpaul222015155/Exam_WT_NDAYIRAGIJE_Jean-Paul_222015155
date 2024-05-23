<?php
// Include database connection script
include('database_connection.php');

  // Check if the HTTP request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve email and password from the submitted form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM re_users WHERE email=?"; 
    // Prepare the SQL statement
    $stmt = $connection->prepare($sql);

    // Bind the email parameter to the prepared statement
    $stmt->bind_param("s", $email);
      // Execute the prepared statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

         // Fetch the row
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.html");
            exit();
        } else {
            // Display error message for invalid email or password
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }
}
// Close the database connection
$connection->close();
?>
