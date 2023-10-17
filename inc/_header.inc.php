<?php
session_start();
include_once __DIR__ .  '/../controller/product.class.php';
include_once __DIR__ .  '/../controller/user.class.php';
$userclass = new user();
$productclass = new product();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $userclass->logout();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi dự án mẫu</title>

</head>