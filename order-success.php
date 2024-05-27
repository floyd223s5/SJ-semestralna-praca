<?php
include "include/header.php";

$orderSuccess = new OrderSuccess($db);
$orderSuccess->renderOrderSuccessPage();

include "include/footer.php";
?>
