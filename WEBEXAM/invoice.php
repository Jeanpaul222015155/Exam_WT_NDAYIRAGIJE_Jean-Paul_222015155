<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Invoices</title>
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

<body style="background-color:darkorange;">

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
    <h1>Invoice Registration Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="invoice_id">Invoice ID:</label>
        <input type="number" id="invoice_id" name="invoice_id" required><br><br>

        <label for="payment_id">Payment ID:</label>
        <input type="number" id="payment_id" name="payment_id" required><br><br>

        <label for="invoice_date">Invoice Date:</label>
        <input type="date" id="invoice_date" name="invoice_date" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
</section>

<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $invoice_id = $_POST['invoice_id'];
    $payment_id = $_POST['payment_id'];
    $invoice_date = $_POST['invoice_date'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $stmt = $connection->prepare("INSERT INTO invoices (invoice_id, payment_id, invoice_date, amount, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $invoice_id, $payment_id, $invoice_date, $amount, $description);

    if ($stmt->execute()) {
        echo "New invoice record has been added successfully.<br><br><a href='invoices.php'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}
?>


<section>
    <h2>Invoice Details</h2>
    <table>
      <tr>
        <th>Invoice ID</th>
        <th>Payment ID</th>
        <th>Invoice Date</th>
        <th>Amount</th>
        <th>Description</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM invoices";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                    <td>{$row['invoice_id']}</td>
                    <td>{$row['payment_id']}</td>
                    <td>{$row['invoice_date']}</td>
                    <td>{$row['amount']}</td>
                    <td>{$row['description']}</td>
                    <td><a href='delete_invoice.php?invoice_id={$row['invoice_id']}'>Delete</a></td>
                    <td><a href='update_invoice.php?invoice_id={$row['invoice_id']}'>Update</a></td>
                   </tr>";
          }
      } else {
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
