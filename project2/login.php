<?php
session_start();
include("settings.php");

$dbconn = mysqli_connect($host, $username, $password, $sql_db);

$login_error = ""; // Initialize error variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input safely
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Escape to prevent SQL injection
    $username = mysqli_real_escape_string($dbconn, $username);

    // Fetch user by username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($dbconn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Password is correct
        $_SESSION['username'] = $user['username'];
        header("Location: index.php"); // Redirect to a welcome/protected page
        exit();
    } else {
        $login_error = "Incorrect username or password.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<title>Nexus Login</title>
<?php include 'header.inc'; ?>
</head>
<body>
    <header>
    <h1>Login</h1>  
    </header>
<?php include 'nav.inc'; ?>
<main>
    <section class="login-form">
        <h1>Login</h1>
        <?php if (!empty($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <input type="submit" value="Login" class="submit-button-login">
        </form>
        <div class="signup-container">
            <a href="signup.php" class="submit-button-sign-up"><strong>Sign Up</strong></a>
        </div>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>