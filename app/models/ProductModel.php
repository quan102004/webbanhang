<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getProducts()
    {
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name
            FROM " . $this->table_name . " p
            LEFT JOIN category c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name
FROM " . $this->table_name . " p
LEFT JOIN category c ON p.category_id = c.id
WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }    public function addProduct($name, $description, $price, $category_id, $image = null)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }
        $query = "INSERT INTO " . $this->table_name . " (name, description, price,
category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        
        // Xử lý an toàn các giá trị
        $name = !is_null($name) ? htmlspecialchars(strip_tags($name)) : '';
        $description = !is_null($description) ? htmlspecialchars(strip_tags($description)) : '';
        $price = !is_null($price) ? htmlspecialchars(strip_tags($price)) : 0;
        $category_id = !is_null($category_id) ? htmlspecialchars(strip_tags($category_id)) : null;
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }    public function updateProduct(
        $id,
        $name,
        $description,
        $price,
        $category_id,
        $image
    ) {
        // Kiểm tra và xác thực dữ liệu trước khi cập nhật
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (empty($price) || !is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "UPDATE " . $this->table_name . " SET name=:name,
description=:description, price=:price, category_id=:category_id WHERE
id=:id";
        $stmt = $this->conn->prepare($query);
        
        // Xử lý an toàn các giá trị
        $name = !is_null($name) ? htmlspecialchars(strip_tags($name)) : '';
        $description = !is_null($description) ? htmlspecialchars(strip_tags($description)) : '';
        $price = !is_null($price) ? htmlspecialchars(strip_tags($price)) : 0;
        $category_id = !is_null($category_id) ? htmlspecialchars(strip_tags($category_id)) : null;
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}