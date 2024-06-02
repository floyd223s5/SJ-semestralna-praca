<?php
class OrderManager {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function renderOrderList() {
        $sql = "SELECT * FROM orders";
        $result = $this->db->query($sql);

        echo '<style>
                .border-orange {
                    border: 5px solid orange !important;
                }
              </style>
              <div class="container">
                <table class="table table-bordered shadow">
                    <tr>
                        <th>ID</th>
                        <th>Dátum</th>
                        <th>Meno</th>
                        <th>Priezvisko</th>
                        <th>E-Mail</th>
                        <th>Suma</th>
                    </tr>';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderTimestamp = strtotime($row['created_at']);
                $currentTimestamp = time();
                $timeDifference = $currentTimestamp - $orderTimestamp;
                $isRecentOrder = ($timeDifference <= 43200);

                $borderColor = $isRecentOrder ? 'border-orange' : '';

                echo "<tr class='$borderColor'>
                        <td>{$row['id']}</td>
                        <td>{$row['created_at']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['total_price']} €</td>
                        <td><a href='order-details.php?id={$row['id']}'><i class='fas fa-eye'></i></a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Žiadne dáta sa nenašli</tr>";
        }

        echo '</table></div>';
    }
}
?>
