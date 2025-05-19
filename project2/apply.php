<?php session_start();?>

<?php include 'header.inc'; ?>
<title>Apply Now</title>
</head>
<body>
    <header>
    <h1>Apply Now</h1>
    <p>Apply Our Available Jobs!</p>
    </header>
<?php include 'nav.inc'; ?>
    <main class="form">
        
        <section>
           <?php
            if (isset($_SESSION['form_errors']) && !empty($_SESSION['form_errors'])) {
                echo "<div class='errors'>";
                echo "<h3>There were some problems with your submission:</h3>";
                echo "<ul>";
                foreach ($_SESSION['form_errors'] as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                echo "</ul>";
                echo "</div>";
                unset($_SESSION['form_errors']);
            }
            ?>
            <form action="process_eoi.php" method="post" novalidate="novalidate" enctype="multipart/form-data">
                <h2>Job Application Form</h2>
                <!-- Job Reference Number -->
                <label for="job-ref">Job Reference Number:</label>
                <select id="job-ref" name="job_ref" required>
                    <option value="">Please Select</option>
                    <option value="FSD01">FSD01 - Full Stack Developer</option>
                    <option value="DTA02">DTA02 - Data Analyst</option>
                </select><br><br>

                <!-- First Name -->
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" maxlength="20" pattern="^[A-Za-z]{1,20}$" required><br><br>

                <!-- Last Name -->
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" maxlength="20" pattern="^[A-Za-z]{1,20}$" required><br><br>

                <!-- Date of Birth -->
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required><br><br>

                <!-- Gender -->
                <fieldset class="gender">
                    <legend>Gender:</legend>
                    <input type="radio" id="male" name="gender" value="Male" required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="Female" required>
                    <label for="female">Female</label>
                    <input type="radio" id="otherg" name="gender" value="OtherG" required>
                    <label for="otherg">Other</label>
                </fieldset><br>

                <!-- Street Address -->
                <label for="address">Street Address:</label>
                <input type="text" id="address" name="address" maxlength="40" pattern="^{1,40}$" required><br><br>

                <!-- Suburb/Town -->
                <label for="suburb">Suburb/Town:</label>
                <input type="text" id="suburb" name="suburb" maxlength="40" pattern="^[A-Za-z]{1,40}$" required><br><br>

                <!-- State -->
                <label for="state">State:</label>
                <select id="state" name="state" required>
                    <option value="VIC">VIC</option>
                    <option value="NSW">NSW</option>
                    <option value="QLD">QLD</option>
                    <option value="NT">NT</option>
                    <option value="WA">WA</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="ACT">ACT</option>
                </select><br><br>

                <!-- Postcode -->
                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" pattern="^\d{4}$" required><br><br>

                <!-- Email -->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <!-- Phone Number -->
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" pattern="^[0-9 ]{8,12}$" required><br><br>

                <!-- Required Technical Skills -->
                <fieldset class="technical-skills">
                    <legend>Required Technical Skills:</legend>
                    <input type="checkbox" id="html" name="skills[]" value="HTML">
                    <label for="html">HTML </label>
                    <input type="checkbox" id="css" name="skills[]" value="CSS">
                    <label for="css">CSS </label>
                    <input type="checkbox" id="php" name="skills[]" value="PHP">
                    <label for="php">PHP </label>
                    <input type="checkbox" id="javascript" name="skills[]" value="JavaScript">
                    <label for="javascript">JavaScript </label>
                    <input type="checkbox" id="ruby" name="skills[]" value="Ruby">
                    <label for="ruby">Ruby </label>
                    <input type="checkbox" id="node" name="skills[]" value="Node.js">
                    <label for="node">Node.js </label>
                    <input type="checkbox" id="mysql" name="skills[]" value="MySQL">
                    <label for="mysql">MySQL </label>
                    <input type="checkbox" id="mongo" name="skills[]" value="MongoDB">
                    <label for="mongo">MongoDB </label>
                    <input type="checkbox" id="python" name="skills[]" value="Python">
                    <label for="python">Python </label>
                    <input type="checkbox" id="other" name="skills[]" value="OtherS">
                    <label for="other">Other </label>
                </fieldset><br><br>

                <!-- Other Skills -->
                <label for="other-skills">Other Skills:</label>
                <br>
                <textarea id="other-skills" name="other_skills" rows="4" cols="50" placeholder="Write any additional skills that you have on this box...."></textarea><br><br>
                <br>

                <!--Upload CV PDF File-->
                <label for="cv">Upload Your CV Below (PDF only)</label>
                <small>Uploading a resume is optional.</small>
                <br>
                <section class="file">
                <input type="file" id="cv" name="cv" accept=".pdf">
                </section>
                <br><br><br><br>
              
                <!-- Submit Button -->
                <input type="submit" value="Apply" class="submit-button">
            </form>
        </section>
    </main>
    <?php include 'footer.inc'; ?>
</body>
</html>