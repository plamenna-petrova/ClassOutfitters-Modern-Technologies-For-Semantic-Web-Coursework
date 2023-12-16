
const headerNavOption = document.querySelector(".header__nav__option");
const shoppingCartTotalPrice = headerNavOption.querySelector(".price");

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
        const shoppingCartTotal = getShoppingCartTotal(parsedProductsInShoppingCart);

        const checkoutOrderColumnHTML = `
            <div class="col-lg-4 col-md-6">
                <div class="checkout__order">
                    <h4 class="order__title">Your order</h4>
                    <div class="checkout__order__products">Product <span>Total</span></div>
                        <ul class="checkout__total__products">
                            ${parsedProductsInShoppingCart
                                .map((product, index) => `<li>0${index + 1}. ${product.name} <span>$ ${product.total}</span></li>`)
                                .join('')
                            }
                        </ul>
                        <ul class="checkout__total__all">
                            <li>Total For Order <span>$${shoppingCartTotal}</span></li>
                        </ul>
                        <button type="submit" class="site-btn">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        `;

        const checkoutOrderForm = document.querySelector(".checkout__form .col-lg-8.col-md-6");
        checkoutOrderForm.insertAdjacentHTML('afterend', checkoutOrderColumnHTML);

        shoppingCartTotalPrice.textContent = shoppingCartTotal;

        const placeOrderButton = document.querySelector(".checkout__order button");
        console.log(placeOrderButton);

        placeOrderButton.addEventListener('click', (event) => {
            event.preventDefault();
            
            if (validateOrderDetailsInputFields()) {
                fireToast("success", "Order created");

                const doc = new jsPDF();

                const orderHTMLForPDFDocument = `
                    <h2>Order Details</h2>
                    <div class="order-personal-details">
                        ${Array.from(document.querySelectorAll(".checkout__input")).map(orderDetailsInputField => {
                        const inputFieldDescriptiveParagraph = orderDetailsInputField.querySelector("p");
                        const inputValue = orderDetailsInputField.querySelector("input").value;

                        return `
                            <h3>
                                ${inputFieldDescriptiveParagraph.textContent.replace(/[&\\\#,+()$~%.'":*?<>{}]/g, '')}: ${inputValue}
                            </h3>
                            <br />`;
                        }).join('')}
                    </div>
                    <div class="billing-details">
                        <div class="checkout__order__products">Ordered Products:</div>
                        <br />
                        <ul class="checkout__total__products">
                            ${parsedProductsInShoppingCart
                                .map((product, index) => `<li>0${index + 1}. ${product.name} <span>$ ${product.total}</span></li>`)
                                .join('')
                            }
                        </ul>
                        <h3>Total For Order <span>$${shoppingCartTotal}</span></h3>
                    </div>
                    </div>
                `;

                doc.fromHTML(orderHTMLForPDFDocument, 15, 15, {
                    'width': 300
                });

                doc.save('class-outfitter-order.pdf');

                setTimeout(() => {
                    localStorage.removeItem("productsInShoppingCart");
                    window.location.href = 'index.php';
                }, 2000);
            } 
        });
    } else {
        console.log('here');
        window.location.href = 'index.php';
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

const validateOrderDetailsInputFields = () => {
    const orderDetailsInputFields = document.querySelectorAll(".checkout__input");
    
    let areOrderDetailsInputFieldsValid = true;

    for (let i = 0; i < orderDetailsInputFields.length; i++) {
        const inputFieldDescriptiveParagraph = orderDetailsInputFields[i].querySelector("p");
        const input = orderDetailsInputFields[i].querySelector("input");
        const inputMinLength = input.getAttribute("minlength");
        const inputMaxLength = input.getAttribute("maxlength");
        const inputValue = input.value;

        if (inputValue.trim() === '') {
            fireToast(
                "error",
                `${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')} is a required field!`
            );

            areOrderDetailsInputFieldsValid = false;
            break;
        }

        if (inputValue.length < Number(inputMinLength)) {
            fireToast(
                "error",
                `${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')} must be at least ${inputMinLength} symbols`
            );

            areOrderDetailsInputFieldsValid = false;
            break;
        }

        if (inputValue.length > Number(inputMaxLength)) {
            fireToast(
                "error",
                `${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')} cannot be longer than ${inputMaxLength} symbols`
            );
            
            areOrderDetailsInputFieldsValid = false;
            break;
        }
    }

    return areOrderDetailsInputFieldsValid;
}

const fireToast = (icon, title) => Toast.fire({ icon, title });