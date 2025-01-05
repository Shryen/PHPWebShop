<?php
require_once 'database.php';
session_start();
$db = new Database();
$db->connect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['username']);
    $password = $_POST["password"];

    $result = $db->fetch("SELECT * FROM users;");
    if ($result) {
        foreach ($result as $row) {
            if ($row['name'] == $name) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['name'] = $name;
                    header('Location: ../?message=Logged in succesfully!');
                    exit();
                }
            }
        }
    } else {
        header("Location: /login.php?message='User not found'");
        exit();
    }
}
