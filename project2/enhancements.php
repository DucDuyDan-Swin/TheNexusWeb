<title>Project Enhancements</title>
<?php include 'header.inc'; ?>
<?php include 'nav.inc'; ?>
    <main>
        <h1>Project Enhancements</h1>

        <section class="enhancement">
            <h2>1. Advanced Search Functionality</h2>
            <p><strong>Description:</strong> Implemented advanced search features in manage.php</p>
            <ul>
                <li>Multiple search criteria combinations</li>
                <li>Dynamic SQL query building</li>
                <li>Sort by any column</li>
                <li>Pagination of results</li>
            </ul>
            <p><strong>Location:</strong> manage.php</p>
            <p><strong>Technical Details:</strong> Used PDO prepared statements, dynamic WHERE clause construction, and session-based result storage.</p>
        </section>
        <section>
            <h2>2. Login Security System</h2>
            <p><strong>Description:</strong> We added security features to the manager login page.</p>
            <ul>
                <li>Passwords are hashed using <code>password_hash()</code> so they are stored securely.</li>
                <li>Passwords must be at least 8 characters long and include:
            <ul>
                <li>One capital letter</li>
                <li>One number</li>
                <li>One special character (like !, @, or #)</li>
            </ul>
        </li>
        <li>If someone tries to log in 3 times with the wrong password, they will be locked out for 5 minutes.</li>
        <li>Login attempts are tracked using PHP sessions.</li>
    </ul>
    <p><strong>Where it's used:</strong> In <code>login_process.php</code></p>
    <p><strong>How it works:</strong> PHP checks the password format using <code>preg_match()</code>, tracks login attempts with <code>$_SESSION</code>, and uses <code>time()</code> to create a lockout period.</p>
</section>

                <li>Brute force protection with login attempts tracking</li>
                <li>Session timeout management</li>
                <li>CSRF token protection</li>
            </ul>
            <p><strong>Location:</strong> login.php, manage.php</p>
            <p><strong>Technical Details:</strong> Implemented using PHP's password_hash(), session management, and database tracking of login attempts.</p>
        </section>

        <section class="enhancement">
            <h2>3. Dynamic Job Listing System</h2>
            <p><strong>Description:</strong> Created a dynamic job management system</p>
            <ul>
                <li>Admin interface for job CRUD operations</li>
                <li>Real-time job status updates</li>
                <li>Automatic job expiry handling</li>
                <li>Job category filtering</li>
            </ul>
            
            <?
            Echo "<p><strong>Location:</strong> jobs.php, admin/jobs_manage.php</p>";
            $allowed_fields = ['firstname', 'lastname', 'job_reference', 'application_date'];
            $sort_field = in_array($_GET['sort'] ?? '', $allowed_fields) ? $_GET['sort'] : 'application_date';
             $query = "SELECT * FROM eoi ORDER BY $sort_field";
            ?>
            <p><strong>Technical Details:</strong> Uses AJAX for real-time updates, MySQL events for job expiry, and JavaScript for dynamic filtering.</p>
        </section>

        <section class="enhancement">
            <h2>4. Advanced Form Validation</h2>
            <p><strong>Description:</strong> Enhanced form validation system</p>
            <ul>
                <li>Real-time client-side validation</li>
                <li>Complex pattern matching for inputs</li>
                <li>Custom validation rules</li>
                <li>Error highlighting and feedback</li>
            </ul>
            <p><strong>Location:</strong> apply.php, js/validation.js</p>
            <p><strong>Technical Details:</strong> Combines JavaScript for instant feedback with PHP server-side validation for security.</p>
        </section>
    </main>

    <?php include 'footer.inc'; ?>
</body>
</html>