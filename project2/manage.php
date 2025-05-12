<?php
session_start();
include 'settings.php';
if (!isset($_SESSION['manager_logged_in']) || $_SESSION['manager_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Connect to database
$dbconn = mysqli_connect($host, $username, $password, $sql_db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage EOIs</title>
    <link href="styles/style.css" rel="stylesheet">
</head>
<body>
<?php include 'header.inc'; ?>
<main>
    <h1>All Expressions of Interest</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        <?php
        if ($dbconn) {
            $result = mysqli_query($dbconn, "SELECT * FROM managers");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "</tr>";
            }
            mysqli_close($dbconn);
        } else {
            echo "<tr><td colspan='2'>Database connection failed.</td></tr>";
        }
        ?>
    </table>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>