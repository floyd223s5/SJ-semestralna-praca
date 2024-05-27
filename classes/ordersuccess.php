<?php
class OrderSuccess {
    private $db;
    private $purchasedItems;

    public function __construct(Database $db) {
        $this->db = $db->getConn();
        $this->purchasedItems = $_SESSION['purchased_items'] ?? [];
    }

    public function getPurchasedProducts() {
        $products = [];

        if (!empty($this->purchasedItems)) {
            foreach ($this->purchasedItems as $item) {
                $table = ($item['type'] === 'product') ? 'products' : 'bundles';
                $stmt = $this->db->prepare("SELECT name, download_link FROM $table WHERE id = ?");
                $stmt->bind_param('i', $item['id']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $products[$item['id']] = ['name' => $row['name'], 'link' => $row['download_link']];
                }
                $stmt->close();
            }
        }

        return $products;
    }

    public function renderOrderSuccessPage() {
        $products = $this->getPurchasedProducts();
        ?>
        <div class="container mt-5 py-5">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img src="img/thank-you-for-purchase.png" alt="" style="max-width: 500px;">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="order-success">
                        <h1>Order Confirmed!</h1>
                        <p>Thank you for your purchase! Here are your links to access the purchased items:</p>
                        <?php if (!empty($products)): ?>
                            <ul>
                                <?php foreach ($products as $id => $product): ?>
                                    <a href="<?php echo htmlspecialchars($product['link']); ?>" target="_blank" rel="noopener noreferrer">
                                        <p>
                                            <i class="fa fa-download" aria-hidden="true"></i> <b><u><?php echo htmlspecialchars($product['name']); ?></u></b>
                                        </p>
                                    </a>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <p>If you have any questions, feel free to reach out to us at <b>otaruembroideries@gmail.com</b> or on our social media.</p>
                        <p>Be aware that this is an embroidery machine file. You must have an embroidery machine to use this. Please do not resize or modify the design, it may cause stitching problems. Due to the digital nature of our products, we have a strict NO REFUND policy.</p>
                        <p>We appreciate your choice to shop with us, and happy stitching!</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
