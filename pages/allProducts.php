<?php

$products = new Products($connection);
$productList = $products->getAllProducts();

?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <div class="productstitle">
                <h3>All Scriptures:</h3>
            </div>
        </div>
    </section>
    <section class="pagecontent">
        <div class="products">
            <div class="productstitle">
                <p class="nihongo">すべての製品</p>
            </div>
            <div class="productcontainer">
                <?php foreach ($productList as $product):?>
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