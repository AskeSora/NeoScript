<?php

class Products {
    public $connection;
    public $id;
    public $language;
    public $religion;
    public bool $inStock; 
    
    public function __construct($connection) {
        $this->connection = $connection;
        //echo "database connection assigned.<br>";
    }
    public function getAllProducts() {
        $sql = "SELECT * FROM products ORDER BY name";
        $result = $this->connection->query($sql);
        
        if (!$result) {
            // Handle query error
            throw new Exception("Database query failed: " . $this->connection->error);
        }
        
        $allproducts = [];
        
        while ($row = $result->fetch_assoc()) {
            $allproducts[$row['id']] = $row;
        }
        return $allproducts;
    }
    
    public function getProductsByReligion($religion) {
        $sql = "SELECT * FROM products WHERE religion = ? ORDER BY name";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $religion);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $products = [];
    
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    
        return $products;
    }
    public function getProductsByLanguage($language) {
        $sql = "SELECT * FROM products WHERE language = Japanese";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("s", $language);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $products = [];
        
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    public function searchProducts($search) {
        $sql = "SELECT * FROM products WHERE language LIKE '%".$search."%' ORDER BY name";
        $result = $this->connection->query($sql);
        if (!$result) {
            throw new Exception("Database query failed: " . $this->connection->error);
        }
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
    
    public function getReligions() {
        if ($this->connection === null) {
            throw new Exception("Database connection is not set.");
        }

        $query = "SELECT DISTINCT religion FROM products ORDER BY religion";
        return $this->connection->query($query);
    }
    
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id= ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
    public function removeProductFromCart($user_id, $product_id) {
        $sql = "SELECT cart FROM users Where id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user === null) {
            return false;
        }
        
        $cart = $user['cart'] ?? '';
        $cartArray = explode(',', $cart);
        
        if (($key = array_search($product_id, $cartArray)) !== false) {
            unset($cartArray[$key]);
        }
        
        $updatedCart = implode(',', $cartArray);
        $updateSql = "UPDATE users SET cart = ? WHERE id = ?";
        $updateStmt = $this->connection->prepare($updateSql);
        $updateStmt->bind_param("si", $updatedCart, $user_id);
        return $updateStmt->execute();
    }
    
    public function addProduct($product) {
        $query = "INSERT INTO products (name, description, imgId, inStock, language, religion, price, sale) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        
        if ($stmt === false) {
            die("Error preparing the statement: " . $this->connection->error);
        }
        $stmt->bind_param(
                'sssbssdb', 
                $product['name'],
                $product['description'],
                $product['imgId'],
                $product['inStock'], // Boolean value (0 or 1)
                $product['language'],
                $product['religion'],
                $product['price'],
                $product['sale']
            );
        
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error executing the statement: " . $stmt->error;
            return false;
        }
    }
    
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        
        if ($stmt->execute([$id])) {
            echo "Recipe with ID $id deleted successfully.";
            return true;
        } else {
            echo "Failed to delete product with ID $id.";
            return false;
        }
        //return $stmt->execute(['id']);
    }
    
    public function updateProduct($id, $name, $description, $imgId, $inStock, $language, $religion, $price, $onSale) {
        $query = "UPDATE products SET name = ?, description = ?, imgId = ?, inStock = ?, language = ?, religion = ?, price = ?, sale = ? WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            die('MySQL error: ' . $this->connection->error);
        }
        $stmt->bind_param('sssbssdbi', $name, $description, $imgId, $inStock, $language, $religion, $price, $onSale, $id);
        
        if ($stmt->execute()) {
            return true; 
        } else {
            return false;
        }
    }
}
