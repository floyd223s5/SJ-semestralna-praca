<?php
// Include necessary files
include_once '../classes/database.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new Database instance
    $db = new Database();
    $conn = $db->getConn();

    // Secure the inputs and cast totalPrice to float
    $transactionID = $conn->real_escape_string($_POST['transactionID']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $totalPrice = (float) $_POST['totalPrice'];

    // Prepare SQL statement to insert order details into the database
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, total_price, transaction_id, status) VALUES (?, ?, ?, ?, ?, ?)");
    $status = "PAID"; // Default order status
    $stmt->bind_param("sssdss", $firstName, $lastName, $email, $totalPrice, $transactionID, $status);

    // Execute the statement and get the result
    $execute_success = $stmt->execute();
    $orderId = $stmt->insert_id; // Get the ID of the created order
    $stmt->close(); // Close the statement

    // Check if the order was successfully inserted into the database
    if ($execute_success) {
        // Iterate through each item in the cart
        foreach ($_SESSION['cart'] as $item) {
            $itemId = $item['id'];
            $itemType = $item['type'];

            // Prepare and execute statement to insert order items based on their type (product or bundle)
            if ($itemType == 'product') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            } elseif ($itemType == 'bundle') {
                $insertItemStmt = $conn->prepare("INSERT INTO order_items (order_id, bundle_id) VALUES (?, ?)");
                $insertItemStmt->bind_param("ii", $orderId, $itemId);
            }

            $insertItemStmt->execute(); // Execute the statement
            $insertItemStmt->close(); // Close the statement
        }

        // Clear the cart after successful order insertion
        $_SESSION['cart'] = [];

        // Return a successful response in JSON format
        echo json_encode(['transactionID' => $transactionID, 'status' => 'success']);
    } else {
        // Return an error response in JSON format
        echo json_encode(['transactionID' => $transactionID, 'status' => 'error', 'message' => $stmt->error]);
    }
} else {
    // Return a response for an invalid request method
    echo "Invalid request method.";
}
?>
