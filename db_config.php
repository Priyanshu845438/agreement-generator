<?php
$host = "localhost"; // Change if needed
$user = "root"; // Your DB username
$password = ""; // Your DB password
$database = "operator_agreement"; // Your DB name

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
