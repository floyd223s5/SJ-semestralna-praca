<?php
class ProductShowcaseIndex {
    public $id;
    public $name;
    public $imgPath;
    public $price;
    public $salePrice;

    public function __construct($id, $name, $imgPath, $price, $salePrice) {
        $this->id = $id;
        $this->name = $name;
        $this->imgPath = $imgPath;
        $this->price = $price;
        $this->salePrice = $salePrice;
    }

    public static function getAllProducts(Database $db) {
        $conn = $db->getConn();
        $sql = "SELECT id, name, img_path, price, sale_price FROM products ORDER BY id DESC LIMIT 8";
        $result = $conn->query($sql);
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = new ProductShowcaseIndex($row['id'], $row['name'], $row['img_path'], $row['price'], $row['sale_price']);
        }
        return $products;
    }

    public function renderProductShowcaseIndex() {
        $discountPercentage = (!empty($this->salePrice) && $this->salePrice < $this->price) ? round(($this->price - $this->salePrice) / $this->price * 100) : 0;
        $saleBadge = $discountPercentage ? "<div class='sale-badge'>{$discountPercentage}% OFF</div>" : "";
        echo "<div class='col-lg-3 col-sm-12'>";
        echo "<a href='product?id={$this->id}'>";
        echo "<div class='card product-card'>";
        echo $saleBadge;
        echo "<img src='{$this->imgPath}' class='card-img-top' alt='{$this->name}'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'><strong>{$this->name}</strong></h5>";
        if ($this->salePrice && $this->salePrice < $this->price) {
            echo "<p class='card-text'><span class='original-price'>{$this->price} €</span><span class='ml-2'><strong>{$this->salePrice} €</strong></span></p>";
        } else {
            echo "<p class='card-text'>{$this->price} €</p>";
        }
        echo "</div></div></a></div>";
    }
}
?>
