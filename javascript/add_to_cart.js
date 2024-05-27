document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.dataset.productId;
            const bundleId = button.dataset.bundleId;

            if (productId || bundleId) {
                addToCart(productId ? 'product_id' : 'bundle_id', productId || bundleId, button);
            } else {
                console.error('No product or bundle ID found');
            }
        });
    });

    function addToCart(type, id, button) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'backend/add_to_cart.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                handleResponse(xhr.responseText.trim(), button);
            }
        };
        xhr.send(`${type}=${id}`);
    }

    function handleResponse(responseText, button) {
        if (responseText.toLowerCase().includes('added to cart')) {
            button.innerText = 'Added to cart';
            button.classList.add('added');
            setTimeout(() => resetButton(button), 1000);
        } else if (responseText.toLowerCase().includes('already in cart')) {
            button.innerText = 'Already in cart';
            setTimeout(() => resetButton(button), 1000);
        }
    }

    function resetButton(button) {
        button.innerText = 'Add to Cart';
        button.classList.remove('added');
    }
});
