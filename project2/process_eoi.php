<?php
session_start();
include 'settings.php';

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: jobs.php");
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
$street     = clean($_POST['street'] ?? '');
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
if (!$gender) $errors[] = "Gender is required.";
if (!$street || strlen($street) > 40) $errors[] = "Street address must be 1-40 chars.";
if (!$suburb || strlen($suburb) > 40) $errors[] = "Suburb must be 1-40 chars.";
if (!in_array($state, ['VIC','NSW','QLD','NT','WA','SA','TAS','ACT'])) $errors[] = "Invalid state.";
if (!preg_match("/^\d{4}$/", $postcode)) $errors[] = "Postcode must be 4 digits.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
if (!preg_match("/^\d{8,12}$/", $phone)) $errors[] = "Phone must be 8-12 digits.";
if (empty($skills)) $errors[] = "Select at least one skill.";

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
$conn = mysqli_connect($host, $username, $password, $database);

// Create table if not exists
$create = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_ref VARCHAR(50),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    dob DATE,
    gender VARCHAR(10),
    street VARCHAR(40),
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
mysqli_query($conn, $create);

// Prepare skills
$skill1 = $skills[0] ?? '';
$skill2 = $skills[1] ?? '';
$skill3 = $skills[2] ?? '';

// Insert EOI
$stmt = mysqli_prepare($conn, "INSERT INTO eoi
    (job_ref, first_name, last_name, dob, gender, street, suburb, state, postcode, email, phone, skill1, skill2, skill3, other_skills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssssssssssssss",
    $job_ref, $first_name, $last_name, $mysql_dob, $gender, $street, $suburb, $state, $postcode, $email, $phone, $skill1, $skill2, $skill3, $other_skills);
mysqli_stmt_execute($stmt);

// Get EOI number
$eoi_number = mysqli_insert_id($conn);

mysqli_close($conn);

// Show confirmation
$_SESSION['success_message'] = "Your application has been submitted! Your EOI number is: " . $eoi_number;
header("Location: confirmation.php");
exit();
?>