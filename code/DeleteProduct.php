<?php

require '../classes/Connection.php';
require '../classes/Products.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
}

$product = new Products($connection);

if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    if ($product->deleteProduct($productId)) {
        header("Location: ../index.php?page=manageProducts");
        exit();
    } else {
        echo "Error deleting the product. Please try again.";
    }
} else {
    echo "Invalid product ID.";
}