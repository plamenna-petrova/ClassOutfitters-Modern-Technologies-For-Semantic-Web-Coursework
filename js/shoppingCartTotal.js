
const headerNavOption = document.querySelector(".header__nav__option");
const shoppingCartTotalPrice = headerNavOption.querySelector(".price");

window.addEventListener("load", () => {
    const productsInShoppingCart = localStorage.getItem("productsInShoppingCart");
    const parsedProductsInShoppingCart = JSON.parse(productsInShoppingCart);

    if (parsedProductsInShoppingCart && parsedProductsInShoppingCart.length) {
        shoppingCartTotalPrice.textContent = getShoppingCartTotal(parsedProductsInShoppingCart);
    }
});

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