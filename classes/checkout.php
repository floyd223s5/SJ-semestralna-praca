<?php
class Checkout {
    private $db;
    private $items;
    private $totalPrice;

    public function __construct(Database $db) {
        $this->db = $db->getConn();
        $this->items = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $this->totalPrice = 0;
        $this->calculateTotalPrice();
    }

    private function calculateTotalPrice() {
        foreach ($this->items as $item) {
            $itemId = $item['id'];
            $itemType = $item['type'];
            $table = ($itemType == 'product') ? 'products' : 'bundles';
            $stmt = $this->db->prepare("SELECT price, sale_price FROM $table WHERE id = ?");
            $stmt->bind_param('i', $itemId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $price = (!empty($row['sale_price']) && $row['sale_price'] < $row['price']) ? $row['sale_price'] : $row['price'];
                $this->totalPrice += $price;
            }
            $stmt->close();
        }
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }

    public function renderCheckoutForm() {
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
                        <p><strong>Order Total:</strong> <?php echo number_format($this->getTotalPrice(), 2); ?> €</p>
                        <p>Tax is calculated in the total price.</p>
                    </div>
                    <div id="paypal-button-container"></div>
                    <p>By proceeding with your purchase, you acknowledge and consent to our <a href="privacy-policy">Privacy Policy</a>, <a href="refund-policy">Refund Policy</a>, and <a href="shipping-policy">Shipping Policy</a>.</p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
