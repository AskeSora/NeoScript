<?php
session_start();
require '../classes/Connection.php';

$conobject = new Connection();
$connection = $conobject->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = $_POST['username'];
    $user_password = $_POST['password'];
    
    $stmt = $connection->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user_input);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($user_password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            header("Location: ../user.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
    
    $stmt->close();
}

$connection->close();
