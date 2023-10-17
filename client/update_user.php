<?php
include_once __DIR__ . '/../inc/_header.inc.php';

// Lấy thông tin người dùng từ cơ sở dữ liệu
$user = $userclass->getUser($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $userclass->updateUser($_SESSION['user_id'], $_POST);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cập nhật thông tin người dùng</title>
</head>

<body>
    <h2>Cập nhật thông tin người dùng</h2>
    <?php
    if (isset($user)) {
        if ($user && $user->num_rows > 0) {
            $i = 0;
            while ($result = $user->fetch_assoc()) {
    ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="name">Tên người dùng:</label>
                    <input type="text" id="name" name="name" value="<?php echo $result['name']; ?>" required><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $result['email']; ?>" required><br>

                    <label for="email">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo $result['password']; ?>" required><br>


                    <input type="submit" value="Cập nhật">
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