<?php
include "include/header.php";
include_once 'classes/autoloader.php';

$db = new Database();
$orderManager = new OrderManager($db);
?>

<?php $orderManager->renderOrderList(); ?>

<?php include "include/footer.php"; ?>
