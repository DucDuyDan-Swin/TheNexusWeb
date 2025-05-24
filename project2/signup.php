<?php
session_start();
include("settings.php");

$dbconn = mysqli_connect($host, $username, $password, $sql_db);

$signup_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Server-side validation
    $username = mysqli_real_escape_string($dbconn, $username);
    $password = mysqli_real_escape_string($dbconn, $password);

    // Check for unique username
    $check = mysqli_query($dbconn, "SELECT * FROM managers WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $signup_message = "Username already exists.";
    } elseif (
        strlen($password) < 8 ||
        !preg_match('/[A-Z]/', $password) ||
        !preg_match('/[a-z]/', $password) ||
        !preg_match('/[0-9]/', $password)
    ) {
        $signup_message = "Password must be at least 8 characters and contain an uppercase letter, a lowercase letter, and a number.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO managers (username, password, role) VALUES ('$username', '$hashedPassword', 'user')";
        $result = mysqli_query($dbconn, $query);
        if ($result) {
            $signup_message = "Signup successful. You can now <a href='login.php'>login</a>.";
        } else {
            $signup_message = "Signup failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manager Sign Up</title>
    <?php include 'header.inc'; ?>
</head>
<body>
    <header>
    <h1>Manager Sign Up</h1>  
    </header>
<?php include 'nav.inc'; ?>
<main>
    <section class="Sign-up-form">
        <h1>Sign Up</h1>
        <?php if (!empty($signup_message)) echo "<p style='color:green;'>$signup_message</p>"; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <small>Password must be at least 8 characters, include an uppercase letter, a lowercase letter, and a number.</small>
            </div>
            <br>
            <input type="submit" value="Sign-Up" class="submit-button-sign-up">
        </form>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>