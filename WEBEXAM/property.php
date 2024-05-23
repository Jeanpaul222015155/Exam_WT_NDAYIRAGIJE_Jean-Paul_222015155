<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Property information</title>
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

<body style="background-color: yellowgreen;">

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

  <section>
        <h1>Property Form</h1>
     <form method="post" onsubmit="return confirmInsert();">
      <label for="property_id">Property ID:</label>
      <input type="number" id="property_id" name="property_id" required><br><br>

      <label for="owner_id">Owner ID:</label>
      <input type="number" id="owner_id" name="owner_id" required><br><br>

      <label for="address">Address:</label>
      <input type="text" id="address" name="address" required><br><br>

      <label for="property_type">Property Type:</label>
      <input type="text" id="property_type" name="property_type" required><br><br>

      <label for="number_of_units">Number of Units:</label>
      <input type="number" id="number_of_units" name="number_of_units" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>
  </section>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $property_id = $_POST['property_id'];
      $owner_id = $_POST['owner_id'];
      $address = $_POST['address'];
      $property_type = $_POST['property_type'];
      $number_of_units = $_POST['number_of_units'];

      $stmt = $connection->prepare("INSERT INTO properties (Property_id, Owner_id, Address, Property_type, Number_of_units) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iissi", $property_id, $owner_id, $address, $property_type, $number_of_units);

      if ($stmt->execute()) {
          echo "New property record has been added successfully.<br><br><a href='property.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <section>
    <h2>Property Details</h2>
    <table>
      <tr>
        <th>Property ID</th>
        <th>Owner ID</th>
        <th>Address</th>
        <th>Property Type</th>
        <th>Number of Units</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM properties";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Property_id']}</td>
                    <td>{$row['Owner_id']}</td>
                    <td>{$row['Address']}</td>
                    <td>{$row['Property_type']}</td>
                    <td>{$row['Number_of_units']}</td>
                    <td><a href='delete_property.php?property_id={$row['Property_id']}'>Delete</a></td>
                    <td><a href='update_property.php?property_id={$row['Property_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @NDAYIRAGIJE Jean Paul 222015155</h2>
  </footer>

</body>
</html>
