// Po načítaní celého dokumentu spustí nasledujúcu funkciu
document.addEventListener('DOMContentLoaded', () => {
    // Vyberie všetky tlačidlá s triedou 'add-to-cart'
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    // Pre každé tlačidlo z vyššie vybraných pridá event listener na kliknutie
    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Získa product ID a bundle ID z datasetu tlačidla
            const productId = button.dataset.productId;
            const bundleId = button.dataset.bundleId;

            // Skontroluje, či existuje produkt alebo balíček ID a pridá do košíka, inak vypíše chybu
            if (productId || bundleId) {
                addToCart(productId ? 'product_id' : 'bundle_id', productId || bundleId, button);
            } else {
                console.error('No product or bundle ID found');
            }
        });
    });

    // Funkcia na pridanie produktu alebo balíčka do košíka pomocou AJAX požiadavky
    function addToCart(type, id, button) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/add_to_cart.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            // Po úspešnej odpovedi servera aktualizuje tlačidlo
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                handleResponse(xhr.responseText.trim(), button);
            }
        };
        xhr.send(`${type}=${id}`);
    }

    // Spracuje odpoveď od servera a aktualizuje text a štýl tlačidla
    function handleResponse(responseText, button) {
        if (responseText.toLowerCase().includes('added to cart')) {
            button.innerText = 'Added to cart'; // Zmení text tlačidla
            button.classList.add('added'); // Pridá triedu pre vizuálnu zmenu tlačidla
            setTimeout(() => resetButton(button), 1000); // Resetuje tlačidlo po 1 sekunde
        } else if (responseText.toLowerCase().includes('already in cart')) {
            button.innerText = 'Already in cart'; // Informuje užívateľa, že produkt je už v košíku
            setTimeout(() => resetButton(button), 1000); // Resetuje tlačidlo po 1 sekunde
        }
    }

    // Resetuje tlačidlo do pôvodného stavu
    function resetButton(button) {
        button.innerText = 'Add to Cart'; // Vráti pôvodný text tlačidla
        button.classList.remove('added'); // Odstráni vizuálnu zmenu tlačidla
    }
});
