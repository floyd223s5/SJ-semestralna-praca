<?php
include "include/header.php";
include_once 'classes/autoloader.php';

$db = new Database();
$orderDetails = new OrderDetails($db);
?>

<div class="container py-5">
    <div class="details">
        <a href="orders.php">
            <i class="fas fa-arrow-left" style="color: black;"></i>
        </a>
        <br>
        <?php
        if (isset($_GET['id'])) {
            $order_id = $_GET['id'];
            $orderDetails->renderOrderDetails($order_id);
        } else {
            echo "<div class='container'>";
            echo "<p>Chýbajúci parameter 'id'.</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php include "include/footer.php"; ?>
