<?php

$products = new Products($connection);

// Get the religion from the URL parameter
$religionName = isset($_GET['name']) ? $_GET['name'] : null;

if ($religionName) {
    // Fetch products for this religion
    try {
        $productsArray = $products->getProductsByReligion($religionName);
        if (count($productsArray) > 0) {
            // Products found
        } else {
            echo "No products found for this religion.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No religion specified.";
}
?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            
        </div>
    </section>
    <section class="pagecontent">
        <div class="products">
            <div class="productstitle">
                <h3>Products for <?php echo $religionName; ?></h3>
            </div>
            <div class="productcontainer">
                <?php foreach ($productsArray as $product):?>
                <div class="singleproduct">
                    <a href="index.php?page=SingleProduct&id=<?php echo $product['id']; ?>" class="singleproductcontainer">
                        <div class="productgriditem">
                            <img src="assets/<?php echo $product['imgId'] ?>" alt="<?php echo $product['name'] ?>" class="productimg">
                        </div>
                        <div class="productgriditem">
                            <div class="productname">
                                <h4><?php echo $product['name'] ?></h4>
                            </div>
                            <div class="productprice">
                                <h3>$ <?php echo number_format($product['price'], 2);?></h3>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                endforeach;
                ?>
            </div>
        </div>
    </section>
    <section class="gradient-end">
    </section>
</main>