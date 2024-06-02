<?php
class OrderDetails {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function renderOrderDetails($order_id) {
        $conn = $this->db->getConn();
        
        $orderSql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $conn->prepare($orderSql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $orderResult = $stmt->get_result();

        if ($orderResult->num_rows > 0) {
            $orderRow = $orderResult->fetch_assoc();
            
            echo "<h1>Objednávka ID: {$orderRow['id']}</h1>";
            echo "<p><b>Dátum:</b> {$orderRow['created_at']}</p>";
            echo "<p><b>Meno:</b> {$orderRow['first_name']} {$orderRow['last_name']}</p>";
            echo "<p><b>E-Mail:</b> {$orderRow['email']}</p>";
            echo "<p><b>Suma:</b> {$orderRow['total_price']} €</p>";
            echo "<p><b>Transaction ID:</b> {$orderRow['transaction_id']}</p>";
            echo "<br><br>";

            $orderItemsSql = "SELECT oi.id, oi.product_id, oi.bundle_id FROM order_items oi WHERE oi.order_id = ?";
            $stmt = $conn->prepare($orderItemsSql);
            $stmt->bind_param("i", $order_id);
            $stmt->execute();
            $orderItemsResult = $stmt->get_result();

            echo "<h2>Položky objednávky</h2>";
            echo "<table class='table table-bordered' style='margin-top: 10px;'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Zľavnená cena</th>
                  </tr>";

            if ($orderItemsResult->num_rows > 0) {
                while ($orderItemRow = $orderItemsResult->fetch_assoc()) {
                    $itemId = $orderItemRow['product_id'] ?? $orderItemRow['bundle_id'];
                    $itemType = isset($orderItemRow['product_id']) ? 'products' : 'bundles';
                    
                    $itemSql = "SELECT id, name, img_path, price, sale_price FROM $itemType WHERE id = ?";
                    $stmt = $conn->prepare($itemSql);
                    $stmt->bind_param("i", $itemId);
                    $stmt->execute();
                    $itemResult = $stmt->get_result();
                    $itemRow = $itemResult->fetch_assoc();

                    echo "<tr>
                            <td>{$itemRow['id']}</td>
                            <td>{$itemRow['name']}</td>
                            <td>{$itemRow['price']} €</td>
                            <td>{$itemRow['sale_price']} €</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Žiadne položky objednávky</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<div class='container'>";
            echo "<p>Objednávka s ID $order_id nebola nájdená.</p>";
            echo "</div>";
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>
