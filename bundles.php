<?php 
include "include/header.php"; 
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
?>
<div class="container py-5">
    <div class="py-5">
        <div class="centerbundle">
            <h1><strong>Anime Bundles</strong></h1>
            <br>
            <p>Introducing our exclusive Anime Embroidery Design Bundles!
            <br> <br>
            Whether you're an embroidery enthusiast or a professional, these bundles offer <br> endless possibilities to bring your favorite anime characters to life through stitching. <br> Elevate your embroidery game with our extensive collection today!</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="sortment">
                    <label for="sort">Sort By:</label>
                    <select id="sort" class="form-select" onchange="handleSort(this)">
                        <option value="newest" <?php if ($sortOption === 'newest') echo 'selected'; ?>>Newest</option>
                        <option value="oldest" <?php if ($sortOption === 'oldest') echo 'selected'; ?>>Oldest</option>
                        <option value="alphabeticalAZ" <?php if ($sortOption === 'alphabeticalAZ') echo 'selected'; ?>>Alphabetically A - Z</option>
                        <option value="alphabeticalZA" <?php if ($sortOption === 'alphabeticalZA') echo 'selected'; ?>>Alphabetically Z - A</option>
                        <option value="lowestPrice" <?php if ($sortOption === 'lowestPrice') echo 'selected'; ?>>Lowest Price</option>
                        <option value="highestPrice" <?php if ($sortOption === 'highestPrice') echo 'selected'; ?>>Highest Price</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nop">
                    <?php
                    $totalProductsSql = "SELECT COUNT(*) as total FROM bundles";
                    $totalProductsResult = $conn->query($totalProductsSql);
                    if ($totalProductsResult->num_rows > 0) {
                        $totalProductsRow = $totalProductsResult->fetch_assoc();
                        $totalProductsCount = $totalProductsRow['total'];
                        echo '<p>' . $totalProductsCount . ' Bundles</p>';
                    };
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
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

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            if ($counter % 4 == 0) {
                echo '<div class="row mb-3">';
            }
            $price = $row['price'];
            $salePrice = $row['sale_price'];
            $discountPercentage = (!empty($salePrice) && $salePrice < $price) ? (($price - $salePrice) / $price * 100) : 0;
            ?>
            <div class="col-lg-3 col-sm-12">
                <a href="bundle.php?id=<?php echo $row['id']; ?>">
                    <div class="card product-card">
                        <?php if (!empty($salePrice) && $salePrice < $price): ?>
                            <div class="sale-badge">
                                <?php echo round($discountPercentage) . '% OFF'; ?>
                            </div>
                        <?php endif; ?>
                        <img src="<?php echo $row['img_path']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><strong><?php echo $row['name']; ?> </strong></h5>
                            <?php if (!empty($salePrice) && $salePrice < $price): ?>
                                <p class="card-text">
                                    <span class="original-price"><?php echo number_format($price, 2); ?> €</span>
                                    <span class="ml-2"><strong><?php echo number_format($salePrice, 2); ?> €</strong></span>
                                </p>
                            <?php else: ?>
                                <p class="card-text"><?php echo number_format($price, 2); ?> €</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            $counter++;
            if ($counter % 4 == 0) {
                echo '</div>';
            }
        }
        if ($counter % 4 != 0) {
            echo '</div>';
        }
    } else {
        echo "No bundles found";
    }

    $conn->close();
    ?>
</div>
<script src="javascript/sort_product.js"></script>
<script src="javascript/add_to_cart.js"></script>
<?php include "include/footer.php"; ?>
