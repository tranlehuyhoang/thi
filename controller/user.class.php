<?php

include_once __DIR__ . '/../model/database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertUser($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $checkQuery = "SELECT * FROM users WHERE email = '$email'";
        $checkResult = $this->db->select($checkQuery);

        if ($checkResult) {
            $alert = "400";
            return $alert;
        }

        // Tiếp tục thêm mới người dùng
        $query = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$password')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = "200";
            echo "<script>window.location.href = './product.php';</script>";
            return $alert;
        } else {
            $alert = "404";
            return $alert;
        }
    }

    public function login($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $query = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
        $result = $this->db->select($query);

        if ($result) {
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['user_id'] = $row['id'];
                    $alert = "200";
                    return $alert;
                }
            }
            $alert = "200";
            return $alert;
        } else {
            $alert = "400";
            return $alert;
        }
    }
    public function getUser($id)
    {

        $query = "SELECT * FROM users WHERE id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
    }
    public function updateUser($id, $data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa (loại trừ email của người dùng hiện tại)
        $checkQuery = "SELECT * FROM users WHERE email = '$email' AND id != '$id'";
        $checkResult = $this->db->select($checkQuery);

        if ($checkResult) {
            $alert = "400";
            return $alert;
        }

        // Tiếp tục cập nhật thông tin người dùng
        $query = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = "200";
            echo "<script>window.location.href = './product.php';</script>";

            return $alert;
        } else {
            $alert = "404";
            return $alert;
        }
    }
}
