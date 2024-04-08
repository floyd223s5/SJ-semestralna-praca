<?php 
include "include/header.php";

$totalPrice = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $itemId = $item['id'];
        $itemType = $item['type'];

        $table = ($itemType == 'product') ? 'products' : 'bundles';
        $stmt = $conn->prepare("SELECT price, sale_price FROM $table WHERE id = ?");
        $stmt->bind_param('i', $itemId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $price = (!empty($row['sale_price']) && $row['sale_price'] < $row['price']) ? $row['sale_price'] : $row['price'];
            $totalPrice += $price;
        }
        $stmt->close();
    }
}
?>
<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 col-sm-12">
            <h1 class="mb-4">Checkout</h1>
            <form>
                <div class="checkout">
                    <div class="form-group pb-3">
                        <label for="firstName"><h3>First Name</h3></label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required pattern="[A-Za-z\s]{1,40}">
                        <small class="text-danger firstName"></small>
                    </div>

                    <div class="form-group pb-3">
                        <label for="lastName"><h3>Last Name</h3></label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required pattern="[A-Za-z\s]{1,40}">
                        <small class="text-danger lastName"></small>
                    </div>

                    <div class="form-group pb-3">
                        <label for="email"><h3>Email</h3></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your e-mail">
                        <small class="text-danger email"></small>
                    </div>

                    <div class="form-group pb-3">
                        <label for="confirmEmail"><h3>Confirm Email</h3></label>
                        <input type="email" class="form-control" id="confirmEmail" name="confirmEmail" placeholder="Confirm your e-mail">
                        <small class="text-danger confirmEmail"></small>
                    </div>
                </form>
            </div>    
        </div>

        <div class="col-lg-4 col-sm-12">
            <h3 class="mb-3">Order Summary</h3>
            <div class="border p-3 mb-3">
                <p style="color: red;">*Note: We've temporarily shifted to <u>email delivery</u> for digital goods. Ensure <u>accurate personal details at checkout</u> for prompt delivery. Thank you.</p>
                <p><strong>Order Total:</strong> <?php echo number_format($totalPrice, 2); ?> €</p>
                <p>Tax is calculated in the total price.</p>
            </div>
            <div id="paypal-button-container"></div>
	    <p>By proceeding with your purchase, you acknowledge and consent to our <a href="privacy-policy">Privacy Policy</a>, <a href="refund-policy">Refund Policy</a>, and <a href="shipping-policy">Shipping Policy</a>.</p>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php echo '<script src="https://www.paypal.com/sdk/js?client-id=' . PAYPAL_CLIENT_ID . '&currency=EUR"></script>';?>
    <script>
        paypal.Buttons({
            onClick: function() {
            var firstName = $('#firstName').val();
            var lastName = $('#lastName').val();
            var email = $('#email').val();
            var confirmEmail = $('#confirmEmail').val();
            var isValid = true;

            $('.text-danger').text('');

            if (firstName.length == 0) {
                $('.firstName').text("*First name is required.");
                isValid = false;
            } else if (firstName.length < 2) {
                $('.firstName').text("*First name must be at least 2 characters long.");
                isValid = false;
            } else if (!/^[A-Za-z\s\p{L}'-]+$/u.test(firstName)) {
                $('.firstName').text("*First name must not contain numbers or invalid special characters.");
                isValid = false;
            }

            if (lastName.length == 0) {
                $('.lastName').text("*Last name is required.");
                isValid = false;
            } else if (lastName.length < 3) {
                $('.lastName').text("*Last name must be at least 3 characters long.");
                isValid = false;
            } else if (!/^[A-Za-z\s\p{L}'-]+$/u.test(lastName)) {
                $('.lastName').text("*Last name must not contain numbers or invalid special characters.");
                isValid = false;
            }

            if (email.length == 0) {
                $('.email').text("*E-mail address is required.");
                isValid = false;
            } else if (!email.includes('@')){
                $('.email').text("*Please enter a valid e-mail address (Symbol @ is missing)");
                isValid = false;
            }

            if (confirmEmail.length == 0) {
                $('.confirmEmail').text("*E-mail must be confirmed");
                isValid = false
            } else if (email !== confirmEmail) {
                $('.confirmEmail').text("*E-mail addresses must match");
                isValid = false;
            }

            return isValid;
        },
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?= $totalPrice ?>'
                        } 
                    }]
                });
            },
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    $.ajax({
                        type: "POST",
                        url: "backend/payment_verification.php",
                        data: {
                            transactionID: transaction.id,
                            firstName: $('#firstName').val(),
                            lastName: $('#lastName').val(),
                            email: $('#email').val(),
                            totalPrice: '<?= $totalPrice ?>'
                        },
                        success: function(response) {
                            console.log(response);
                            var res = JSON.parse(response);
                            window.location.href = 'order-success';
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Error occurred: " + textStatus, errorThrown);
                        }
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
<?php include "include/footer.php"; ?>