<?php
session_start();

// Checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add items to your cart.");
}
// Grabbing product id
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
} else {
    die("Product ID is missing.");
}
// Connecting to database
require '../classes/Connection.php';
require '../classes/Products.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
}
// Utilizing Products class
$products = new Products($connection);
$product = $products->getProductById($productId);

if (!$product) {
    die("Product not found,");
}
// Getting userID
$userId = $_SESSION['user_id'];

// Retrieving current cart data from user
$query = "SELECT cart FROM users WHERE id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$currentCart = $user['cart'];
if ($currentCart) {
    //if somethings already in the cart we'll append
    $currentCart = explode(',', $currentCart); //Splits into array
    if (!in_array($productId, $currentCart)) { //Avoiding duplicates
        $currentCart[] = $productId;// Adding new product
    }
    $newCart = implode(',', $currentCart);// Back to string
} else {
    $newCart = $productId; //If cart is empty, just put in cart
}
// Update user's cart
$updateQuery = "UPDATE users SET cart = ? WHERE id = ?";
$stmt = $connection->prepare($updateQuery);
$stmt->bind_param("si", $newCart, $userId);
$stmt->execute();

// Redirecting back to product page
header("Location: ../user.php");
//"Location: ../singleProduct.php?id=$productId"
exit();
?>
