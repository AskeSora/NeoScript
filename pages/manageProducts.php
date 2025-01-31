<?php
$products = new Products($connection);
$productList = $products->getAllProducts();
?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <h1>Manage Products</h1>
        </div>
    </section>
    <section class="pagecontent">
        <div class="addProductlink">
            <a href="index.php?page=addProduct"><p>Add new Product</p></a>
        </div>
        <div class="products">
            <div class="productstitle">
                <h3>Existing Products:</h3>
            </div>
            <div class="cartcontainer">
                <?php foreach ($productList as $product):?>
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
                                    <div class="removebtn">
                                        <!-- The form will trigger the removeProduct method when submitted -->
                                        <form action="index.php?page=editingProduct&id=<?php echo $product['id']; ?>" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit">EDIT</button>
                                        </form>
                                    </div>
                                    <div class="removebtn">
                                        <form action="code/deleteproduct.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <button type="submit">DELETE</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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