<?php
include 'settings.php';

$conn = mysqli_connect($host, $username, $password, $sql_db);
if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}

$new_password = password_hash('admin1234', PASSWORD_DEFAULT);
$sql = "UPDATE managers SET password='$new_password' WHERE username='admin'";
if (mysqli_query($dbconn, $sql)) {
    echo "Admin password reset to admin1234";
} else {
    echo "Error resetting password: " . mysqli_error($dbconn);
}
mysqli_close($dbconn);
?>