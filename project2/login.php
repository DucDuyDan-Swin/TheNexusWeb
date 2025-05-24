<?php
if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
}
session_start();
include("settings.php");

$dbconn = mysqli_connect($host, $username, $password, $sql_db);

if (!isset($_SESSION['login_attempts'])) $_SESSION['login_attempts'] = 0;
if (!isset($_SESSION['lockout_time'])) $_SESSION['lockout_time'] = 0;

if ($_SESSION['lockout_time'] > time()) {
    die("Too many failed attempts. Try again after 5 minutes");
}

$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    $username = mysqli_real_escape_string($dbconn, $username);

    $query = "SELECT * FROM managers WHERE username = '$username'";
    $result = mysqli_query($dbconn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['manager_logged_in'] = ($user['role'] === 'admin');
        $_SESSION['login_attempts'] = 0; // reset on success
        $_SESSION['lockout_time'] = 0;
        if ($user['role'] === 'admin') {
            header("Location: manage.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['lockout_time'] = time() + 300; // 5 minutes
            $login_error = "Too many failed attempts. Try again after 5 minutes ";
        } else {
            $login_error = "Incorrect username or password.";
        }
    }
}
$login_error = ""; // Initialize error variable

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input safely
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Escape to prevent SQL injection
    $username = mysqli_real_escape_string($dbconn, $username);

    // Fetch user by username
    $query = "SELECT * FROM managers WHERE username = '$username'";
    $result = mysqli_query($dbconn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
    // Password is correct
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    if ($user['role'] === 'admin') {
        $_SESSION['manager_logged_in'] = true;
        header("Location: manage.php"); // Redirect to admin page
    } else {
        header("Location: index.php"); // Redirect to user page
    }
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
            <div class="form-login-signup">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-login-signup">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <div class="signup-container">
                <input type="submit" value="Login" class="submit-button-login">
                <a href="signup.php" class="submit-button-sign-up">Sign Up</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>