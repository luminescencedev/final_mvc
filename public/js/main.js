
function toCart(productId) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let product = { id: productId, quantity: 1 };

    let existingProduct = cart.find(item => item.id === productId);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push(product);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
}