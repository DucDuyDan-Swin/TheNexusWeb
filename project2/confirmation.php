<?php
session_start();

if (!isset($_SESSION['success_message']) || !isset($_SESSION['form_data'])) {
    header("Location: apply.php");
    exit();
}

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application Confirmation</title>
</head>
<body>
    <h1>Application Submitted</h1>
    <p><?php echo $success_message; ?></p>

    <h2>Your Submitted Details</h2>
    <ul>
        <li><strong>Job Reference:</strong> <?php echo htmlspecialchars($form_data['job_ref']); ?></li>
        <li><strong>First Name:</strong> <?php echo htmlspecialchars($form_data['first_name']); ?></li>
        <li><strong>Last Name:</strong> <?php echo htmlspecialchars($form_data['last_name']); ?></li>
        <li><strong>Date of Birth:</strong> <?php echo htmlspecialchars($form_data['dob']); ?></li>
        <li><strong>Gender:</strong> <?php echo htmlspecialchars($form_data['gender']); ?></li>
        <li><strong>Address:</strong> <?php echo htmlspecialchars($form_data['address']); ?></li>
        <li><strong>Suburb:</strong> <?php echo htmlspecialchars($form_data['suburb']); ?></li>
        <li><strong>State:</strong> <?php echo htmlspecialchars($form_data['state']); ?></li>
        <li><strong>Postcode:</strong> <?php echo htmlspecialchars($form_data['postcode']); ?></li>
        <li><strong>Email:</strong> <?php echo htmlspecialchars($form_data['email']); ?></li>
        <li><strong>Phone:</strong> <?php echo htmlspecialchars($form_data['phone']); ?></li>
        <li><strong>Skills:</strong>
            <ul>
                <?php 
                if (!empty($form_data['skills'])) {
                    foreach ($form_data['skills'] as $skill) {
                        echo "<li>" . htmlspecialchars($skill) . "</li>";
                    }
                } else {
                    echo "<li>None</li>";
                }
                ?>
            </ul>
        </li>
        <?php if (!empty($form_data['other_skills'])): ?>
            <li><strong>Other Skills:</strong> <?php echo htmlspecialchars($form_data['other_skills']); ?></li>
        <?php endif; ?>
    </ul>
</body>
</html>
