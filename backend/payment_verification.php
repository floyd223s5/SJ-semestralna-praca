<?php
include_once '../classes/database.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->getConn();
    $transactionID = $conn->real_escape_string($_POST['transactionID']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $totalPrice = (float) $_POST['totalPrice'];

    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, total_price, transaction_id, status) VALUES (?, ?, ?, ?, ?, ?)");
    $status = "PAID";
    $stmt->bind_param("sssdss", $firstName, $lastName, $email, $totalPrice, $transactionID, $status);

    $execute_success = $stmt->execute();
    $orderId = $stmt->insert_id;
    $stmt->close();

    if ($execute_success) {
        $_SESSION['purchased_items'] = $_SESSION['cart'];
        foreach ($_SESSION['cart'] as $item) {
            $itemId = $item['id'];
            $itemType = $item['type'];

            if ($itemType == 'product') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            } elseif ($itemType == 'bundle') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, bundle_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            }

            $insertItemStmt->execute();
            $insertItemStmt->close();
        }
        $_SESSION['cart'] = [];

        echo json_encode(['transactionID' => $transactionID, 'status' => 'success']);
    } else {
        echo json_encode(['transactionID' => $transactionID, 'status' => 'error', 'message' => $stmt->error]);
    }
} else {
    echo "Invalid request method.";
}
?>
