<?php
require_once 'components/header.php';
if (isset($_SESSION['name'])) {
    header("Location: dashboard.php");
    exit();
}
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
    <form action="backend/register.php" method="post" enctype="multipart/form-data" class="auth-form">
        <h1 id="form-header">Registration</h1>
        <label for="name">Username</label>
        <input type="text" name="username">
        <label for="password">Password</label>
        <input type="password" name="password">
        <label for="password_repeat">Confirm Password</label>
        <input type="password" name="password_repeat">
        <label for="age">When is your birthday?</label>
        <input type="date" name="birthdate">
        <label for="prof_pic" class="custom-file-upload">Profile Picture</label>
        <input type="file" name="prof_pic" id="prof_pic">
        <input type="submit" value="Register" name="submit">
    </form>
    <?php
    require_once 'components/popup.php';
    ?>
</body>

</html>