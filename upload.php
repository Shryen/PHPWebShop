<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('Location: /');
    exit();
}
$name = $_SESSION['name'];
require_once 'components/header.php';
?>

<body>
    <?php
    require_once 'components/nav.php';
    ?>
    <div class="content">
        <h1>Dashboard</h1>
        <form action="backend/upload.php" method="POST" enctype="multipart/form-data" id="upload-form">
            <label for="name">Item Name</label>
            <input type="text" name="name" id="name">
            <label for="price">Item Price</label>
            <input type="number" name="price" id="price">
            <label for="price">Item Quantity</label>
            <input type="number" name="quantity" id="quantity">
            <label for="description">Item Description</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <label for="category">Item Category</label>
            <select name="category" id="category">
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="household">Household</option>
                <option value="books">Books</option>
                <option value="other">Other</option>
            </select>
            <label for="picture">Item picture</label>
            <input type="file" name="picture" id="picture">
            <input type="submit" value="Upload" name="submit" id="submit">
        </form>
    </div>
    <?php
    require_once 'components/popup.php';
    ?>
</body>

</html>