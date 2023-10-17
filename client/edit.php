<?php

include_once __DIR__ . '/../inc/_header.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product =   $productclass->getProductById($_GET['id']);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productclass->updateProduct($_POST, $_GET['id']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sửa sản phẩm</title>
</head>

<body>
    <h2>Sửa sản phẩm</h2>
    <?php
    if (isset($product)) {
        if ($product && $product->num_rows > 0) {
            $i = 0;
            while ($result = $product->fetch_assoc()) {
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" value="<?php echo $result['name'] ?>" required><br>

        <label for="image">Ảnh sản phẩm:</label>
        <input type="file" id="image" name="image">
        <img src="../public/<?php echo $result['image'] ?>" alt="" srcset="">
        <br>

        <label for="price">Giá sản phẩm:</label>
        <input type="number" id="price" name="price" value="<?php echo $result['price'] ?>" required><br>

        <label for="description">Mô tả sản phẩm:</label>
        <textarea id="description" name="description" required><?php echo $result['description'] ?></textarea><br>

        <input type="submit" value="Sửa sản phẩm">
    </form>
    <?php

            }
        } else {
            ?>
    <?php
        }
    } else {
        ?>
    <?php
    }
    ?>
</body>

</html>