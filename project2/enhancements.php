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
            The <strong>manage.php</strong> page allows the manager to select the field (e.g., EOI number, job reference, first name, status) by which to sort the EOI records. This is implemented using a dropdown menu above the EOI table. When a field is selected, the table is reloaded and sorted by the chosen field using a dynamic SQL <code>ORDER BY</code> clause.
        </p>
    </section>
    <section>
        <h2>2. Manager Registration with Validation</h2>
        <p>
            A <strong>manager registration page</strong> (<code>signup.php</code>) is provided. It includes server-side validation to ensure that usernames are unique and that passwords meet a minimum length and complexity requirement. The registration form checks for existing usernames in the <code>managers</code> table before allowing registration.
        </p>
    </section>
    <section>
        <h2>3. Controlled Access to manage.php</h2>
        <p>
            Access to <strong>manage.php</strong> is strictly controlled. Only users who log in with a valid username and password and have the <code>admin</code> role in the <code>managers</code> table can access this page. All other users are redirected to the login page.
        </p>
    </section>
    <section>
        <h2>4. Login Attempt Lockout</h2>
        <p>
            The login system tracks invalid login attempts. If a user enters an incorrect username or password three times or more, their access to the login page is disabled for a period of time (e.g., 5 minutes). This is implemented using PHP sessions to count attempts and store the lockout timestamp.
        </p>
    </section>
</main>
<?php include 'footer.inc'; ?>
</body>
</html>