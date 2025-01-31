<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}
require 'classes/Connection.php';
require 'classes/Products.php';

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

$currentCart = $user['cart'] ?? null;

if ($currentCart) {
    $currentCart = explode(',', $currentCart); // Splits into array
}

$productsInCart = [];

$products = new Products($connection);
foreach ($currentCart as $cartItemId) {
    $product = $products->getProductById($cartItemId);
    if ($product) {
        $productsInCart[] = $product;
    }
}

$pricetotal = 0.0;
/*
 * Remember to put prices and total to show in cart, and checkout button.
 * Set up products as vertical list 
 */
?>
<?php include 'includes/secondHeader.php';?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <div class="productstitle">
                <h3>Your Cart:</h3>
            </div>
        </div>
    </section>
    <section class="pagecontent">
        <div class="products">
            <div class="productstitle">
                <p class="nihongo">あなたのカート:</p>
            </div>
            <div class="cartcontainer">
                <?php if (empty($productsInCart)) : ?>
                    <div class="nothingtxt">
                        <p>There is nothing in your cart.<br>
                            Explore our <a href="explore.php" class="explorelinkcart">products</a> and add them to your cart to see them here.</p>
                    </div>
                <?php endif; 
                if ($productsInCart) :
                    foreach ($productsInCart as $product):?>
                        <div class="cartproduct">
                            <div class="cartproductcontainer">
                                <div class="cartgriditem">
                                    <a href="SingleProduct.php?id=<?php echo $product['id']; ?>">
                                    <img src="assets/<?php echo $product['imgId'] ?>" alt="<?php echo $product['name'] ?>" class="cartproductimg">
                                    </a>
                                </div>
                                <div class="cartgriditem">
                                    <div class="cartproductname">
                                        <h4><?php echo $product['name'] ?></h4>
                                    </div>
                                    <div class="productprice">
                                        <h3>$ <?php echo $product['price'];
                                        $productPrice = $product['price'];
                                        $pricetotal = ($pricetotal + $productPrice);
                                        ?></h3>
                                    </div>
                                    <div class="removebtn">
                                        <!-- The form will trigger the removeProduct method when submitted -->
                                        <form action="code/removeFromCart.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        endforeach;
                    endif; ?>
                <div class="totalprice">
                    <h3>Total: $ <?php echo $pricetotal; ?></h3>
                </div>
                <div class="gotocheckoutbtn">
                    <a href="checkout.php">Proceed to Checkout➤</a>
                </div>
                
            </div>
        </div>
        
    </section>
    <section class="gradient-end">
        
    </section>
</main>
<?php
    include 'includes/shopFooter.php';
