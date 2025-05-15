<?php
session_start();
include 'settings.php';

// Test database connection
$dbconn = mysqli_connect($host, $username, $password, $sql_db);
if (!$dbconn) {
    die("Database connection failed: " . mysqli_connect_error());
} else {
    // Optional: echo "Database connection successful!";
    mysqli_close($dbconn);
}

// Redirect if already logged in
if (isset($_SESSION['manager_logged_in']) && $_SESSION['manager_logged_in'] === true) {
    header('Location: index.php');
    exit();
}

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username'] ?? '');
    $input_password = $_POST['password'] ?? '';

    // Connect to database
    $dbconn = mysqli_connect($host, $username, $password, $sql_db);

    if ($dbconn) {
        $safe_username = mysqli_real_escape_string($dbconn, $input_username);
        $query = "SELECT * FROM managers WHERE username='$safe_username'";
        $result = mysqli_query($dbconn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($input_password, $row['password'])) {
                $_SESSION['manager_logged_in'] = true;
                $_SESSION['manager_id'] = $row['id'];
                header('Location: index.php'); // Redirect to index.php after login
                exit();
            }
        }
        $login_error = "Invalid username or password";
        mysqli_close($dbconn);
    } else {
        $login_error = "Database connection failed.";
    }
}
?>

<title>Nexus Login</title>
<?php include 'header.inc'; ?>
<body>
    <header>
    <h1>Login</h1>  
    </header>
<?php include 'nav.inc'; ?>
<main>
    <section class="login-form">
        <h1>Login</h1>
        <?php if ($login_error): ?>
            <div class="error-message"><?php echo $login_error; ?></div>
        <?php endif; ?>
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
        <input type="submit" value="Sign Up" class="submit-button-sign-up">
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>