<?php
class Cart {
    private $db;
    private $items;

    public function __construct(Database $db) {
        $this->db = $db->getConn();
        $this->items = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    public function formatPrice($price, $salePrice) {
        return (!empty($salePrice) && $salePrice < $price) 
            ? "<s>" . number_format($price, 2) . " €</s> <strong>" . number_format($salePrice, 2) . " €</strong>" 
            : number_format($price, 2) . " €";
    }

    public function getTotalItems() {
        return count($this->items);
    }

    public function getTotalPrice() {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $table = ($item['type'] == 'product') ? 'products' : 'bundles';
            $sql = "SELECT price, sale_price FROM $table WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $item['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $totalPrice += (!empty($row['sale_price']) && $row['sale_price'] < $row['price']) ? $row['sale_price'] : $row['price'];
            }
        }
        return $totalPrice;
    }

    public function renderCartItems() {
        if ($this->getTotalItems() == 0) {
            echo '<div class="cartempty container text-center py-5">
                    <h1>Your cart is empty</h1>
                    <br>
                    <a href="catalog.php">
                        <button class="viewbtn"><h5>Continue Shopping</h5></button>
                    </a>
                  </div>';
        } else {
            echo '<h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                  <p class="mb-5 text-center">
                      <i><b>' . $this->getTotalItems() . '</b> Items in your cart</i>
                  </p>
                  <table id="shoppingCart" class="table table-condensed table-responsive">
                      <thead>
                          <tr>
                              <th style="width:60%">Product</th>
                              <th style="width:12%">Price</th>
                              <th style="width:16%"></th>
                          </tr>
                      </thead>
                      <tbody>';
            
            foreach ($this->items as $item) {
                $table = ($item['type'] == 'product') ? 'products' : 'bundles';
                $sql = "SELECT id, name, img_path, price, sale_price FROM $table WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->bind_param("i", $item['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $price = $this->formatPrice($row['price'], $row['sale_price']);
                    echo '<tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-md-3 text-left">
                                        <img src="' . $row['img_path'] . '" alt="' . htmlspecialchars($row['name']) . '" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                    </div>
                                    <div class="col-md-9 text-left mt-sm-2">
                                        <h4>' . htmlspecialchars($row['name']) . '</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">' . $price . '</td>
                            <td class="actions" data-th="">
                                <div class="text-right">
                                    <button class="remove-item btn btn-white border-secondary bg-white btn-md mb-2" 
                                            data-item-id="' . $item['id'] . '" 
                                            data-item-type="' . $item['type'] . '">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                          </tr>';
                }
            }
            
            echo '</tbody>
                  </table>
                  <div class="row">
                      <div class="col-lg-8 col-md-6 col-sm-6 text-left">
                          <a href="catalog.php" class="btn">
                              <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                          </a>
                      </div>
                      <div class="col-lg-4 col-md-6 col-sm-6 text-right">
                          <h4>Subtotal:</h4>
                          <h1>' . number_format($this->getTotalPrice(), 2) . ' €</h1>
                          <a href="checkout.php">
                              <button class="viewbtn"><h5>Checkout</h5></button>
                          </a>
                      </div>
                  </div>';
        }
    }
}
?>
