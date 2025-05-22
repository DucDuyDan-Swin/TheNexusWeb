<?php
include 'header.inc';
include 'settings.php';
?>
<title>Job Opportunities</title>
</head>
<body>
    <header>
        <h1>Available Jobs</h1>
        <p>See Our Positions!</p>
    </header>
<?php include 'nav.inc'; ?>
    <main>
        <aside class="job-tips">
            <h2>Application Tips</h2>
            <ul>
                <li>Tailor your resume to highlight relevant skills and experiences.</li>
                <li>Prepare for interviews by researching Nexus and its projects.</li>
                <li>Include a cover letter explaining why you're a great fit for the role.</li>
                <li>Showcase your problem-solving skills with examples from past projects.</li>
            </ul>
        </aside>
        <section>
            <?php
            $result = mysqli_query($dbconn, "SELECT * FROM jobs");
            while ($job = mysqli_fetch_assoc($result)) {
                echo "<div class='position'>";
                echo "<h2>Position: " . htmlspecialchars($job['title']) . "</h2>";
                echo "<p><strong>Reference Number:</strong> " . htmlspecialchars($job['reference']) . "</p>";
                echo "<p><strong>Salary Range:</strong> " . htmlspecialchars($job['salary']) . "</p>";
                echo "<p><strong>Reports To:</strong> " . htmlspecialchars($job['reports_to']) . "</p>";
                echo "<h3>Key Responsibilities:</h3>" . $job['key_responsibilities'];
                echo "<h3>Required Qualifications:</h3>" . $job['required_qualifications'];
                echo "<h4>Essential:</h4>" . $job['essential'];
                echo "<h4>Preferable:</h4>" . $job['preferable'];
                echo "<div class='why-join'><h2>Why Join Nexus?</h2>" . $job['why_join'] . "</div>";
                echo "<hr></div>";
            }
            ?>
            <div class="apply-now-container">
                <a href="apply.php" class="apply-now-button"><strong>Apply Now</strong></a>
            </div>
        </section>
    </main>
    <?php include 'footer.inc'; ?>
</body>
</html>