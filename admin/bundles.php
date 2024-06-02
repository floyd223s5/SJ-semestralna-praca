<?php
include "include/header.php";
include_once 'classes/autoloader.php';

$db = new Database();
$bundleManager = new BundleManager($db);

$bundleManager->handlePostRequest();
?>

<?php $bundleManager->renderBundleList(); ?>

<?php include "include/footer.php"; ?>
