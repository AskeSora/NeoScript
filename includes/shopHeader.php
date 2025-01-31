<?php
require 'settings.php';
require 'classes/Connection.php';
require 'classes/Products.php';
$conobject = new Connection();
$connection = $conobject->getConnection();

if ($connection === null) {
    die("Database connection is null.");
} /*else {
    echo "Connection obtained successfully.<br>";
}*/

$products = new Products($connection);
$productList = $products->getAllProducts();
$productcount = 0;
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Neo Script</title> 
        <style>
            <?php include 'includes/shopMain.css'; ?>
        </style>
    </head>
    <body>
        <header>
            <div class="header-grid">
                <div class="header-grid-item">
                    <div class="NeoScript">
                        <a href="index.php" class="NeoScriptlink">NeoScript</a>
                    </div>
                </div>
                <div class="header-grid-item">
                    <div class="explore">
                        <a class="explorelink" href="index.php?page=explore">Explore the future</a>
                    </div>
                </div>
                <div class="header-grid-item">
                    <div class="icons">
                        <a href="cart.php">
                            <img src="assets/cart.png" alt="cart" class="cartimg">
                        </a>
                        <a href="user.php">
                            <img src="assets/user.png" alt="user" class="userimg">
                        </a>
                    </div>
                </div>    
            </div>
            <img src="assets/NeoScriptLogo.png" alt="logo" class="header-logo">
            <img src="assets/divider.png" alt="contentdivider" class="divider">
        </header>