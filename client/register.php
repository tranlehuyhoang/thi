<?php

include_once __DIR__ . '/../inc/_header.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userclass->insertUser($_POST);
}
if (isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = './product.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h2>Đăng kí</h2>
    <form action="" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="name" required><br>

        <label for="password">Email :</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Đăng kí">
    </form>


</body>

</html>