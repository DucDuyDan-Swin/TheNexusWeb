<?php
session_start();
include 'settings.php';

mysqli_query($dbconn, "CREATE DATABASE IF NOT EXISTS $sql_db");
mysqli_select_db($dbconn, $sql_db);

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.php");
    exit();
}

// Simple sanitization function
function clean($data) {
    return htmlspecialchars(trim($data));
}

// Collect and validate form data
$job_ref    = clean($_POST['job_ref'] ?? '');
$first_name = clean($_POST['first_name'] ?? '');
$last_name  = clean($_POST['last_name'] ?? '');
$dob        = clean($_POST['dob'] ?? '');
$gender     = clean($_POST['gender'] ?? '');
$address     = clean($_POST['address'] ?? '');
$suburb     = clean($_POST['suburb'] ?? '');
$state      = clean($_POST['state'] ?? '');
$postcode   = clean($_POST['postcode'] ?? '');
$email      = clean($_POST['email'] ?? '');
$phone      = preg_replace('/\s+/', '', clean($_POST['phone'] ?? ''));
$skills     = isset($_POST['skills']) ? $_POST['skills'] : [];
$other_skills = clean($_POST['other_skills'] ?? '');

$errors = [];

// Basic validation
if (!$job_ref) $errors[] = "Job reference is required.";
if (!$first_name || strlen($first_name) > 20 || !ctype_alpha($first_name)) $errors[] = "First name must be 1-20 letters.";
if (!$last_name || strlen($last_name) > 20 || !ctype_alpha($last_name)) $errors[] = "Last name must be 1-20 letters.";
if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $dob)) $errors[] = "Date of birth must be dd/mm/yyyy.";
if (!checkdate($dob_parts[1], $dob_parts[0], $dob_parts[2])) {
    $errors[] = "Invalid date of birth.";
}
if (!$gender) $errors[] = "Gender is required.";
if (!$address || strlen($address) > 40) $errors[] = "Street address must be 1-40 chars.";
if (!$suburb || strlen($suburb) > 40) $errors[] = "Suburb must be 1-40 chars.";
if (!in_array($state, ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'])) $errors[] = "Invalid state.";
if (!preg_match("/^\d{4}$/", $postcode)) $errors[] = "Postcode must be 4 digits.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
if (!preg_match("/^\d{8,12}$/", $phone)) $errors[] = "Phone must be 8-12 digits.";
if (empty($skills)) $errors[] = "Select at least one skill.";
if (in_array("Other", $skills) && empty($other_skills)) {
    $errors[] = "Please describe your other skills.";
}

// If errors, redirect back with errors
if ($errors) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header("Location: apply.php");
    exit();
}

// Convert DOB to MySQL format
$dob_parts = explode('/', $dob);
$mysql_dob = $dob_parts[2] . '-' . $dob_parts[1] . '-' . $dob_parts[0];

// Connect to DB
$dbconn = mysqli_connect($host, $username, $password, $sql_db);

// Create table if not exists
$create = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(50),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    dob DATE,
    gender VARCHAR(10),
    address VARCHAR(40),
    suburb VARCHAR(40),
    state VARCHAR(3),
    postcode VARCHAR(4),
    email VARCHAR(100),
    phone VARCHAR(12),
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    skill3 VARCHAR(50),
    skill4 VARCHAR(50),
    skill5 VARCHAR(50),
    skill6 VARCHAR(50),
    skill7 VARCHAR(50),
    skill8 VARCHAR(50),
    skill9 VARCHAR(50),
    skill10 VARCHAR(50),

    other_skills TEXT,
    status VARCHAR(10) DEFAULT 'New'
)";
mysqli_query($dbconn, $create);

// Prepare skills
$skill1 = $skills[0] ?? '';
$skill2 = $skills[1] ?? '';
$skill3 = $skills[2] ?? '';
$skill4 = $skills[3] ?? '';
$skill5 = $skills[4] ?? '';
$skill6 = $skills[5] ?? '';
$skill7 = $skills[6] ?? '';
$skill8 = $skills[7] ?? '';
$skill9 = $skills[8] ?? '';
$skill10 = $skills[9] ?? '';

// Insert EOI
$status = "New";

$stmt = mysqli_prepare($dbconn, "INSERT INTO eoi
    (job_ref, first_name, last_name, dob, gender, address, suburb, state, postcode, email, phone, skill1, skill2, skill3, skill4, skill5, skill6, skill7, skill8, skill9, skill10, other_skills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss",
    $job_ref, $first_name, $last_name, $mysql_dob, $gender, $address, $suburb, $state, $postcode, $email, $phone, $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, $skill7, $skill8, $skill9, $skill10, $other_skills);

mysqli_stmt_execute($stmt);

// Get EOI number
$eoi_number = mysqli_insert_id($dbconn);

mysqli_close($dbconn);

// Show confirmation
$_SESSION['success_message'] = "Your application has been submitted! Your EOI number is: " . $eoi_number;
$_SESSION['form_data'] = $_POST;  //
header("Location: confirmation.php");
exit();
?>