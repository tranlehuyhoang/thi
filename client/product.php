<?php

include_once __DIR__ . '/../inc/_header.inc.php';
$product = $productclass->showProducts();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productclass->deleteProduct($_GET['id']);
    $product = $productclass->showProducts();
}
if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = './login.php';</script>";
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $userclass->logout();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quản lý sản phẩm</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .edit-btn,
    .delete-btn {
        padding: 5px 10px;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border-radius: 4px;
    }

    .delete-btn {
        background-color: #f44336;
    }
    </style>
</head>

<body>
    <h2>Quản lý sản phẩm</h2>

    <a href="./product.php?action=logout">Logout</a>
    <table>
        <tr>
            <th>Tên</th>
            <th>Ảnh</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th></th>
        </tr>
        <?php
        if (isset($product)) {
            if ($product && $product->num_rows > 0) {
                $i = 0;
                while ($result = $product->fetch_assoc()) {

        ?>
        <tr>
            <td><?php echo $result['name'] ?></td>
            <td><img src="../public/<?php echo $result['image'] ?>" alt="Product 1" width="100"></td>
            <td>$<?php echo $result['price'] ?></td>
            <td><?php echo $result['description'] ?></td>
            <td>
                <a href="./edit.php?id=<?php echo $result['id'] ?>" class="edit-btn">Sửa</a>
                <a href="./product.php?id=<?php echo $result['id'] ?>" class="delete-btn">Xóa</a>
            </td>
        </tr>
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
        <!-- Thêm các dòng khác tương tự -->
    </table>
</body>

</html>