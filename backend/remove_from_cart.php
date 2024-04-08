<?php
// Začiatok session pre možnosť práce s premennými session
session_start();

// Kontrola, či boli prostredníctvom POST odoslané ID a typ položky
if (isset($_POST['id']) && isset($_POST['type'])) {
    // Získanie ID a typu položky z POST dát
    $itemId = $_POST['id'];
    $itemType = $_POST['type'];

    // Prechádzanie položiek v košíku uložených v session
    foreach ($_SESSION['cart'] as $index => $item) {
        // Kontrola zhody ID a typu s odstraňovanou položkou
        if ($item['id'] == $itemId && $item['type'] == $itemType) {
            // Odstránenie položky z košíka
            unset($_SESSION['cart'][$index]);
            // Reindexácia pola, aby sa predišlo dieram v indexoch po odstránení
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            // Oznámenie o úspešnom odstránení a ukončenie skriptu
            echo 'Item removed from cart'; 
            exit();
        }
    }
    // Ak sa položka v košíku nenašla, vypíše sa oznámenie
    echo 'Item not found in cart';
} else {
    // Ak neboli správne poskytnuté všetky potrebné údaje (ID a typ), oznámi sa chyba
    echo 'Item ID or type not provided'; 
}
?>
