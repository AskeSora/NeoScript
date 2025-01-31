<?php

require '../classes/Connection.php';
require '../classes/Products.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
}
$products = new Products($connection);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    
    $imgId = isset($_POST['imgId']) && !empty($_POST['imgId']) ? $_POST['imgId'] : null;
    
    if ($imgId === null) {
        $product = $products->getProductById($id);
        $imgId = $product['imgId'];
    }
    
    
    $inStock = isset($_POST['inStock']) ? true : false;  // Checkbox value
    $language = $_POST['language'];
    $religion = $_POST['religion'];
    $price = $_POST['price'];
    $onSale = isset($_POST['onSale']) ? true : false;  // Checkbox value
    
    if (empty($name) || empty($description) || empty($price)) {
        die("All fields are required.");
    }
    $updated = $products->updateProduct($id, $name, $description, $imgId, $inStock, $language, $religion, $price, $onSale);
    if ($updated) {
        echo "Product updated successfully!";
        header("Location: ../index.php?page=manageProducts");
        exit();
    } else {
        die("Failed to update the product.");
    }
} else {
    die("Invalid request method.");
}
