<?php
// AfriStaff Database Configuration
// Connects to MySQL on port 3307 using mysqli

$host = "localhost";
$port = 3307;
$username = "root";
$password = "";          // Default XAMPP root password is empty
$database = "afristaff_db";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optional: set charset for proper character handling
mysqli_set_charset($conn, "utf8mb4");
?>
