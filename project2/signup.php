<?php
session_start();
include("settings.php");

$dbconn = mysqli_connect($host, $username, $password, $sql_db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data safely
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Escape special characters to prevent basic SQL injection
    $username = mysqli_real_escape_string($dbconn, $username);
    $hashedPassword = mysqli_real_escape_string($dbconn, $hashedPassword);

    // Insert user into the database
    $query = "INSERT INTO managers (username, password, role) VALUES ('$username', '$hashedPassword', 'user')";
    $result = mysqli_query($dbconn, $query);

    if ($result) {
        $signup_message = "Signup successful. You can now <a href='login.php'>login</a>.";
    } else {
        $signup_message = "Signup failed. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup page</title>
    <?php include 'header.inc'; ?>
</head>
<body>
    <header>
    <h1>Sign Up</h1>  
    </header>
<?php include 'nav.inc'; ?>
<main>
    <section class="Sign-up-form">
        <h1>Sign Up</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <br>
            <input type="submit" value="Sign-Up" class="submit-button-sign-up">
        </form>
        <?php if (!empty($signup_message)) echo "<p style='color:green;'>$signup_message</p>"; ?>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>