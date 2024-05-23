<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Maintenance Request</title>
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
      background-color:green;
      color: white;
    }

    tr:hover {
      background-color:skyblue;
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
    <h1>Maintenance Request Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="request_id">Request ID:</label>
      <input type="number" id="request_id" name="request_id" required><br><br>

      <label for="unit_id">Unit ID:</label>
      <input type="number" id="unit_id" name="unit_id" required><br><br>

      <label for="tenant_id">Tenant ID:</label>
      <input type="number" id="tenant_id" name="tenant_id" required><br><br>

      <label for="request_date">Request Date:</label>
      <input type="date" id="request_date" name="request_date" required><br><br>

      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required><br><br>

      <label for="status">Status:</label>
      <input type="text" id="status" name="status" required><br><br>

      <label for="assigned_to">Assigned To:</label>
      <input type="text" id="assigned_to" name="assigned_to" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>
  </section>
  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $request_id = $_POST['request_id'];
      $unit_id = $_POST['unit_id'];
      $tenant_id = $_POST['tenant_id'];
      $request_date = $_POST['request_date'];
      $description = $_POST['description'];
      $status = $_POST['status'];
      $assigned_to = $_POST['assigned_to'];

      $stmt = $connection->prepare("INSERT INTO maintenancerequests (Request_id, Unit_id, Tenant_id, Request_date, Description, Status, Assigned_to) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiisss", $request_id, $unit_id, $tenant_id, $request_date, $description, $status, $assigned_to);

      if ($stmt->execute()) {
          echo "New maintenance request has been added successfully.<br><br><a href='MaintenanceReq.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <section>
    <h2>Maintenance Request Details</h2>
    <table>
      <tr>
        <th>Request ID</th>
        <th>Unit ID</th>
        <th>Tenant ID</th>
        <th>Request Date</th>
        <th>Description</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $result = $connection->query("SELECT * FROM maintenancerequests");

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Request_id']}</td>
                    <td>{$row['Unit_id']}</td>
                    <td>{$row['Tenant_id']}</td>
                    <td>{$row['Request_date']}</td>
                    <td>{$row['Description']}</td>
                    <td>{$row['Status']}</td>
                    <td>{$row['Assigned_to']}</td>
                    <td><a href='delete_MaintenanceReq.php?request_id={$row['Request_id']}'>Delete</a></td>
                    <td><a href='update_MaintenanceReq.php?request_id={$row['Request_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
          echo "<tr><td colspan='9'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @NDAYIRAGIJE Jean Paul 222015155</h2>
  </footer>

</body>
</html>
