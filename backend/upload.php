<?php
require_once 'database.php';
require_once 'Validation/FormValidation.php';

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $formData = [
        'name' => htmlspecialchars($_POST['name']),
        'price' => htmlspecialchars($_POST['price']),
        'quantity' => htmlspecialchars($_POST['quantity']),
        'description' => htmlspecialchars($_POST['description']),
        'category' => htmlspecialchars($_POST['category']),
    ];

    $targetDir = "uploads/"; // Directory to save uploaded images
    $targetFile = $targetDir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $db = new Database();
    $db->connect();
    $validator = new Validation($formData);
    $validator->validateRequired('name');
    $validator->validateRequired('price');
    $validator->validateRequired('description');
    $validator->validateImage('picture');
    $validator->validateNumeric('quantity');
    $validator->validateNumeric('price');
    $validator->validateStringLength('description', 10, 255);
    $validator->validateStringLength('name', 3, 50);
    if ($validator->hasErrors()) {
        $errors = $validator->getErrors();
        $errorMessage = http_build_query(['errors' => $errors]);
        header("Location: /upload.php?{$errorMessage}");
        exit();
    }
    // Upload item to server
    $stmt = $db->execute(
        "INSERT INTO products (name, price, description, picture, quantity, category) VALUES (?, ?, ?, ?, ?, ?)",
        [$formData['name'], $formData['price'], $formData['description'], $targetFile, $formData['quantity'], $formData['category']]
    );
    if ($stmt) {
        header("Location: /upload.php?message=Success");
        exit();
    } else {
        header("Location: /upload.php?message=Error");
        exit();
        ;
    }
}

