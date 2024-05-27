<?php 
include "include/header.php";

$checkout = new Checkout($db);
?>

<div class="container my-5">
    <?php $checkout->renderCheckoutForm(); ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php echo '<script src="https://www.paypal.com/sdk/js?client-id=ASI8YQNOSo2d-1h_WjdCKTuU82CzxPRbDbJeMZtIwLbkra1JzWC8TKjcFycVNE1FhrcEDIIfQUp0RMwu&currency=EUR"></script>'; ?>
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
                        value: '<?= $checkout->getTotalPrice() ?>'
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
                        totalPrice: '<?= $checkout->getTotalPrice() ?>'
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
