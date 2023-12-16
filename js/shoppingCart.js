
const headerNavOption = document.querySelector(".header__nav__option");
const shoppingCartTotalPrice = headerNavOption.querySelector(".price");

let productsInShoppingCart = localStorage.getItem("productsInShoppingCart");
let parsedProductsInShoppingCart = JSON.parse(productsInShoppingCart);

const breadCrumbOptionSection = document.querySelector(".breadcrumb-option");

let foundProductInShoppingCart;

window.addEventListener("load", () => {
    productsInShoppingCart = localStorage.getItem("productsInShoppingCart");
    parsedProductsInShoppingCart = JSON.parse(productsInShoppingCart);

    if (parsedProductsInShoppingCart.length) {
        const shoppingCartSectionHTML = `
            <section class="shopping-cart spad">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${parsedProductsInShoppingCart.map(product => `<tr>
                                            <td style="display: none;">${product.number}</td>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="${product.image}" alt="" style="height: 60px; width: 60px;">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>${product.name}</h6>
                                                    <h5>$${product.price}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <span class="fa fa-angle-left dec qtybtn"></span>
                                                    <input type="text" value="1">
                                                    <span class="fa fa-angle-right inc qtybtn"></span>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="cart__price">$ ${product.total}</td>
                                            <td class="cart__close"><i class="fa fa-close"></i></td>
                                        </tr>`).join('')}
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="continue__btn">
                                        <a href="./index.php">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cart__total">
                                <h6>Cart total</h6>
                                <ul>
                                    <li>Total <span>${getShoppingCartTotal(parsedProductsInShoppingCart)}</span></li>
                                </ul>
                                <a href="#" class="primary-btn">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        `;

        breadCrumbOptionSection.insertAdjacentHTML('afterend', shoppingCartSectionHTML);

        const proQuantityElements = document.querySelectorAll(".pro-qty-2");

        proQuantityElements.forEach((proQuantityElement) => {
            const quantityButtons = proQuantityElement.querySelectorAll(".qtybtn");

            quantityButtons.forEach((quantityButton) => {
                quantityButton.addEventListener('click', (event) => {
                    console.log(event.target);
                    const quantityInput = proQuantityElement.querySelector("input");
                    console.log(quantityInput);
                    const currentQuantityInputValue = quantityInput.value;

                    if (quantityButton.classList.contains("inc")) {
                        quantityInput.value = parseFloat(currentQuantityInputValue) + 1;
                    } else {
                        if (currentQuantityInputValue > 1) {
                            quantityInput.value = parseFloat(currentQuantityInputValue) - 1;
                        } else {
                            quantityInput.value = 1;
                        }
                    }
                });
            });
        });

        const removeItemFromShoppingCartIcons = document.querySelectorAll(".cart__close i");

        removeItemFromShoppingCartIcons.forEach((removeItemFromShoppingCartIcon) => {
            console.log(removeItemFromShoppingCart);
            removeItemFromShoppingCartIcon.addEventListener('click', (event) => removeItemFromShoppingCart(event));
        });

        shoppingCartTotalPrice.textContent = getShoppingCartTotal(parsedProductsInShoppingCart);
    } else {
        insertNoProductsInCartAdjacentHTML();
    }
});

const getShoppingCartTotal = (productsInShoppingCart) => {
    if (productsInShoppingCart.length) {
        return productsInShoppingCart
            .map(p => p.total)
            .reduce((accumulator, currentValue) => Number(accumulator) + Number(currentValue));
    } else {
        return '$0.00';
    }
}

const removeItemFromShoppingCart = (event) => {
    const itemInShoppingCartRow = event.target.parentElement.parentElement;
    const tbody = itemInShoppingCartRow.parentElement;
    const itemInShoppingCartDetails = itemInShoppingCartRow.querySelectorAll("td");
    const productNumber = itemInShoppingCartDetails[0].textContent;

    productsInShoppingCart = localStorage.getItem("productsInShoppingCart");
    parsedProductsInShoppingCart = JSON.parse(productsInShoppingCart);

    let filteredProductsInShoppingCart = parsedProductsInShoppingCart.filter(p => p.number !== productNumber);
    tbody.removeChild(itemInShoppingCartRow);

    if (filteredProductsInShoppingCart.length) {
        console.log(filteredProductsInShoppingCart);
        localStorage.setItem("productsInShoppingCart", JSON.stringify([...filteredProductsInShoppingCart]));
    } else {
        localStorage.setItem("productsInShoppingCart", JSON.stringify([]));
        const shoppingCartSection = document.querySelector(".shopping-cart.spad");
        document.body.removeChild(shoppingCartSection);
        shoppingCartTotalPrice.textContent = '$0.00';
        insertNoProductsInCartAdjacentHTML();
    }
}

const insertNoProductsInCartAdjacentHTML = () => {
    breadCrumbOptionSection.insertAdjacentHTML(
        'afterend',
        '<div class="pt-5" style="height: 400px;"><h2 class="text-center">Your shopping cart is currently empty!</h2></div>'
    );
}
