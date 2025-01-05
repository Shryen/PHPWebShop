<?php
session_start();
if (isset($_SESSION['name'])) {
    header("Location: /dashboard.php");
    exit();
}
require_once 'components/header.php';
?>

<body>
    <?php
    if (isset($_GET["error"])) {
        $errors = json_decode(urldecode($_GET["error"]), true);
        if (is_array($errors)) {
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
        }
    }
    ?>
    <form action="backend/login.php" method="post" enctype="multipart/form-data" class="auth-form">
        <h1 id="form-header">Login</h1>
        <label for="name">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login" name="submit">
    </form>

</body>

</html>