<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Owner Information</title>
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
    <h1>Owner Registration Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="owner_id">Owner ID:</label>
        <input type="number" id="owner_id" name="owner_id" required><br><br>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        <label for="company">Company:</label>
        <input type="text" id="company" name="company" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a> 
    </form>
  </section>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      $owner_id = $_POST['owner_id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      $company = $_POST['company'];

      $stmt = $connection->prepare("INSERT INTO owners (Owner_id, First_name, Last_name, Email, Phone, Address, Company) VALUES (?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("issssss", $owner_id, $first_name, $last_name, $email, $phone, $address, $company);

      if ($stmt->execute()) {
          echo "New owner record has been added successfully.<br><br><a href='owners.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <section>
    <h2>Owners Detail</h2>
    <table>
      <tr>
        <th>Owner ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM owners";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['Owner_id']}</td>
                    <td>{$row['First_name']}</td>
                    <td>{$row['Last_name']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Phone']}</td>
                    <td>{$row['Address']}</td>
                    <td>{$row['Company']}</td>
                    <td><a href='delete_owner.php?owner_id={$row['Owner_id']}'>Delete</a></td>
                    <td><a href='update_owner.php?owner_id={$row['Owner_id']}'>Update</a></td>
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
