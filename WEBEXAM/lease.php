<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>lease information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Styles for navigation links */
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
    // Function to confirm insertion of a new record
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: yellowgreen;">

  <!-- Header section with logo and navigation menu -->

  <header>
    <div>
      <!-- Logo image -->
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
  <!-- Main content section with lease registration form -->
  <section>
    <h1>Lease Registration Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="lease_id">Lease ID:</label>
      <input type="number" id="lease_id" name="lease_id" required><br><br>

      <label for="unit_id">Unit ID:</label>
      <input type="number" id="unit_id" name="unit_id" required><br><br>

      <label for="tenant_id">Tenant ID:</label>
      <input type="number" id="tenant_id" name="tenant_id" required><br><br>

      <label for="lease_start_date">Lease Start Date:</label>
      <input type="date" id="lease_start_date" name="lease_start_date" required><br><br>

      <label for="lease_end_date">Lease End Date:</label>
      <input type="date" id="lease_end_date" name="lease_end_date" required><br><br>

      <label for="monthly_rent">Monthly Rent:</label>
      <input type="number" id="monthly_rent" name="monthly_rent" required><br><br>

      <!-- Submit button -->
      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>
  </section>

  <?php
  // Including the database connection file
  include('database_connection.php');

    // Handling form submission for adding a new lease

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {

    // Retrieving form data
      $lease_id = $_POST['lease_id'];
      $unit_id = $_POST['unit_id'];
      $tenant_id = $_POST['tenant_id'];
      $lease_start_date = $_POST['lease_start_date'];
      $lease_end_date = $_POST['lease_end_date'];
      $monthly_rent = $_POST['monthly_rent'];

     // Preparing and executing the SQL statement to insert a new lease record

      $stmt = $connection->prepare("INSERT INTO leases (Lease_id, Unit_id, Tenant_id, Lease_start_date, Lease_end_date, Monthly_rent) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiisd", $lease_id, $unit_id, $tenant_id, $lease_start_date, $lease_end_date, $monthly_rent);

     // Checking if the insertion was successful
      if ($stmt->execute()) {
          echo "New lease record has been added successfully.<br><br><a href='lease.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }
    // Closing the statement
      $stmt->close();
  }
  ?>
<!-- Section to display lease details in a table -->
  <section>
    <h2>Lease Details</h2>
    <table>
      <tr>
        <!-- Table headers -->
        <th>Lease ID</th>
        <th>Unit ID</th>
        <th>Tenant ID</th>
        <th>Lease Start Date</th>
        <th>Lease End Date</th>
        <th>Monthly Rent</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php

   // Fetching and displaying lease records from the database

      $sql = "SELECT * FROM leases";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
        // Displaying each record as a table row
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Lease_id']}</td>
                    <td>{$row['Unit_id']}</td>
                    <td>{$row['Tenant_id']}</td>
                    <td>{$row['Lease_start_date']}</td>
                    <td>{$row['Lease_end_date']}</td>
                    <td>{$row['Monthly_rent']}</td>
                    <td><a href='delete_lease.php?lease_id={$row['Lease_id']}'>Delete</a></td>
                    <td><a href='update_lease.php?lease_id={$row['Lease_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
         // Message when no data is found
          echo "<tr><td colspan='8'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @NDAYIRAGIJE Jean Paul 222015155</h2>
  </footer>

</body>
</html>
