<?php
require_once 'database.php';
require_once 'Validation/FormValidation.php';
session_start();
$db = new Database();
$db->connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST["password"]);
    $formData = [
        'name' => $name,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ];
    $validator = new Validation($formData);
    $validator->validateRequired('name');
    $validator->validateRequired('password');
    $result = $db->fetch("SELECT * FROM users;");
    if ($validator->hasErrors()) {
        $errors = $validator->getErrors();
        $errorMessage = urlencode(json_encode($errors));
        header("Location: /login.php?message={$errorMessage}");
        exit();
    }
    if ($result) {
        foreach ($result as $row) {
            if ($row['name'] == $name) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['name'] = $name;
                    header('Location: ../?message=Logged in succesfully!');
                    exit();
                } else {
                    header("Location: /login.php?message=Incorrect credentials&error=true");
                    exit();
                }
            }
        }
    } else {
        header("Location: /login.php?message='User not found'");
        exit();
    }
}
