<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // No password, based on our previous discussions
$dbname = "worklogsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
