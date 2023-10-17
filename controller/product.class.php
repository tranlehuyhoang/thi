<?php
include_once __DIR__ . '/../model/database.php';

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertProduct($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);

        // Handle file upload
        if ($_FILES['image']['error'] === 0) {
            $uploadDir = __DIR__ . '/../public/';
            $fileName = $_FILES['image']['name'];
            $tempFile = $_FILES['image']['tmp_name'];
            $targetFile = $uploadDir . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tempFile, $targetFile)) {
                // File uploaded successfully, save the image path in the database
                $imagePath =  $fileName; // Relative path to the image file

                // Insert the product into the database
                $query = "INSERT INTO products (name, image, price, description) VALUES ('$name', '$imagePath', '$price', '$description')";
                $this->db->insert($query);

                echo "<script>window.location.href = './product.php';</script>";
            } else {
                // Failed to move the uploaded file
                echo "Failed to upload file.";
            }
        }
    }

    public function updateProduct($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if ($_FILES['image']['error'] === 0) {
            $uploadDir = __DIR__ . '/../public/';
            $fileName = $_FILES['image']['name'];
            $tempFile = $_FILES['image']['tmp_name'];
            $targetFile = $uploadDir . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($tempFile, $targetFile)) {
                // File uploaded successfully, save the image path in the database
                $imagePath =  $fileName; // Relative path to the image file

                // Update the product in the database
                $query = "UPDATE products SET name = '$name', image = '$imagePath', price = '$price', description = '$description' WHERE id = '$id'";
                echo "<script>window.location.href = './product.php';</script>";

                $this->db->update($query);
            }
        } else {
            // No image uploaded, only update the other fields
            $query = "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = '$id'";
            echo "<script>window.location.href = './product.php';</script>";
            $this->db->update($query);
        }

        // echo "<script>window.location.href = './product.php';</script>";
    }

    public function deleteProduct($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM products WHERE id = '$id'";
        $this->db->delete($query);
    }

    public function getProductById($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM products WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function showProducts()
    {
        $query = "SELECT * FROM products order by id desc ";
        $result = $this->db->select($query);
        return $result;
    }
}