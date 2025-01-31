<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}
require 'classes/Connection.php';
$conobject = new Connection();
$connection = $conobject->getConnection();
if ($connection === null) {
    die("Database connection is null.");
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    echo "No user found";
    exit;
} 

$isAdmin = $user['admin'] ?? null;

$username = $_SESSION['username'];

?>
<?php include 'includes/secondHeader.php';?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        </div>
    </section>
    <section class="pagecontent">
        <div class="userlinks">
            <a href="cart.php" class="cartlink">See your cart➤</a><br><br><br>
        
            <?php if ($isAdmin): ?>
                <a href="index.php?page=manageProducts" class="managelink"> Manage Products➤ </a><br><br><br>
            <?php endif; ?>
        
            <a href="code/Signout.php" class="logoutbtn">Logout➤</a>
        </div>
        
    </section>
    <section class="gradient-end">
    </section>
</main>
<?php
    include 'includes/shopFooter.php';