<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?=$router->generate('home')?>">Home</a></li>
            <li class="breadcrumb-item active">Panier</li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Panier</h1>
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <p class="lead text-muted">Vous avez <span id="cart-count">0</span> produits dans votre panier</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-9">
                <div class="cart">
                    <div class="cart-wrapper">
                        <div class="cart-header text-center">
                            <div class="row">
                                <div class="col-5">Produit</div>
                                <div class="col-2">Prix</div>
                                <div class="col-2">Quantité</div>
                                <div class="col-2">Total</div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                        <div class="cart-body" id="cart-items">
                            <!-- Cart items will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="block mb-5">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0">Récapitulatif</h6>
                    </div>
                    <div class="block-body bg-light pt-1">
                        <ul class="order-summary mb-0 list-unstyled">
                            <li class="order-summary-item"><span>Sous total</span><span id="subtotal">0€</span></li>
                            <li class="order-summary-item"><span>Livraison</span><span id="shipping">0€</span></li>
                            <li class="order-summary-item"><span>TVA</span><span id="tax">0€</span></li>
                            <li class="order-summary-item border-0"><span>Total</span><strong class="order-summary-total" id="total">0€</strong></li>
                        </ul>
                    </div>
                </div>
                <div class="my-5 d-flex justify-content-between flex-column flex-lg-row">
                    <a href="<?=$router->generate('catalog-category', ['id' => 1])?>" class="btn btn-link text-muted">
                        <i class="fa fa-chevron-left"></i> Continuer les achats
                    </a>
                    <a href="/" class="btn btn-dark">
                        Commander <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const subtotal = document.getElementById('subtotal');
    const shipping = document.getElementById('shipping');
    const tax = document.getElementById('tax');
    const total = document.getElementById('total');

    const products = <?= json_encode($viewData['products']) ?>;

    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItems.innerHTML = '';
        let subtotalValue = 0;
        let itemCount = 0;

        cart.forEach(item => {
            const product = products.find(p => p.id == item.id);
            if (product) {
                const itemTotal = product.price * item.quantity;
                subtotalValue += itemTotal;
                itemCount += item.quantity;

                const cartItemHtml = `
                    <div class="cart-item" data-id="${item.id}">
                        <div class="row d-flex align-items-center text-center">
                            <div class="col-5">
                                <div class="d-flex align-items-center">
                                    <a href="/catalogue/produit/${item.id}">
                                        <img src="${product.picture}" alt="product" class="cart-item-img">
                                    </a>
                                    <div class="cart-title text-left">
                                        <a href="/catalogue/produit/${item.id}" class="text-uppercase text-dark">
                                            <strong>${product.name}</strong>
                                        </a>
                                        <br>
                                        <span class="text-muted text-sm">Quantité : <span class="item-quantity">${item.quantity}</span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">${product.price}€</div>
                            <div class="col-2">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-items btn-items-decrease">-</button>
                                    <input value="${item.quantity}" class="form-control text-center input-items" type="text">
                                    <button class="btn btn-items btn-items-increase">+</button>
                                </div>
                            </div>
                            <div class="col-2 text-center item-total">${itemTotal.toFixed(2)}€</div>
                            <div class="col-1 text-center">
                                <button class="btn btn-danger btn-sm cart-remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                cartItems.insertAdjacentHTML('beforeend', cartItemHtml);
            } else {
                console.log('Product not found for ID:', item.id);
            }
        });

        subtotal.textContent = subtotalValue.toFixed(2) + '€';
        const shippingValue = parseFloat(shipping.textContent.replace('€', ''));
        const taxValue = parseFloat(tax.textContent.replace('€', ''));
        const totalValue = subtotalValue + shippingValue + taxValue;
        total.textContent = totalValue.toFixed(2) + '€';
        cartCount.textContent = itemCount;
    }

    cartItems.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-items-decrease')) {
            updateQuantity(event.target, -1);
        } else if (event.target.classList.contains('btn-items-increase')) {
            updateQuantity(event.target, 1);
        } else if (event.target.classList.contains('cart-remove')) {
            removeItem(event.target);
        }
    });

    function updateQuantity(button, change) {
        const cartItem = button.closest('.cart-item');
        const quantityInput = cartItem.querySelector('.input-items');
        let quantity = parseInt(quantityInput.value) + change;
        if (quantity < 1) quantity = 1;
        quantityInput.value = quantity;
        cartItem.querySelector('.item-quantity').textContent = quantity;
        saveCart();
        loadCart();
    }

    function removeItem(button) {
        const cartItem = button.closest('.cart-item');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const updatedCart = cart.filter(item => item.id != cartItem.dataset.id);
        localStorage.setItem('cart', JSON.stringify(updatedCart));
        loadCart();
    }

    function saveCart() {
        const cart = [];
        cartItems.querySelectorAll('.cart-item').forEach(item => {
            const id = item.dataset.id;
            const quantity = parseInt(item.querySelector('.input-items').value);
            cart.push({ id, quantity });
        });
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    loadCart();
});
</script>