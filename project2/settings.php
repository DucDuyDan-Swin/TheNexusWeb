<?php
// Database connection settings (default XAMPP)
$host = "localhost";
$username = "root";
$password = "";
$sql_db = "nexus_db";

$dbconn = mysqli_connect($host, $username, $password, $sql_db);

// Error reporting for development (remove or set to 0 for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Charset for database
$charset = 'utf8mb4';
?>