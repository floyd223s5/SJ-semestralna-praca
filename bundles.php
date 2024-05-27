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
                    $totalProductsResult = $db->getConn()->query($totalProductsSql);
                    if ($totalProductsResult->num_rows > 0) {
                        $totalProductsRow = $totalProductsResult->fetch_assoc();
                        $totalProductsCount = $totalProductsRow['total'];
                        echo '<p>' . $totalProductsCount . ' Bundles</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    $bundles = CatalogBundles::getCatalogBundles($db, $sortOption);

    if (count($bundles) > 0) {
        $counter = 0;
        foreach ($bundles as $bundle) {
            if ($counter % 4 == 0) {
                echo '<div class="row mb-3">';
            }
            $bundle->renderCatalogBundles();
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
    ?>

</div>

<script src="javascript/sort_product.js"></script>
<script src="javascript/add_to_cart.js"></script>
<?php include "include/footer.php"; ?>
