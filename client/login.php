<?php

include_once __DIR__ . '/../inc/_header.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userclass->login($_POST);
}
if (isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = './product.php';</script>";
}
?>

<!DOCTYPE html>
<html>



<body>

    <h2>Đăng nhập</h2>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="name" required><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Đăng nhập">
    </form>
</body>

</html>