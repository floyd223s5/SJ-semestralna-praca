<?php
class BundleDetails {
    private $db;
    private $bundleId;

    public function __construct(Database $db, $bundleId) {
        $this->db = $db->getConn();
        $this->bundleId = $bundleId;
    }

    public function fetchBundle() {
        $sql = "SELECT id, name, img_path, price, sale_price FROM bundles WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->bundleId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function renderBundle($bundle) {
        ?>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <a href="<?php echo $bundle['img_path']; ?>">
                        <img src="<?php echo $bundle['img_path']; ?>" class="img-fluid" alt="" style="border: 1px solid gray;">
                    </a>
                </div>
                <div class="bundle-text col-lg-4 col-sm-12">
                    <p>OTARUEMBROIDERY</p>
                    <h1><?php echo $bundle['name']; ?></h1>
                    <?php if (!empty($bundle['sale_price']) && $bundle['sale_price'] < $bundle['price']): ?>
                        <p><s><?php echo number_format($bundle['price'], 2) . " €"; ?></s> <strong><?php echo number_format($bundle['sale_price'], 2) . " €"; ?></strong></p>
                    <?php else: ?>
                        <p><?php echo number_format($bundle['price'], 2) . " €"; ?></p>
                    <?php endif; ?>
                    <p>Tax Included</p>
                    <button class="add-to-cart" data-bundle-id="<?php echo $this->bundleId; ?>">Add to Cart</button>

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
                    <p>Be aware that this is an embroidery machine file. You must have an embroidery machine to use this. Please do not resize or modify the design, it may cause stitching problems. Due to the digital nature of our bundles, we have a strict NO REFUND policy. If you encounter any problems with our designs, we will try in our best ability to help you and fix the problem.</p>
                    <br><br>
                    <p><strong>INSTANT DOWNLOAD</strong></p>
                    <p>This is a digital bundle, no physical items will be shipped.</p>
                    <p>After the payment has been processed, you will receive a link for your downloads.</p>
                    <br><br>
                    <p><strong>PERSONAL USE ONLY</strong></p>
                    <p>Our bundles are ONLY meant for personal use and you may not resell them!</p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
