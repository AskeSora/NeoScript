<?php
require '../classes/Connection.php';
require '../classes/Products.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
}
$products = new Products($connection);


$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
$imgId = isset($_POST['imgId']) ? htmlspecialchars($_POST['imgId']) : '';
$inStock = isset($_POST['inStock']) ? true : false;
$language = isset($_POST['language']) ? htmlspecialchars($_POST['language']) : '';
$religion = isset($_POST['religion']) ? htmlspecialchars($_POST['religion']) : '';
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0.0;
$sale = isset($_POST['onSale']) ? true : false;

$productData = [
    'name' => $name,
    'description' => $description,
    'imgId' => $imgId,
    'inStock' => $inStock,
    'language' => $language,
    'religion' => $religion, 
    'price' => $price,
    'sale' => $sale
];

if ($products->addProduct($productData)) {
    echo "Product added successfully!";
    header("Location: ../index.php?page=manageProducts");
} else {
    echo "Error adding the product. Please try again.";
}
