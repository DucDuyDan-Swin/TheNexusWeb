<?php include 'header.inc'; ?>
<title>Enhancements</title>
</head>
<body>
    <header>
        <h1>Project Enhancements</h1>
        <p>Enhancements Implemented</p>
    </header>
<?php include 'nav.inc'; ?>
    <main>
    <section>
        <h2>1. Manager Sortable EOI Table</h2>
        <p>
            The <strong>manage.php</strong> page allows the manager to select the field (e.g., EOI number, job reference, first name, last name, or status) by which to sort the EOI records. This is implemented using a dropdown menu in the search form above the EOI table. When a field is selected and the form is submitted, the table is reloaded and sorted by the chosen field using a dynamic SQL ORDER BY
            clause.
        </p>
        <h2>2. Manager Registration with Validation</h2>
        <p>
            A <strong>manager registration page</strong> (signup.php) is provided. It includes server-side validation to ensure that usernames are unique and that passwords meet a minimum length (8 characters) and complexity requirement (must include an uppercase letter, a lowercase letter, and a number). The registration form checks for existing usernames in the <strong>managers</strong> table before allowing registration. All new managers are assigned the <strong>user</strong> role by default.
        </p>
        <h2>3. Controlled Access to manage.php</h2>
        <p>
            Access to <strong>manage.php</strong> is strictly controlled. Only users who log in with a valid username and password and have the <strong>admin</strong> role in the <strong>managers</strong> table can access this page. All other users are redirected to the login page. This is enforced using PHP session variables.
        </p>
        <h2>4. Login Attempt Lockout</h2>
        <p>
            The login system tracks invalid login attempts. If a user enters an incorrect username or password three times or more, their access to the login page is disabled for a period of time (5 minutes). This is implemented using PHP sessions to count attempts and store the lockout timestamp, providing enhanced security against brute-force attacks.
        </p>
        <h2>5. Session Handling on Login</h2>
        <p>
            When the login page is accessed, any existing session is destroyed and a new session is started. This ensures that previous login states are cleared, preventing unauthorized access and session fixation attacks.
        </p>
        <h2>6. Dynamic Job Listings</h2>
        <p>
            The <strong>jobs.php</strong> page dynamically displays job descriptions by retrieving them from the <strong>jobs</strong> table in the database. This allows for easy management and updating of job postings without modifying the HTML code.
        </p>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>