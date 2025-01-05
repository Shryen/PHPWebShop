<?php
require_once 'backend/database.php';
class Counter
{
    public $counter = 0;
    function destroy_message($count)
    {
        if (isset($_GET['message'])) {
            $count++;
        }
        if ($count == 2) {
            unset($_GET['message']);
            $count = 0;
        }
    }
}
$count = 0;
$counter = new Counter();
$counter->destroy_message($count);

$db = new Database();
$db->connect();

$loggedIn = isset($_SESSION['name']);
$name = $loggedIn ? $_SESSION['name'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="../CSS/nav.css">
    <link rel="stylesheet" href="../CSS/content.css">
    <link rel="stylesheet" href="../CSS/popup.css">
    <link rel="stylesheet" href="../CSS/items.css">
    <link rel="stylesheet" href="../CSS/product.css">
    <script src="popup.js" defer></script>
    <title>Dashboard</title>
</head>