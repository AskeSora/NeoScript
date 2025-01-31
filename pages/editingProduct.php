<?php
$products = new Products($connection);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $product = $products->getProductById($id);
    if ($product) {
        $name = $product['name'];
        $description = $product['description'];
        $imgId = $product['imgId'];
        $inStock = $product['inStock'];
        $language = $product['language'];
        $religion = $product['religion'];
        $price = $product['price'];
        $sale = $product['sale'];
    } else {
        die("Product not found.");
    } 
} else {
    die("No product ID provided.");
}
?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <div class="productstitle">
                <h3>Edit Product:</h3>
            </div>
        </div>
    </section>
    <section class="pagecontent">
        <div class="products">
            <form class="new-product" action="code/updateProduct.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">
        
                <label for="name">Product Name:</label><br>
                <input type="text" name="name" placeholder="Product Name" autocomplete="off" value="<?php echo $name ?>"><br><br>
        
                <label for="description">Product Description:</label><br>
                <textarea name="description" cols="30" rows="4" placeholder="Product Description"><?php echo $description ?></textarea><br><br>
        
                <label for="imgId">Image ID:</label><br>
                <textarea name="imgId" cols="30" rows="3" placeholder="Image.png"><?php echo $imgId ?></textarea><br><br>
        
                <label for="inStock">Product in Stock:</label><br>
                <input type="checkbox" id="inStock" name="inStock" value="1" class="checkyboy"><br><br>
        
                <label for="language">Available Languages:</label><br>
                <textarea name="language" cols="30" rows="2" placeholder="Language"><?php echo $language ?></textarea><br><br>
        
                <label for="religion">Religion:</label><br>
                <textarea name="religion" cols="30" rows="1" placeholder="Religion"><?php echo $religion ?></textarea><br><br>
        
                <label for="price">Price:</label><br>
                <textarea name="price" cols="30" rows="1" placeholder="Price"><?php echo $price ?></textarea><br><br>
        
                <label for="onSale">Product on Sale:</label><br>
                <input type="checkbox" id="onSale" name="onSale" value="1" class="checkyboy"><br><br>
                
        
                <button type="submit" class="addprodbtn">Save Product</button>
            </form>
        </div>
    </section>
    <section class="gradient-end">
        
    </section>
</main>