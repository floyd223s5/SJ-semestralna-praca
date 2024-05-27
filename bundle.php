<?php
include "include/header.php";

if (isset($_GET['id'])) {
    $bundle_id = $_GET['id'];
    
    $bundleDetails = new BundleDetails($db, $bundle_id);
    $bundle = $bundleDetails->fetchBundle();
    
    if ($bundle) {
        $bundleDetails->renderBundle($bundle);
    } else {
        echo "Bundle not found";
    }
} else {
    echo "Bundle ID not provided";
}

include "include/footer.php";
?>
<script src="javascript/add_to_cart.js"></script>
