<?php
session_start();

if (isset($_SESSION['name'])) {
    session_destroy();
    header('Location: ../?message=Logged out successfully!');
    exit();
} else {
    header('Location: ../?message=No session found');
    exit();
}
