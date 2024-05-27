<?php
class CatalogBundles {
    private $id;
    private $name;
    private $imgPath;
    private $price;
    private $salePrice;

    public function __construct($id, $name, $imgPath, $price, $salePrice) {
        $this->id = $id;
        $this->name = $name;
        $this->imgPath = $imgPath;
        $this->price = $price;
        $this->salePrice = $salePrice;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImgPath() {
        return $this->imgPath;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getSalePrice() {
        return $this->salePrice;
    }

    public static function getCatalogBundles(Database $db, $sortOption) {
        $conn = $db->getConn();
        
        switch ($sortOption) {
            case 'alphabeticalAZ':
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY name ASC";
                break;
            case 'alphabeticalZA':
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY name DESC";
                break;
            case 'lowestPrice':
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY price ASC";
                break;
            case 'highestPrice':
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY price DESC";
                break;
            case 'oldest':
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY id ASC";
                break;
            default:
                $sortSql = "SELECT id, name, img_path, price, sale_price FROM bundles ORDER BY id DESC";
                break;
        }

        $result = $conn->query($sortSql);
        $bundles = [];
        while ($row = $result->fetch_assoc()) {
            $bundles[] = new CatalogBundles($row['id'], $row['name'], $row['img_path'], $row['price'], $row['sale_price']);
        }
        return $bundles;
    }

    public function renderCatalogBundles() {
        $discountPercentage = (!empty($this->salePrice) && $this->salePrice < $this->price) ? round(($this->price - $this->salePrice) / $this->price * 100) : 0;
        $saleBadge = $discountPercentage ? "<div class='sale-badge'>{$discountPercentage}% OFF</div>" : "";
        echo "<div class='col-lg-3 col-sm-12'>";
        echo "<a href='bundle.php?id={$this->id}'>";
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
