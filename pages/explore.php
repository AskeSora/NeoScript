<?php
$products = new Products($connection);
////
try {
    $religions = $products->getReligions();
    if ($religions->num_rows > 0) {
        while($row = $religions->fetch_assoc()) {
            $religionsArray[] = $row['religion'];
        }
    } else {
        echo "No religions found.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();

}
////

?>
<main>
    <section class="gradient-start">
        <div class="welcome">
            <div class="productstitle">
                <h3>Explore Scriptures</h3>
            </div>
        </div>
    </section>
    <section class="pagecontent">
        <div class="religions">
            <div class="religionstitle">
                <a href="index.php?page=allProducts"><p>All Scriptures</p></a>
            </div>
        </div>
        <div class="religions">
            <div class="religionstitle">
                <h3>Religions</h3>
            </div>
            <div class="religionscontainer">
                <?php
                    foreach ($religionsArray as $religion):
                ?>
                <div class="religionbox">
                    <div class="religionimg">
                        <a href="index.php?page=religion&name=<?php echo $religion; ?>">
                            <img src="assets/religionLogos/<?php echo $religion ?>.png" alt="<?php echo $religion ?>" class="religionLogo">
                        </a>
                    </div>
                    <div class="religionname">
                        <a href="index.php?page=religion&name=<?php echo urlencode($religion); ?>"><p><?php echo $religion ?></p></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section class="gradient-end">
    </section>
</main>