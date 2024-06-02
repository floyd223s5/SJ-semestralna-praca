<?php
include "include/header.php";
include_once 'classes/autoloader.php';

$db = new Database();
$productManager = new ProductManager($db);

$productManager->handlePostRequest();
?>

<?php $productManager->renderProductList(); ?>

<?php include "include/footer.php"; ?>
