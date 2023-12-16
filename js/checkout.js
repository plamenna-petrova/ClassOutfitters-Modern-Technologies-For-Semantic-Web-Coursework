
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

        placeOrderButton.addEventListener('click', (event) => {
            event.preventDefault();
            
            if (validateOrderDetailsInputFields()) {                
                const orderDetailsHiddenSectionHTML = `
                    <section class="shopping-cart spad order-details" style="display: none; width: 800px;">
                        <div class="container">
                            <div class="row">
                                <div class="order-personal-details">
                                    <h3 class="mb-5">Personal Information: </h3>
                                    <br/>
                                    ${Array.from(document.querySelectorAll(".checkout__input"))
                                        .map((orderDetailsInputField) => {
                                            const inputFieldDescriptiveParagraph = orderDetailsInputField.querySelector("p");
                                            const inputValue = orderDetailsInputField.querySelector("input").value;

                                            return `
                                                <h5>
                                                    ${inputFieldDescriptiveParagraph.textContent.replace(/[&\\\#,+()$~%.'":*?<>{}]/g, '')}: ${inputValue}
                                                </h5>
                                                <br />`;
                                        })
                                    .join('')
                                }   
                            </div>
                            <div class="row">
                                <h3 class="mb-5">Billing Details: </h3>
                                <div class="col-lg-12">
                                    <div class="shopping__cart__table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th style="text-align: center;">Size</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${parsedProductsInShoppingCart.map(product => `<tr>
                                                    <td class="product__cart__item">
                                                        <div class="product__cart__item__pic">
                                                            <img src="${product.image}" alt="" style="height: 150px; width: 150px;">
                                                        </div>
                                                        <div class="product__cart__item__text">
                                                            <h6>${product.name}</h6>
                                                            <h5>$${product.price}</h5>
                                                        </div>
                                                    </td>
                                                    <td style="padding: 50px; 0px; text-align: left;">${product.size ? product.size : ''}</td>
                                                    <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <h5>${product.quantity}</h5>
                                                        </div>
                                                    </div>
                                                    </td>
                                                    <td class="cart__price">$ ${product.total}</td>
                                                </tr>`).join('')}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="cart__total">
                                        <h6>Cart total</h6>
                                        <ul>
                                            <li>Total <span>$ ${getShoppingCartTotal(parsedProductsInShoppingCart)}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                `;
                
                const checkoutSection = document.querySelector('.checkout.spad');

                checkoutSection.insertAdjacentHTML('afterend', orderDetailsHiddenSectionHTML);

                const orderDetails = document.querySelector(".order-details");
                orderDetails.style.display = "initial";

                html2canvas(orderDetails, {
                    onrendered: function (canvas) {
                        let jsPDFInstance = new jsPDF('p', 'pt', 'letter');

                        for (let i = 0; i <= orderDetails.clientHeight / 980; i++) {
                            let srcImg = canvas;
                            let sX = 0;
                            let sY = 980 * i;
                            let sWidth = 900;
                            let sHeight = 980;
                            let dX = 0;
                            let dY = 0;
                            let dWidth = 900;
                            let dHeight = 980;

                            window.onePageCanvas = document.createElement("canvas");
                            onePageCanvas.setAttribute('width', 900);
                            onePageCanvas.setAttribute('height', 980);

                            let canvas2DContext = onePageCanvas.getContext('2d');

                            canvas2DContext.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);

                            let canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);

                            let width = onePageCanvas.width;
                            let height = onePageCanvas.clientHeight;

                            if (i > 0) {
                                jsPDFInstance.addPage(612, 791);
                            }

                            jsPDFInstance.setPage(i + 1);
                            jsPDFInstance.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height * .62));
                        }

                        jsPDFInstance.save(`ClassOutfittersOrder_${generateOrderUUID()}.pdf`);

                        document.body.removeChild(orderDetails);

                        fireToast("success", "Order created");

                        setTimeout(() => {
                            localStorage.removeItem("productsInShoppingCart");
                            window.location.href = 'index.php';
                        }, 2000);
                    }
                });
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
                `The ${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}` +
                    ` is a required field!`
            );

            areOrderDetailsInputFieldsValid = false;
            break;
        }

        if (inputValue.length < Number(inputMinLength)) {
            fireToast(
                "error",
                `The ${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}`
                    + ` must be at least ${inputMinLength} symbols`
            );

            areOrderDetailsInputFieldsValid = false;
            break;
        }

        if (inputValue.length > Number(inputMaxLength)) {
            fireToast(
                "error",
                `The ${inputFieldDescriptiveParagraph.textContent.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')}`
                    + `cannot be longer than ${inputMaxLength} symbols`
            );
            
            areOrderDetailsInputFieldsValid = false;
            break;
        }
    }

    return areOrderDetailsInputFieldsValid;
}

const generateOrderUUID = () => { 
    let currentTimeStamp = new Date().getTime();
    let generationPerformance = ((typeof performance !== 'undefined') && performance.now && (performance.now() * 1000)) || 0;

    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        let random = Math.random() * 16;

        if (currentTimeStamp > 0) {
            random = (currentTimeStamp + random) % 16 | 0;
            currentTimeStamp = Math.floor(currentTimeStamp / 16);
        } else {
            random = (generationPerformance + random) % 16 | 0;
            generationPerformance = Math.floor(generationPerformance / 16);
        }

        return (c === 'x' ? random : (random & 0x3 | 0x8)).toString(16);
    });
}

const fireToast = (icon, title) => Toast.fire({ icon, title });