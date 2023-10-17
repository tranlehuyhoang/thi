<?php

include_once __DIR__ . '/../inc/_header.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = $productclass->insertProduct($_POST);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm sản phẩm</title>
</head>

<body>
    <h2>Thêm sản phẩm</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="image">Ảnh sản phẩm:</label>
        <input type="file" id="image" name="image" required><br>

        <label for="price">Giá sản phẩm:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="description">Mô tả sản phẩm:</label>
        <textarea id="description" name="description" required></textarea><br>

        <input type="submit" value="Thêm sản phẩm">
    </form>
</body>

</html>