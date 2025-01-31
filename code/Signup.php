<?php
require '../classes/Connection.php';

$conobject= new Connection();
$connection = $conobject->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful! You can now <a href='../index.php?page=login'>login</a>.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$connection->close();