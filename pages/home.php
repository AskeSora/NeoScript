<main>
    <section class="gradient-start">
        <div class="welcome">
            <h1>Welcome to NeoScript</h1>
            <h2>The future of holy scriptures</h2>
        </div>
    </section>
    <section class="pagecontent">
        <div class="featuredcontent">
            <div class="featureditem">
                <div class="featimgtext">
                    <p class="featitemtitle">Past & Present</p>
                    <p>Learning from our traditions of the past is your key to unlocking your true potential.</p>
                </div>
            </div>
            <div class="featureditem">
                <a href="index.php?page=japaneseCollection">
                    
                    <div class="featimgtext">
                        <p class="nihongotitle">信仰</p>
                        <p>See our collection of holy scriptures now in Japanese.</p>
                        <p class="nihongo">可能性を見てみましょう</p>
                    </div>
                </a>
            </div>
            <div class="featureditem">
                <div class="featimgtext">
                    <p class="featitemtitle">Niche Scriptures:</p>
                    <p>Long-since outdated religions and the ones with small followings have just as much to offer.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="pagecontent">
        <div class="products">
            <div class="productstitle">
                <h3>Featured Products</h3>
                <p class="nihongo">この製品はお勧めです</p>
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
                $productcount++;
                if($productcount >= 3) {
                    break;
                }
                endforeach;
                ?>
            </div>
        </div>
    </section>
    <section class="gradient-end">
    </section>
</main>