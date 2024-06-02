<?php
include "include/header.php";
include_once 'classes/autoloader.php';

$db = new Database();
$salesManager = new SalesManager($db);
?>

<?php $salesManager->renderSalesChart(); ?>

<?php include "include/footer.php"; ?>
