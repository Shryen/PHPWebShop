<?php
$loggedIn = isset($_SESSION['name']) ? true : false;
?>

<nav>
    <div>
        <a href="/">Home</a>
        <?php if ($loggedIn): ?>
            <a href="#"><?php echo $name; ?></a>
        <?php endif; ?>

    </div>
    <form id="search-holder" action="/" method="GET">
        <input type="text" name="search" id="search">
        <button id="searchbutton"><img src="../uploads/searchicon.png" alt="searchicon"></button>
    </form>
    <div>
        <?php if ($loggedIn): ?>
            <a href="/dashboard.php">Profile</a>
            <a href="/backend/logout.php">Logout</a>
        <?php endif; ?>
        <?php if (!$loggedIn): ?>
            <a href="/login.php">Login</a>
            <a href="/register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>