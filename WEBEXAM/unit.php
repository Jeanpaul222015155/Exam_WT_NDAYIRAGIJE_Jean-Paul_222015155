<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Unit Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* NDAYIRAGIJE Jean paul 222015155 GROUP B WEB_TEC */
    /* Keeping existing styles, adjusted for 'UNIT' context */
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
      background-color:green;
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
      background-color:green;
      min-width: 160px;
      box-shadow: 5px 8px 16px 10px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color:darkblue;
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

<body style="background-color:yellowgreen;">

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
    <h1>Unit Registration Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="unit_id">Unit ID:</label>
      <input type="number" id="unit_id" name="unit_id" required><br><br>

      <label for="property_id">Property ID:</label>
      <input type="number" id="property_id" name="property_id" required><br><br>

      <label for="unit_number">Unit Number:</label>
      <input type="text" id="unit_number" name="unit_number" required><br><br>

      <label for="status">Status:</label>
      <input type="text" id="status" name="status" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>
  </section>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $unit_id = $_POST['unit_id'];
      $property_id = $_POST['property_id'];
      $unit_number = $_POST['unit_number'];
      $status = $_POST['status'];

      $stmt = $connection->prepare("INSERT INTO units (Unit_id, Property_id, Unit_number, Status) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("iiss", $unit_id, $property_id, $unit_number, $status);

      if ($stmt->execute()) {
          echo "New unit record has been added successfully.<br><br><a href='unit.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <section>
    <h2>Unit Details</h2>
    <table>
      <tr>
        <th>Unit ID</th>
        <th>Property ID</th>
        <th>Unit Number</th>
        <th>Status</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM units";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Unit_id']}</td>
                    <td>{$row['Property_id']}</td>
                    <td>{$row['Unit_number']}</td>
                    <td>{$row['Status']}</td>
                    <td><a href='delete_unit.php?unit_id={$row['Unit_id']}'>Delete</a></td>
                    <td><a href='update_unit.php?unit_id={$row['Unit_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @NDAYIRAGIJE Jean Paul 222015155</h2>
  </footer>

</body>
</html>
