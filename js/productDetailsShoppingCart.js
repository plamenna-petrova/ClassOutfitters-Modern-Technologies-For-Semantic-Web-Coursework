
const addToCartButton = document.querySelector(".product__details__cart__option .primary-btn");

const productDetailsSearchQuery = window.location.search.substring(1);
const productNumber = productDetailsSearchQuery.split('&')[0].split('=')[1];

const headerNavOption = document.querySelector(".header__nav__option");
const shoppingCartTotalPrice = headerNavOption.querySelector(".price");

let productDetailsCartOption = document.querySelector(".product__details__cart__option");

let foundProductInShoppingCart;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    showCloseButton: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

window.addEventListener("load", () => {
    const productsInShoppingCart = localStorage.getItem("productsInShoppingCart");
    const parsedProductsInShoppingCart = JSON.parse(productsInShoppingCart);

    if (parsedProductsInShoppingCart && parsedProductsInShoppingCart.length) {
        foundProductInShoppingCart = parsedProductsInShoppingCart.find(product => product.number === productNumber);

        if (foundProductInShoppingCart) {
            document.querySelector(".pro-qty input").value = foundProductInShoppingCart.quantity;

            const selectedSizeRadioButton = Array.from(productDetailsCartOption.querySelectorAll("input"))
                .find(radioButton =>
                    radioButton.getAttribute("id") && radioButton.getAttribute("id") === foundProductInShoppingCart.size
                );
            
            if (!selectedSizeRadioButton.parentElement.classList.contains("active")) {
                selectedSizeRadioButton.parentElement.classList.add("active");
            }
            
            enableOrDisableAddToCartButton(addToCartButton, false);
        } else {
            enableOrDisableAddToCartButton(addToCartButton, true);
        }

        shoppingCartTotalPrice.textContent = getShoppingCartTotal(parsedProductsInShoppingCart);
    }
});

addToCartButton.addEventListener('click', (event) => {
    event.preventDefault();

    productDetailsCartOption = event.target.parentElement;
    const productDetailsText = productDetailsCartOption.parentElement;

    const selectedAvailableSizeLabel = productDetailsCartOption.querySelector("label.active");

    if (!selectedAvailableSizeLabel) {
        fireToast("error", "Select a size in order to proceed!");
        return;
    }

    const productQuantityInput = productDetailsCartOption.querySelector(".quantity .pro-qty input");
    const productQuantityValue = productQuantityInput.value;
    const productName = productDetailsText.querySelectorAll("h4")[0].textContent;
    const productPrice = productDetailsText.querySelector("h3").textContent.slice(1);
    const selectedAvailableSizeValue = selectedAvailableSizeLabel.getAttribute('for');
    const productDetailsPicItemImg = document.querySelector(".product__details__pic__item img");
    const productImageSrc = productDetailsPicItemImg.getAttribute("src");

    let productToAddToCart = {
        number: productNumber,
        name: productName,
        price: Number(productPrice).toFixed(2),
        size: selectedAvailableSizeValue,
        quantity: Number(productQuantityValue),
        total: (Number(productPrice) * Number(productQuantityValue)).toFixed(2),
        image: productImageSrc
    }

    const currentProductsInShoppingCart = localStorage.getItem("productsInShoppingCart");

    if (currentProductsInShoppingCart !== null) {
        const parsedCurrentProductsInShoppingCart = JSON.parse(currentProductsInShoppingCart);
        foundProductInShoppingCart = parsedCurrentProductsInShoppingCart.find(product => product.number === productNumber);

        if (!foundProductInShoppingCart) {
            let updatedProductsInShoppingCart = [...parsedCurrentProductsInShoppingCart, productToAddToCart];
            localStorage.setItem("productsInShoppingCart", JSON.stringify(updatedProductsInShoppingCart));
            shoppingCartTotalPrice.textContent = getShoppingCartTotal(updatedProductsInShoppingCart);
            enableOrDisableAddToCartButton(event.target, false);
            fireToast("success", "Product successfully added to shopping cart!");
        }
    } else {
        localStorage.setItem("productsInShoppingCart", JSON.stringify([productToAddToCart]));
        shoppingCartTotalPrice.textContent = Number(productToAddToCart.total).toFixed(2);
        enableOrDisableAddToCartButton(event.target, false);
        fireToast("success", "Product successfully added to shopping cart!");
    }
});

const enableOrDisableAddToCartButton = (anchorElement, active) => {
    if (anchorElement) {
        if (active) {
            anchorElement.style.pointerEvents = 'auto';
            anchorElement.style.cursor = 'pointer';
            anchorElement.style.background = 'black';
        } else {
            anchorElement.style.pointerEvents = 'none';
            anchorElement.style.cursor = 'default';
            anchorElement.style.background = 'grey';
        }
    }
}

const getShoppingCartTotal = (productsInShoppingCart) => {
    if (productsInShoppingCart.length) {
        const shoppingCartTotal = productsInShoppingCart
            .map(p => p.total)
            .reduce((accumulator, currentValue) => Number(accumulator) + Number(currentValue));
        
        return Number(shoppingCartTotal).toFixed(2);
    } else {
        return '$0.00';
    }
}

const fireToast = (icon, title) => Toast.fire({ icon, title });