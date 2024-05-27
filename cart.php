<?php
include "include/header.php";

$cart = new Cart($db);

?>

<section class="pt-5 pb-5">
    <div class="container">
        <?php $cart->renderCartItems(); ?>
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
