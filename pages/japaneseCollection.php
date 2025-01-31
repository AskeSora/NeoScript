<?php
$products = new Products($connection);
$religionlanguage = "Japanese";
try {
    $productsArray = $products->searchProducts($religionlanguage);
    if (count($productsArray) > 0) {
            // Products found
    } else {
        echo "No products found in this language.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
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
                <h3>Scriptures available in Japanese:</h3>
                <p class="nihongo">日本の経典:</p>
                <span class="Breadtext">Branching out to make our scriptures accessible to more people is a cause worth pursuing.<br>
                Here's our collection of products that are available in Japanese, translated by linguistic experts.</span>
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
                        </div>
                    </a>
                </div>
                <?php 
                endforeach;
                ?>
            </div>
        </div>
        
    </section>
    <section class="pagecontent">
        
    </section>
    <section class="gradient-end">
        
    </section>
</main>