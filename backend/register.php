<?php

require_once 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "../uploads/"; //file will be stored here
    $target_file = $target_dir . basename($_FILES["prof_pic"]["name"]);
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $errors = [];

    // Check if file is a valid image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["prof_pic"]["tmp_name"]);
        if ($check !== false) {
            $uploadOK = 1;
        } else {
            $errors[] = "File is not a valid image";
            $uploadOK = 0;
        }
    }

    // Check if update was succesful
    if ($uploadOK == 0) {
        $errors[] = "Couldn't upload file";
    }

    $registerOK = 1;
    // Validate form data
    if (empty($_POST["username"])) {
        $errors[] = "Username is required";
        $registerOK = 0;
    } elseif (strlen($_POST["username"]) < 5) {
        $errors[] = "Username must be at least 5 characters long";
        $registerOK = 0;
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])) {
        $errors[] = "Username can only contain alphanumeric characters";
        $registerOK = 0;
    }

    if (empty($_POST["password"] || empty($_POST["password_repeat"]))) {
        $errors[] = "Password and Confirm Password are required";
        $registerOK = 0;
    }
    if ($_POST['password'] != $_POST["password_repeat"]) {
        $errors[] = "Passwords do not match";
        $registerOK = 0;
    }
    if (empty($_POST["birthdate"])) {
        $errors[] = "Birthdate is required";
        $registerOK = 0;
    }

    $name = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $birthdate = $_POST["birthdate"];

    try {
        $stmt = $db->fetch("SELECT name FROM users WHERE name = ?", params: [$name]);
        $result = $stmt;
        if ($result) {
            $registerOK = 0;
            $errors[] = "Username already exists. Please choose a different one";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }

    if (!move_uploaded_file($_FILES["prof_pic"]["tmp_name"], $target_file)) {
        $errors[] = "Sorry, there was an error uploading your file.";
        $uploadOK = 0;
    }



    if ($registerOK == 0 || $uploadOK == 0) {
        header("Location: /register.php?message=" . urlencode(json_encode($errors)) . "&error=true");
        exit();
    } else {
        // Insert user data into the database
        try {
            $stmt = $db->execute("INSERT INTO users (name, password, birthdate) VALUES (?, ?, ?)", [$name, $password, $birthdate]);
            if ($stmt) {
                $_SESSION['name'] = $name;
                $_SESSION['birthdate'] = $birthdate;
                header("Location: /?message=Registered succesfully");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        header(header: "Location: /");
        exit();
    }
}
