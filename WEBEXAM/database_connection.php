<?php
$host = "localhost";
$user = "Njeanpaul";
$pass = "222015155";
$database = "propertymanagement";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}