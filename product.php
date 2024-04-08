<?php
include "include/header.php";
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT id, name, img_path, price, sale_price FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc();
        ?>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <a href="<?php echo $product['img_path']; ?>">
                        <img src="<?php echo $product['img_path']; ?>" class="img-fluid" alt="" style="border: 1px solid gray;">
                    </a>
                </div>
                <div class="product-text col-lg-4 col-sm-12">
                    <p>OTARUEMBROIDERY</p>
                    <h1><?php echo $product['name']; ?></h1>
                    <?php if (!empty($product['sale_price']) && $product['sale_price'] < $product['price']): ?>
                        <p><s><?php echo number_format($product['price'], 2) . " €"; ?></s> <strong><?php echo number_format($product['sale_price'], 2) . " €"; ?></strong></p>
                    <?php else: ?>
                        <p><?php echo number_format($product['price'], 2) . " €"; ?></p>
                    <?php endif; ?>
                    <p>Tax Included</p>
                    <button class="add-to-cart" data-product-id="<?php echo $product_id; ?>">Add to Cart</button>
                    <br><br>
                    <p><strong>IMPORTANT: AFTER DOWNLOAD YOU NEED TO EXTRACT THE FILE WITH WINZIP OR WINRAR</strong></p>
                    <br><br>
                    <p><strong>Size</strong> : 4" 6" 8" INCH</p>
                    <br>
                    <p>Formats included in a ZIP File</p>
                    <ul style="list-style-type:disc;">
                        <li>Deco, Brother, Baby Lock: <strong>PES</strong></li>
                        <li>Husqvarna, Viking: <strong>HUS</strong></li>
                        <li>Janome, Elna, Kenmore: <strong>JEF</strong></li>
                        <li>Melco: <strong>EXP</strong></li>
                        <li>Compucon, Singer: <strong>XXX</strong></li>
                        <li>Tajima, Ricoma: <strong>DST</strong></li>
                        <li>Pfaff: <strong>VP3</strong></li>
                        <li>Color Order <strong>(PDF)</strong></li>
                    </ul>
                    <p>Be aware that this is an embroidery machine file. You must have an embroidery machine to use this. Please do not resize or modify the design, it may cause stitching problems. Due to the digital nature of our products, we have a strict NO REFUND policy. If you encounter any problems with our designs, we will try in our best abillity to help you and fix the problem.</p>
                    <br><br>
                    <p><strong>INSTANT DOWNLOAD</strong></p>
                    <p>This is a digital product, no physical items will be shipped.</p>
                    <p>After the payment has been processed, you will receive a link for your downloads.</p>
                    <br><br>
                    <p><strong>PERSONAL USE ONLY</strong></p>
                    <p>Our products are ONLY meant for personal use and you may not resell them!</p>
                </div>
            </div>
            <div class="py-5">
                <h1><strong>You might also like</strong></h1>
            </div>
            <div class="row">
                <?php
                $sql = "SELECT id, name, img_path, price, sale_price FROM products WHERE id <> $product_id ORDER BY id DESC LIMIT 4";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-lg-3 col-sm-12">
                            <div class="card product-card">
                                <?php if (!empty($row['sale_price']) && $row['sale_price'] < $row['price']): ?>
                                    <div class="sale-badge">
                                        <?php
                                        $discountPercentage = (($row['price'] - $row['sale_price']) / $row['price']) * 100;
                                        echo round($discountPercentage) . '% OFF';
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <a href="product?id=<?php echo $row['id']; ?>">
                                    <img src="<?php echo $row['img_path']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><strong><?php echo $row['name']; ?></strong></h5>
                                    <?php if (!empty($row['sale_price']) && $row['sale_price'] < $row['price']): ?>
                                        <p class="card-text">
                                            <span class="original-price"><?php echo number_format($row['price'], 2); ?> €</span>
                                            <span class="ml-2"><strong><?php echo number_format($row['sale_price'], 2); ?> €</strong></span>
                                        </p>
                                    <?php else: ?>
                                        <p class="card-text"><?php echo number_format($row['price'], 2); ?> €</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No similar products found";
                }
                ?>
            </div>
        </div>
        <?php
    } else {
        echo "Product not found";
    }
} else {
    echo "Product ID not provided";
}

$conn->close();

?>
<script src="javascript/add_to_cart.js"></script>
<?php include "include/footer.php";?>
