<nav>
    <ol class="menu-open">
        <li id="menu" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="-200 -1060 960 960" width="30px" fill="#e3e3e3"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
    </ol>
    <ul class="nav-link">
        <li><a href="index.php" id="nav-link"><strong>Home</strong></a></li>                
        <li><a href="jobs.php" id="nav-link"><strong>Jobs</strong></a></li>
        <li><a href="apply.php" id="nav-link"><strong>Apply</strong></a></li>
        <li><a href="about.php" id="nav-link"><strong>About</strong></a></li>
        <li><a href="login.php" id="nav-link"><strong>Login</strong></a></li>
    </ul>
    <ul class="sidebar">
        <li id="close" onclick=closeSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
        <li><a href="index.php" id="nav-link"><strong>Home</strong></a></li>                
        <li><a href="jobs.php" id="nav-link"><strong>Jobs</strong></a></li>
        <li><a href="apply.php" id="nav-link"><strong>Apply</strong></a></li>
        <li><a href="about.php" id="nav-link"><strong>About</strong></a></li>
        <li><a href="login.php" id="nav-link"><strong>Login</strong></a></li>
    </ul>
</nav>
<script>
    function showSidebar(){
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display = 'flex'
    }
    function closeSidebar(){
        const sidebar = document.querySelector('.sidebar')
        sidebar.style.display = 'none'
        hjgfd
    }
</script>