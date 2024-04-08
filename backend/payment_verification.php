<?php
// Pripojenie k databáze
include 'db_connect.php';

// Začiatok alebo obnovenie session
session_start();

// Skontrolovať, či bol request poslaný metódou POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Zabezpečenie proti SQL injekcii pomocou real_escape_string a premenenie totalPrice na float
    $transactionID = $conn->real_escape_string($_POST['transactionID']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $totalPrice = (float) $_POST['totalPrice'];

    // Pripravenie SQL príkazu na vloženie údajov o objednávke do databázy
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, total_price, transaction_id, status) VALUES (?, ?, ?, ?, ?, ?)");
    $status = "PAID"; // Prednastavený stav objednávky
    $stmt->bind_param("sssdss", $firstName, $lastName, $email, $totalPrice, $transactionID, $status);
    
    // Vykonanie príkazu a uloženie výsledku vykonania
    $execute_success = $stmt->execute();
    $orderId = $stmt->insert_id; // Získanie ID vytvorenej objednávky
    $stmt->close(); // Zatvorenie príkazu

    // Kontrola, či bola objednávka úspešne vložená do databázy
    if ($execute_success) {
        // Prechádzanie cez každú položku v košíku
        foreach ($_SESSION['cart'] as $item) {
            $itemId = $item['id'];
            $itemType = $item['type'];

            // Vytvorenie a vykonanie príkazu na vloženie položiek objednávky do databázy, na základe ich typu (produkt alebo balíček)
            if ($itemType == 'product') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            } elseif ($itemType == 'bundle') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, bundle_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            }
            
            $insertItemStmt->execute(); // Vykonanie príkazu
            $insertItemStmt->close(); // Zatvorenie príkazu
        }

        // Vyčistenie košíka po úspešnom vložení objednávky
        $_SESSION['cart'] = [];

        // Vrátenie úspešnej odpovede vo formáte JSON
        echo json_encode(['transactionID' => $transactionID, 'status' => 'success']);
    } else {
        // V prípade chyby vráti odpoveď s chybovou správou
        echo json_encode(['transactionID' => $transactionID, 'status' => 'error', 'message' => $stmt->error]);
    }
} else {
    // Odpoveď v prípade nesprávnej metódy requestu
    echo "Invalid request method.";
}
?>
