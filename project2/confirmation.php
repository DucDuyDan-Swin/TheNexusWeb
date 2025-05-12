<?php
session_start();

$success_message = $_SESSION['success_message'] ?? 'No confirmation message.';
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['success_message']);
unset($_SESSION['form_data']);

function safe($key) {
    global $form_data;
    return htmlspecialchars($form_data[$key] ?? '');
}

function showSkills() {
    global $form_data;
    if (!isset($form_data['skills'])) return 'None selected';
    return implode(', ', array_map('htmlspecialchars', $form_data['skills']));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Application Confirmation</title>
    </head>
    <body>
        <h1>Application Received</h1>
    <p><?php echo $success_message; ?></p>

    <p>Thank you for applying. We have received your application.</p>
    <h2>Your Submitted Information</h2>
    <ul>
        <li><strong>Job Reference:</strong> <?php echo safe('job_ref'); ?></li>
        <li><strong>First Name:</strong> <?php echo safe('first_name'); ?></li>
        <li><strong>Last Name:</strong> <?php echo safe('last_name'); ?></li>
        <li><strong>Date of Birth:</strong> <?php echo safe('dob'); ?></li>
        <li><strong>Gender:</strong> <?php echo safe('gender'); ?></li>
        <li><strong>Address:</strong> <?php echo safe('address'); ?></li>
        <li><strong>Suburb:</strong> <?php echo safe('suburb'); ?></li>
        <li><strong>State:</strong> <?php echo safe('state'); ?></li>
        <li><strong>Postcode:</strong> <?php echo safe('postcode'); ?></li>
        <li><strong>Email:</strong> <?php echo safe('email'); ?></li>
        <li><strong>Phone:</strong> <?php echo safe('phone'); ?></li>
        <li><strong>Skills:</strong> <?php echo showSkills(); ?></li>
        <li><strong>Other Skills:</strong> <?php echo safe('other_skills'); ?></li>
    </ul>

    <a href="apply.php">Back to Application Page</a>
    </body>
</html>