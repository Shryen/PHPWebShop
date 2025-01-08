<?php
session_start();
if (isset($_SESSION['name'])) {
    header("Location: /dashboard.php");
    exit();
}
require_once 'components/header.php';
?>

<body>
    <form action="backend/login.php" method="post" enctype="multipart/form-data" class="auth-form">
        <h1 id="form-header">Login</h1>
        <label for="name">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login" name="submit">
    </form>
    <?php require_once 'components/popup.php'; ?>

</body>

</html>