<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require '../classes/Connection.php';
require '../classes/Products.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
} else {
    header('Location: ../cart.php');
    exit;
}

$products = new Products($connection);

$removed = $products->removeProductFromCart($user_id, $product_id);

if ($removed) {
    header('Location: ../cart.php');
} else {
    echo "Failed to remove the product.";
}
?>