<?php
include "include/header.php";

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $productDetails = new ProductDetails($db, $product_id);
    $product = $productDetails->fetchProductDetails();
    
    if ($product) {
        $productDetails->renderProductDetails($product);
        
        $showcaseSimilar = new ShowcaseSimilar($db, $product_id);
        $showcaseSimilar->renderSimilarProducts();
    } else {
        echo "Product not found";
    }
} else {
    echo "Product ID not provided";
}

include "include/footer.php";
?>
<script src="javascript/add_to_cart.js"></script>
