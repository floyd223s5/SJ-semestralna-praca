<?php 
include "include/header.php"; 

function formatPrice($price, $salePrice) {
    return (!empty($salePrice) && $salePrice < $price) 
        ? "<s>" . number_format($price, 2) . " €</s> <strong>" . number_format($salePrice, 2) . " €</strong>" 
        : number_format($price, 2) . " €";
}

$totalItems = !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$totalPrice = 0;
?>

<section class="pt-5 pb-5">
    <div class="container">
        <?php if ($totalItems == 0): ?>
            <div class="cartempty container text-center py-5">
                <h1>Your cart is empty</h1>
                <br>
                <a href="catalog.php">
                    <button class="viewbtn"><h5>Continue Shopping</h5></button>
                </a>
            </div>
        <?php else: ?>
            <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
            <p class="mb-5 text-center">
                <i><b><?php echo $totalItems; ?></b> Items in your cart</i>
            </p>
            <table id="shoppingCart" class="table table-condensed table-responsive">
                <thead>
                    <tr>
                        <th style="width:60%">Product</th>
                        <th style="width:12%">Price</th>
                        <th style="width:16%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION['cart'] as $item) {
                        $itemId = $item['id'];
                        $itemType = $item['type'];
                        
                        $table = ($itemType == 'product') ? 'products' : 'bundles';
                        $sql = "SELECT id, name, img_path, price, sale_price FROM $table WHERE id = $itemId";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $price = formatPrice($row['price'], $row['sale_price']);
                            $totalPrice += (!empty($row['sale_price']) && $row['sale_price'] < $row['price']) ? $row['sale_price'] : $row['price'];
                            ?>
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-md-3 text-left">
                                            <img src="<?php echo $row['img_path']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                        </div>
                                        <div class="col-md-9 text-left mt-sm-2">
                                            <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><?php echo $price; ?></td>
                                <td class="actions" data-th="">
                                    <div class="text-right">
                                        <button class="remove-item btn btn-white border-secondary bg-white btn-md mb-2" 
                                                data-item-id="<?php echo $itemId; ?>" 
                                                data-item-type="<?php echo $itemType; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 text-left">
                    <a href="catalog.php" class="btn">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 text-right">
                    <h4>Subtotal:</h4>
                    <h1><?php echo number_format($totalPrice, 2); ?> €</h1>
                    <a href="checkout.php">
                        <button class="viewbtn"><h5>Checkout</h5></button>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.remove-item').forEach(function(button) {
            button.addEventListener('click', function() {
                var itemId = button.getAttribute('data-item-id');
                var itemType = button.getAttribute('data-item-type');

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'backend/remove_from_cart.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log("Server response:", xhr.responseText);
                        if (xhr.responseText.trim() === 'Item removed from cart') {
                            button.closest('tr').remove();
                            window.location.reload();
                        }
                    }
                };
                xhr.send(`id=${itemId}&type=${itemType}`);
            });
        });
    });
</script>

<?php include "include/footer.php"; ?>
