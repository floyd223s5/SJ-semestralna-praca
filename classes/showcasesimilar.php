<?php
class ShowcaseSimilar {
    private $db;
    private $productId;

    public function __construct(Database $db, $productId) {
        $this->db = $db->getConn();
        $this->productId = $productId;
    }

    public function fetchSimilarProducts() {
        $sql = "SELECT id, name, img_path, price, sale_price FROM products WHERE id <> ? ORDER BY id DESC LIMIT 4";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $this->productId);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    public function renderSimilarProducts() {
        $similarProducts = $this->fetchSimilarProducts();
        if (count($similarProducts) > 0) {
            echo '<div class="container py-5">';
            echo '<h1><strong>You might also like</strong></h1>';
            echo '<div class="row">';
            foreach ($similarProducts as $row) {
                $discountPercentage = (!empty($row['sale_price']) && $row['sale_price'] < $row['price']) ? round(($row['price'] - $row['sale_price']) / $row['price'] * 100) : 0;
                $saleBadge = $discountPercentage ? "<div class='sale-badge'>{$discountPercentage}% OFF</div>" : "";
                echo "<div class='col-lg-3 col-sm-12'>";
                echo "<div class='card product-card'>";
                echo $saleBadge;
                echo "<a href='product?id={$row['id']}'>";
                echo "<img src='{$row['img_path']}' class='card-img-top' alt='{$row['name']}'>";
                echo "</a>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'><strong>{$row['name']}</strong></h5>";
                if ($row['sale_price'] && $row['sale_price'] < $row['price']) {
                    echo "<p class='card-text'><span class='original-price'>{$row['price']} €</span><span class='ml-2'><strong>{$row['sale_price']} €</strong></span></p>";
                } else {
                    echo "<p class='card-text'>{$row['price']} €</p>";
                }
                echo "</div></div></div>";
            }
            echo '</div></div>';
        } else {
            echo "No similar products found";
        }
    }
}
?>
