
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Property Inspection</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* NDAYIRAGIJE Jean paul 222015155 GROUP B WEB_TEC */
    a {
      padding: 7px;
      color: white;
      background-color: turquoise;
      text-decoration: none;
      margin-right: 5px;
    }

    a:link {
      color: brown;
    }

    a:visited {
      color: purple;
    }

    a:hover {
      background-color: white;
      text-decoration: underline;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 20px;
      margin-top: 10px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 2px solid black;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: orange;
    }

    td:first-child {
      background-color: green;
      color: white;
    }

    tr:hover {
      background-color: skyblue;
    }

    section {
      padding: 20px;
      border-bottom: 3px solid #ddd;
    }

    header {
      text-align: center;
      padding: 20px;
      background-color: blue;
      color: white;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: blue;
      color: white;
    }

    .navbar {
      list-style-type: none;
      padding: 0;
      text-align: center;
    }

    .navbar li {
      display: inline-block;
      margin-right: 10px;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover a {
      background-color: orange;
      color: green;
    }
  </style>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

 <!-- Setting background color for the body -->
<body style="background-color: yellowgreen;">

  <!-- Header section with logo and navigation bar -->
  <header>
    <div>
      <img src="./Images/a.jpg" width="90" height="60" alt="Logo">
    </div>
    <ul class="navbar">
      <ul class="navbar">
    <li style="display: inline; margin-right: 5px;"><a href="./owner.php">OWNER</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./property.php">PROPERTY</a></li>
    <li style="display: inline; margin-right: 5px;"><a href="./unit.php">UNIT</a></li>
      <li style="display: inline; margin-right: 5px;"><a href="./tenant.php">TENANT</a></li>
        <li style="display: inline; margin-right: 5px;"><a href="./lease.php">LEASE</a></li>
     <li style="display: inline; margin-right: 5px;"><a href="./rentpayment.php">RENTPAYMENT</a></li>
      <li style="display: inline; margin-right: 5px;"><a href="./MaintenanceReq.php">MAINTENANCEREQ</a></li>
      <li style="display: inline; margin-right: 5px;"><a href="./technician.php">TECHNICIAN</a>
      </li>
      <li style="display: inline; margin-right: 5px;"><a href="./propertyinspec.php">PROPERTYINSPEC</a></li>
      <li style="display: inline; margin-right: 5px;"><a href="./Expense.php">EXPENSE</a></li>
        
        <li style="display: inline; margin-right: 5px;"><a href="./invoice.php">INVOICE</a>
        <li class="dropdown">
        <a href="#">Settings</a>
        <div class="dropdown-content">
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>

    <div class="search-form" style="text-align: right; padding: 10px;">
      <form role="search" action="search.php">
        <input class="form-control" type="search" placeholder="Search..." aria-label="Search" name="query">
        <button class="btn" type="submit">Search</button>
      </form>
    </div>
  </header>
 <!-- Property inspection form section -->
<section>
    <h1>Property Inspection Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="inspection_id">Inspection ID:</label>
        <input type="number" id="inspection_id" name="inspection_id" required><br><br>

        <label for="property_id">Property ID:</label>
        <input type="number" id="property_id" name="property_id" required><br><br>

        <label for="inspection_date">Inspection Date:</label>
        <input type="date" id="inspection_date" name="inspection_date" required><br><br>

        <label for="inspector">Inspector:</label>
        <input type="text" id="inspector" name="inspector" required><br><br>

        <label for="notes">Notes:</label>
        <textarea id="notes" name="notes" rows="4" cols="50"></textarea><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
</section>

<?php
  // Include the database connection script
include('database_connection.php');

   // Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

   // Retrieve form data
    $inspection_id = $_POST['inspection_id'];
    $property_id = $_POST['property_id'];
    $inspection_date = $_POST['inspection_date'];
    $inspector = $_POST['inspector'];
    $notes = $_POST['notes'];

    // Prepare SQL insert statement

    $stmt = $connection->prepare("INSERT INTO propertyinspections (Inspection_id, Property_id, Inspection_date, Inspector, Notes) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $inspection_id, $property_id, $inspection_date, $inspector, $notes);
     
     // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "New property inspection record has been added successfully.<br><br><a href='propertyinspec.php'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

     // Close the statement
    $stmt->close();
}
?>
 <!-- Section to display property inspection details in a table -->
<section>
    <h2>Property Inspection Details</h2>
    <table>
      <tr>
        <th>Inspection ID</th>
        <th>Property ID</th>
        <th>Inspection Date</th>
        <th>Inspector</th>
        <th>Notes</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php

      // SQL query to select all records from the property inspections table
      $sql = "SELECT * FROM propertyinspections";
      $result = $connection->query($sql);
      
      // Check if any records were returned
      if ($result->num_rows > 0) {

        // Fetch and display each record as a row in the table
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Inspection_id']}</td>
                    <td>{$row['Property_id']}</td>
                    <td>{$row['Inspection_date']}</td>
                    <td>{$row['Inspector']}</td>
                    <td>{$row['Notes']}</td>
                    <td><a href='delete_propertyinspec.php?inspection_id={$row['Inspection_id']}'>Delete</a></td>
                    <td><a href='update_propertyinspec.php?inspection_id={$row['Inspection_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
        // Display a message if no records were found
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      ?>
    </table>
</section>

