<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <style>
        body {
            background-color: yellowgreen;
        }
        h2, h3 {
            margin: 10px 0;
        }
        p {
            margin: 5px 0;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
include('database_connection.php');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['query'])) {
    // Sanitize the input to avoid SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    $queries = [
        'expenses' => "SELECT Expense_id, Expense_type, amount 
                       FROM expenses 
                       WHERE Expense_id LIKE '%$searchTerm%' 
                       OR Expense_type LIKE '%$searchTerm%'",

        'invoices' => "SELECT invoice_id, payment_id, amount 
                       FROM invoices 
                       WHERE invoice_id LIKE '%$searchTerm%' 
                       OR payment_id LIKE '%$searchTerm%'",

        'leases' => "SELECT Lease_id, Unit_id, Tenant_id, Monthly_rent
                     FROM leases 
                     WHERE Lease_id LIKE '%$searchTerm%' 
                     OR Tenant_id LIKE '%$searchTerm%'",

        'maintenancerequests' => "SELECT Request_id, Description 
                                  FROM maintenancerequests 
                                  WHERE Request_id LIKE '%$searchTerm%' 
                                  OR Description LIKE '%$searchTerm%'",

        'owners' => "SELECT Owner_id, First_name, Last_name 
                     FROM owners 
                     WHERE Owner_id LIKE '%$searchTerm%' 
                     OR First_name LIKE '%$searchTerm%' 
                     OR Last_name LIKE '%$searchTerm%'",

        'properties' => "SELECT Property_id, Property_type 
                         FROM properties 
                         WHERE Property_id LIKE '%$searchTerm%' 
                         OR Property_type LIKE '%$searchTerm%'",

        'propertyinspections' => "SELECT Inspection_id, Inspection_date 
                                  FROM propertyinspections 
                                  WHERE Inspection_id LIKE '%$searchTerm%' 
                                  OR Inspection_date LIKE '%$searchTerm%'",

        'rentpayments' => "SELECT Payment_id, amount 
                           FROM rentpayments 
                           WHERE Payment_id LIKE '%$searchTerm%' 
                           OR amount LIKE '%$searchTerm%'",

        'technicians' => "SELECT Technician_id, First_name, Last_name, Phone, Specialty 
                          FROM technicians 
                          WHERE Technician_id LIKE '%$searchTerm%' 
                          OR First_name LIKE '%$searchTerm%' 
                          OR Last_name LIKE '%$searchTerm%'",

        'tenants' => "SELECT Tenant_id, Email, Phone, Address 
                      FROM tenants 
                      WHERE Tenant_id LIKE '%$searchTerm%' 
                      OR Email LIKE '%$searchTerm%'",

        'units' => "SELECT Unit_id, Property_id, Status 
                    FROM units 
                    WHERE Unit_id LIKE '%$searchTerm%' 
                    OR Property_id LIKE '%$searchTerm%'",

        're_users' => "SELECT registration_user_id, first_name, Last_name, email, phone
                      FROM re_users
                      WHERE registration_user_id LIKE '%$searchTerm%'
                      OR email LIKE '%$searchTerm%'
                      OR phone LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: " . ucfirst($table) . "</h3>";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                foreach ($row as $key => $value) {
                    echo "<strong>" . htmlspecialchars($key) . "</strong>: " . htmlspecialchars($value) . " ";
                }
                echo "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '" . htmlspecialchars($searchTerm) . "'</p>";
        }
    }

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}

echo '<a href="home.html"><button>&larr; Back to home</button></a>';
?>
</body>
</html>
