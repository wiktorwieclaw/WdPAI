<header>
    <nav>
        <div class="hamburger-container">
            <div class="hamburger"></div>
        </div>
        <img id="logo" src="/public/img/logo.svg">
        <ul id="top-bar-list">
            <li><a href="/">Home</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact</a></li>
        </ul>
    </nav>
</header>
<div class="side-bar">
    <ul>
        <?php if(isset($_COOKIE['userSession'])): ?>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/addClub">Register a new club</a></li>
            <li><a href="/logout">Logout</a></li>
        <?php else: ?>
            <li><a href="/login">Log In</a></li>
            <li><a href="/signup">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</div>

