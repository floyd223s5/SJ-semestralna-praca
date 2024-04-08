<?php
// Začiatok session pre možnosť práce s premennými session
session_start();

// Funkcia na kontrolu, či je položka už v košíku
function isItemInCart($item, $cart) {
    // Prechádza všetkými položkami v košíku
    foreach ($cart as $cartItem) {
        // Porovnáva ID a typ položky s položkou, ktorú chceme pridať
        if ($cartItem['id'] == $item['id'] && $cartItem['type'] == $item['type']) {
            return true; // Položka už je v košíku
        }
    }
    return false; // Položka v košíku nie je
}

// Určenie typu položky na základe POST dát
$itemType = isset($_POST['product_id']) ? 'product' : 'bundle';
// Získanie ID položky na základe typu
$itemId = $itemType === 'product' ? $_POST['product_id'] : $_POST['bundle_id'];

// Kontrola, či bolo ID položky poskytnuté
if (!empty($itemId)) {
    // Inicializácia košíka v session, ak ešte neexistuje
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Vytvorenie položky na pridanie do košíka
    $item = array('id' => $itemId, 'type' => $itemType);

    // Kontrola, či položka už v košíku je
    if (!isItemInCart($item, $_SESSION['cart'])) {
        // Pridanie položky do košíka, ak tam nie je
        $_SESSION['cart'][] = $item;
        // Informovanie o úspešnom pridaní
        echo ucfirst($itemType) . ' added to cart';
    } else {
        // Informovanie, ak je položka už v košíku
        echo ucfirst($itemType) . ' already in cart';
    }
} else {
    // Informovanie, ak nebol poskytnutý ID položky
    echo 'Item ID not provided';
}
?>
