<?php include 'header.inc'; ?>
<title>About Nexus</title>
</head>
<body>
    <header>
        <h1>About Us</h1>
        <p>Learn About Our Team</p>
    </header>
<?php include 'nav.inc'; ?>
    <main>
        <section>
            <h2>Group Information</h2>
            <p>Welcome to our group page! Here's everything you need to know about us.</p>

            <!-- Group Name and Class Time -->
            <h3>Group Name and Class Time</h3>
            <ul>
                <li>Group Name: Nexus Innovators</li>
                <li>Class Time: Thursday, 14:30</li>
                <li>Location: ATC009</li>
            </ul>
           
           <section class="StudentID">
            <!-- Student IDs -->
            <h3>Student IDs</h3>
            <ol>
                <li>Duc Duy Dan: 105527106</li>
                <li>Sebastian Wang: 105525867</li>
                <li>Ethan Putra: 105931192</li>
                <li>Tessy Kurian: 105919606</li>
            </ol>
            <!-- Tutor's Name -->
            <h3>Tutor's Name</h3>
            <p>Enrique Ketterer Ortiz</p>
           </section>
            <!-- Members Contribution -->
             
            <h3>Members Contribution</h3>
            <ol>
                <li>Duc Duy Dan (Team Leader)
                    <ul>
                        <li>Shared Responsibility: index.php, login.php, signup.php, process_eoi.php, setting.php styles.css, header.inc, nav.inc, footer.inc, recheck the program, update database</li>
                        <li>Individual Responsibility: jobs.php, manage.php, group agreement form, responsible for product submission</li>
                    </ul>
                </li>   
                <li>Sebastian Wang
                    <ul>
                        <li>Shared Responsibility: index.html, styles.css (for apply.html), confirmation.php,</li>
                        <li>Individual Responsibility: process_eoi.php, added an error message when uploading a form on apply.php and create a eoi table</li>
                    </ul>
                </li>
                <li>Ethan Putra
                    <ul>
                        <li>Shared Responsibility: jobs.html (job name and job description)</li>
                        <li>Individual Responsibility: about.html, test the program as a user</li>
                    </ul>
                </li>    
                <li>Tessy Kurian
                    <ul>
                        <li>Shared Responsibility: index.html, about.php, job.php</li>
                        <li>Individual Responsibility: index.html, jobs.php</li>
                    </ul>
                </li>
            </ol>
      
            <!-- Group Photo -->
            <h3>Group Photo</h3>
                <figure>
                    <img src="images/IMG_8269.jpg" alt="Group Photo">
                    <figcaption>Meet the Nexus Innovators team!</figcaption>
                </figure>

            <!-- Members Interests -->
            <h3>Members Interests</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Interests</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="Danny">
                          <td><a href="manage.php" style="text-decoration:none; color:inherit;">Duc Duy Dan</a></td>
                        <td>Gaming, eating, cycling and sleep</td>
                    </tr>
                    <tr id="Sebastian">
                        <td>Sebastian Wang</td>
                        <td>Gaming, cooking, singing, sleep, eating, and swimming</td>
                    </tr>
                    <tr id="Ethan">
                        <td>Ethan Putra</td>
                        <td>Gaming, Cycling, Going to gym, and Sleep</td>
                    </tr>
                    <tr id="Tessy">
                        <td>Tessy Kurian</td>
                        <td>Reading, Cooking, and Traveling</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
    <?php include 'footer.inc'; ?>
</body>
</html>