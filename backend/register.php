<?php

require_once 'database.php';
require_once 'Validation/FormValidation.php';
session_start();
$db = new Database();
$db->connect();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "../uploads/"; //file will be stored here
    $target_file = $target_dir . basename($_FILES["prof_pic"]["name"]); // file path
    $uploadOK = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // file type

    $name = htmlspecialchars($_POST["username"]);
    $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
    $passwordrepeat = htmlspecialchars($_POST['password_repeat']);
    $birthdate = htmlspecialchars($_POST["birthdate"]);

    $formData = [
        'username' => $name,
        'password' => htmlspecialchars($_POST['password']),
        'password_repeat' => $passwordrepeat,
        'birthdate' => $birthdate,
        'prof_pic' => $target_file,
    ];

    $validation = new Validation($formData);
    // Required
    $validation->validateRequired('username');
    $validation->validateRequired('password');
    $validation->validateRequired('birthdate');
    //Password Match and length
    $validation->validatePasswordMatches('password', 'password_repeat');
    $validation->validateStringLength('password', 8, 255);
    //Name validation (alphabetic ,length) 
    $validation->validateAlphabetic('username');
    if ($validation->hasErrors()) {
        $errors = $validation->getErrors();
        header("Location: /register.php?message=" . urlencode(json_encode($errors)) . "&error=true");
        exit();
    }

    if (!move_uploaded_file($_FILES["prof_pic"]["tmp_name"], $target_file)) {
        header("Location: /upload.php?message=Couldn't upload your file.&error=true");
        exit();
    }

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

