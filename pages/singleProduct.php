<?php
$products = new Products($connection);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $product = $products->getProductById($id);
    if ($product) {
        $name = $product['name'];
        $description = $product['description'];
        $imgid = $product['imgId'];
        $instock = $product['inStock'];
        $language = $product['language'];
        $religion = $product['religion'];
        $price = $product['price'];
    } else {
        die("Product not found.");
    }
} else {
    die("No Product ID provided.");
}

$formattedPrice = number_format($price, 2);
?>
<main>
    <section class="gradient-start">
        
    </section>
    <section class="productpagecontent">
        <div class="prodcontainer1">
            <div class="prodgriditem1">
                <img src="assets/<?php echo $product['imgId'] ?>" alt="<?php echo $name ?>" class="prodimg">
            </div>
            <div class="prodgriditem2">
                <div class="infobox">
                    <div class="prodname">
                        <h2><?php echo $name; ?></h2><br>
                    </div>
                    <div class="pricenaddbtn">
                        <div class="prodprice">
                            <h1>$ <?php echo $formattedPrice; ?></h1>
                        </div>
                        <div class="addbtn">
                            <form action="code/addToCart.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
                                <button type="submit">Add To Cart</button><br>
                            </form>
                        </div>
                    </div>
                </div>   
                <div class="infobox">
                    <div class="proddescription">
                        <p>Product Description:</p>
                        <p><?php echo $description; ?></p>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="gradient-end">
        
    </section>
</main>