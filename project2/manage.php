<?php
session_start();
include 'settings.php';

// Only allow access if logged in and role is admin
if (
    !isset($_SESSION['manager_logged_in']) ||
    $_SESSION['manager_logged_in'] !== true ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    header('Location: login.php');
    exit();
}

// Handle delete by job reference
if (isset($_POST['delete_job_ref']) && !empty($_POST['delete_job_ref'])) {
    $job_ref = mysqli_real_escape_string($dbconn, $_POST['delete_job_ref']);
    mysqli_query($dbconn, "DELETE FROM eoi WHERE job_ref='$job_ref'");
    $message = "All EOIs with Job Reference '$job_ref' have been deleted.";
}

// Handle status update
if (isset($_POST['update_status_id'], $_POST['update_status'])) {
    $eoi_id = intval($_POST['update_status_id']);
    $new_status = mysqli_real_escape_string($dbconn, $_POST['update_status']);
    mysqli_query($dbconn, "UPDATE eoi SET status='$new_status' WHERE EOInumber=$eoi_id");
    $message = "EOI #$eoi_id status updated to '$new_status'.";
}

// Build query for listing EOIs
$where = [];
if (!empty($_GET['job_ref'])) {
    $job_ref = mysqli_real_escape_string($dbconn, $_GET['job_ref']);
    $where[] = "job_ref='$job_ref'";
}
if (!empty($_GET['first_name'])) {
    $first_name = mysqli_real_escape_string($dbconn, $_GET['first_name']);
    $where[] = "first_name LIKE '%$first_name%'";
}
if (!empty($_GET['last_name'])) {
    $last_name = mysqli_real_escape_string($dbconn, $_GET['last_name']);
    $where[] = "last_name LIKE '%$last_name%'";
}

// Sorting enhancement
$sort_fields = ['EOInumber', 'job_ref', 'first_name', 'last_name', 'status'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sort_fields) ? $_GET['sort'] : 'EOInumber';

$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";
$result = mysqli_query($dbconn, "SELECT * FROM eoi $where_sql ORDER BY $sort DESC");
?>
<?php include 'header.inc'; ?>
<title>Manage EOIs</title>
</head>
<body>
    <header>
        <h1>Manage Expressions of Interest</h1>
    </header>
<?php include 'nav.inc'; ?>
    <main>
    <?php if (!empty($message)) echo "<p style='color:green;'>$message</p>"; ?>
<section>
    <form method="get" style="margin-bottom:1em;">
    <label>Job Reference: <input type="text" name="job_ref" value="<?php echo htmlspecialchars($_GET['job_ref'] ?? ''); ?>"></label>
    <label>First Name: <input type="text" name="first_name" value="<?php echo htmlspecialchars($_GET['first_name'] ?? ''); ?>"></label>
    <label>Last Name: <input type="text" name="last_name" value="<?php echo htmlspecialchars($_GET['last_name'] ?? ''); ?>"></label>
    <label>Sort by:
        <select name="sort">
            <?php
            foreach ($sort_fields as $field) {
                $selected = (isset($_GET['sort']) && $_GET['sort'] == $field) ? 'selected' : '';
                echo "<option value=\"$field\" $selected>$field</option>";
            }
            ?>
        </select>
    </label>
    <button type="submit">Search</button>
    <a href="manage.php">Reset</a>
    </form>

    <form method="post" style="margin-bottom:1em;">
        <label>Delete all EOIs with Job Reference: <input type="text" name="delete_job_ref" required></label>
        <button type="submit" onclick="return confirm('Are you sure you want to delete all EOIs for this job reference?');">Delete</button>
    </form>

    <table>
    <tr>
        <th>EOI #</th>
        <th>Job Ref</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>DOB</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Suburb</th>
        <th>State</th>
        <th>Postcode</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Skills</th>
        <th>Other Skills</th>
        <th>CV File</th>
        <th>Status</th>
        <th>Change Status</th>
    </tr>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Gather all skills into a single string
            $skills = [];
            for ($i = 1; $i <= 10; $i++) {
                if (!empty($row["skill$i"])) $skills[] = htmlspecialchars($row["skill$i"]);
            }
            $skills_str = implode(', ', $skills);

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['EOInumber']) . "</td>";
            echo "<td>" . htmlspecialchars($row['job_ref']) . "</td>";
            echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['dob']) . "</td>";
            echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['suburb']) . "</td>";
            echo "<td>" . htmlspecialchars($row['state']) . "</td>";
            echo "<td>" . htmlspecialchars($row['postcode']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
            echo "<td>" . $skills_str . "</td>";
            echo "<td>" . htmlspecialchars($row['other_skills']) . "</td>";
            // CV file link
            if (!empty($row['cv_filename'])) {
                $cv_url = "uploads/" . urlencode($row['cv_filename']);
                echo "<td><a href='$cv_url' target='_blank'>View</a></td>";
            } else {
                echo "<td>None</td>";
            }
            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
            echo "<td>
                <form method='post' style='display:inline;'>
                    <input type='hidden' name='update_status_id' value='" . intval($row['EOInumber']) . "'>
                    <select name='update_status'>
                        <option value='New'" . ($row['status']=='New'?' selected':'') . ">New</option>
                        <option value='Current'" . ($row['status']=='Current'?' selected':'') . ">Current</option>
                        <option value='Final'" . ($row['status']=='Final'?' selected':'') . ">Final</option>
                    </select>
                    <button type='submit'>Update</button>
                </form>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='17'>No EOIs found.</td></tr>";
    }
    ?>
    </table>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>