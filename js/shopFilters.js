
const UPPERCASE_ALPHABET_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

const LOWERCASE_ALPHABET_LETTERS = 'abcdefghijklmnopqrstuvwxyz';

export const applyFiltersByCategory = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarCategoriesDiv = document.querySelector(".shop__sidebar__categories");
    shopSidebarCategoriesDiv.innerHTML = createProductCategoriesUnorderedList(xmlDocument, collectionName);

    shopSidebarCategoriesDiv.querySelector("ul").addEventListener("click", (event) => {
        event.preventDefault();

        const categoriesLinks = Array.from(shopSidebarCategoriesDiv.querySelectorAll("ul li a"))
            .filter(a => a !== event.target);

        for (const categoryLink of categoriesLinks) {
            removeActiveClass(categoryLink);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersByBrand = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarBrandDiv = document.querySelector(".shop__sidebar__brand");
    shopSidebarBrandDiv.innerHTML = createProductBrandsUnorderedList(xmlDocument, collectionName);

    shopSidebarBrandDiv.querySelector("ul").addEventListener("click", (event) => {
        event.preventDefault();

        const brandsLinks = Array.from(shopSidebarBrandDiv.querySelectorAll("ul li a"))
            .filter(a => a !== event.target);

        for (const brandLink of brandsLinks) {
            removeActiveClass(brandLink);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersByPriceRange = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarPriceDiv = document.querySelector(".shop__sidebar__price");

    shopSidebarPriceDiv.querySelector("ul").addEventListener("click", (event) => {
        event.preventDefault();

        const pricesLinks = Array.from(shopSidebarPriceDiv.querySelectorAll("ul li a"))
            .filter(a => a !== event.target);

        for (const priceLink of pricesLinks) {
            removeActiveClass(priceLink);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersBySize = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarSizeDiv = document.querySelector(".shop__sidebar__size");
    shopSidebarSizeDiv.innerHTML = createProductSizesLabels(xmlDocument, collectionName);

    shopSidebarSizeDiv.addEventListener("click", (event) => {
        event.preventDefault();

        const sizesLabels = Array.from(shopSidebarSizeDiv.querySelectorAll("label")).filter(lbl => lbl !== event.target);

        for (const sizeLabel of sizesLabels) {
            removeActiveClass(sizeLabel);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersByColor = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarColorDiv = document.querySelector(".shop__sidebar__color");
    shopSidebarColorDiv.innerHTML = createProductColorsLabels(xmlDocument, collectionName);

    shopSidebarColorDiv.addEventListener("click", (event) => {
        event.preventDefault();

        const colorsLabels = Array.from(shopSidebarColorDiv.querySelectorAll("label")).filter(lbl => lbl !== event.target);

        for (const colorLabel of colorsLabels) {
            removeActiveClass(colorLabel);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersByTag = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarTagsDiv = document.querySelector(".shop__sidebar__tags");
    shopSidebarTagsDiv.innerHTML = createProductTagsLinks(xmlDocument, collectionName);

    shopSidebarTagsDiv.addEventListener("click", (event) => {
        event.preventDefault();

        const tagsLinks = Array.from(shopSidebarTagsDiv.querySelectorAll("a")).filter(a => a !== event.target);

        for (const tagLink of tagsLinks) {
            removeActiveClass(tagLink);
        }

        toggleHTMLElementActiveClass(event.target);

        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName }));
    });
}

export const applyFiltersBySearchTerm = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopSidebarSearchForm = document.querySelector(".shop__sidebar__search form");

    shopSidebarSearchForm.addEventListener("submit", (event) => {
        event.preventDefault();
        const eventTargetInput = event.target.querySelector("input");
        displayProductsCallback(filterProductsWithXPathExpression({ xmlDocument, collectionName, searchTerm: eventTargetInput.value }));
    });
}

export const sortProducts = (displayProductsCallback, xmlDocument, collectionName) => {
    const shopProductOptionRight = document.querySelector(".shop__product__option__right");
    const sortProductsByPriceSelect = shopProductOptionRight.querySelector(".nice-select");
    const shopSidebarSearchForm = document.querySelector(".shop__sidebar__search form");
    const searchTermInput = shopSidebarSearchForm.querySelector("input");

    sortProductsByPriceSelect.addEventListener("click", (event) => {
        event.preventDefault();
        displayProductsCallback(filterProductsWithXPathExpression({
            xmlDocument, collectionName, searchTerm: searchTermInput.value, sortingOption: event.target.textContent
        }));
    });
}

export const filterProductsWithXPathExpression = ({ xmlDocument, collectionName, searchTerm, sortingOption }) => {
    let baseXPathClothingExpression = `//collection[@name='${collectionName}']/product`;
    let xpathClothingFilteringExpression = baseXPathClothingExpression;

    const activeProductCategoryLink = document.querySelector(".shop__sidebar__categories ul li a.active");

    if (activeProductCategoryLink) {
        xpathClothingFilteringExpression += `[@category='${activeProductCategoryLink.textContent}'`;
    }

    const activeProductBrandLink = document.querySelector(".shop__sidebar__brand ul li a.active");

    if (activeProductBrandLink) {
        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            xpathClothingFilteringExpression += `[brand='${activeProductBrandLink.textContent}'`;
        } else {
            xpathClothingFilteringExpression += ` and brand='${activeProductBrandLink.textContent}'`;
        }
    }

    const activeProductPriceLink = document.querySelector(".shop__sidebar__price ul li a.active");

    if (activeProductPriceLink) {
        const priceRange = activeProductPriceLink.textContent.split('-').map(el => el.trim().slice(1));

        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            if (!priceRange[1]) {
                xpathClothingFilteringExpression += `[price>=${priceRange[0].replace('+', '')}`;
            } else {
                xpathClothingFilteringExpression += `[price>=${priceRange[0]} and price<=${priceRange[1]}`;
            }
        } else {
            if (!priceRange[1]) {
                xpathClothingFilteringExpression += ` and price>=${priceRange[0].replace('+', '')}`;
            } else {
                xpathClothingFilteringExpression += ` and price>=${priceRange[0]} and price<=${priceRange[1]}`;
            }
        }
    }

    const activeProductSizeLabel = document.querySelector(".shop__sidebar__size label.active");

    if (activeProductSizeLabel) {
        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            xpathClothingFilteringExpression +=
                `[availableSizes/size='${activeProductSizeLabel.querySelector("input").getAttribute('id')}'`;
        } else {
            xpathClothingFilteringExpression +=
                ` and availableSizes/size='${activeProductSizeLabel.querySelector("input").getAttribute('id')}'`;
        }
    }

    const activeProductColorLabel = document.querySelector(".shop__sidebar__color label.active");

    if (activeProductColorLabel) {
        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            xpathClothingFilteringExpression +=
                `[color='${activeProductColorLabel.querySelector("input").getAttribute('id')}'`;
        } else {
            xpathClothingFilteringExpression +=
                ` and color='${activeProductColorLabel.querySelector("input").getAttribute('id')}'`;
        }
    }

    const activeProductTagLink = document.querySelector(".shop__sidebar__tags a.active");

    if (activeProductTagLink) {
        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            xpathClothingFilteringExpression += `[tag='${activeProductTagLink.textContent}'`;
        } else {
            xpathClothingFilteringExpression += ` and tag='${activeProductTagLink.textContent}'`;
        }
    }

    if (searchTerm) {
        if (xpathClothingFilteringExpression.length === baseXPathClothingExpression.length) {
            xpathClothingFilteringExpression += `[name[contains(translate(., '${UPPERCASE_ALPHABET_LETTERS}', '${LOWERCASE_ALPHABET_LETTERS}'), '${searchTerm}')]`;
        } else {
            xpathClothingFilteringExpression += ` and name[contains(translate(., '${UPPERCASE_ALPHABET_LETTERS}', '${LOWERCASE_ALPHABET_LETTERS}'), '${searchTerm}')]`;
        }
    }

    if (xpathClothingFilteringExpression.length !== baseXPathClothingExpression.length) {
        xpathClothingFilteringExpression += ']';
    }

    const filteredProductsByCategoryXPathResult = document.evaluate(
        xpathClothingFilteringExpression,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let filteredProducts = [];

    for (let i = 0; i < filteredProductsByCategoryXPathResult.snapshotLength; i++) {
        const filteredProductSnapshotItem = filteredProductsByCategoryXPathResult.snapshotItem(i);
        filteredProducts.push(filteredProductSnapshotItem);
    }

    const shopProductOptionRight = document.querySelector(".shop__product__option__right");
    const currentlySelectedSortingOption = shopProductOptionRight.querySelector(".nice-select .current");

    if (sortingOption) {
        sortingOption = sortingOption.slice(0, 11).trim();
    } else {
        sortingOption = currentlySelectedSortingOption.textContent;
    }

    switch (sortingOption) {
        case "Low To High":
            filteredProducts = filteredProducts.sort((a, b) =>
                parseFloat(a.getElementsByTagName("price")[0].textContent) - parseFloat(b.getElementsByTagName("price")[0].textContent)
            );
            break;
        case "High To Low":
            filteredProducts = filteredProducts.sort((a, b) =>
                parseFloat(b.getElementsByTagName("price")[0].textContent) - parseFloat(a.getElementsByTagName("price")[0].textContent)
            );
            break;
    }

    return filteredProducts;
}

export const generateFilteredProductsHTML = (products, collectionClassName) => {
    return products.map(product =>
        `<div class="col-lg-4 col-md-6 col-sm-6 product__item__col ${collectionClassName}">
                <div class="product__item">
                    <div class="product__item__pic set-bg" 
                        data-setbg="${product.getElementsByTagName("images")[0].getElementsByTagName("modelCenterImage")[0].textContent}"
                        style="background-image: url(&quot;${product.getElementsByTagName("images")[0].getElementsByTagName("modelCenterImage")[0].textContent}&quot;);">
                        ${product.getElementsByTagName('tag')[0].textContent !== 'regular'
                            ? `<span class="label">${product.getElementsByTagName('tag')[0].textContent}</span>` : ''
                        }
                        <ul class="product__hover">
                            <li>
                                <form method="get" action="shop-details.php">
                                    <input type="hidden" name="productNumber" value="${product.getAttribute('number')}" />
                                        <input type="hidden" name="productCategory" value="${product.getAttribute('category')}" />
                                        <button type="submit">
                                            <img src="img/icon/search.png" alt="" />
                                        </button>
                                 </form>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>${product.getElementsByTagName('name')[0].textContent}</h6>
                        <a href="#" class="add-cart">+ Add To Cart</a>
                        <h5>${product.getElementsByTagName('price')[0].textContent}</h5>
                    </div>
                </div>
            </div>`
    ).join('');
}

export const createProductCategoriesUnorderedList = (xmlDocument, collectionName) => {
    const productCategoriesXPathResult = document.evaluate(
        `//collection[@name='${collectionName}']/product/@category`,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let productCategories = [];

    for (let i = 0; i < productCategoriesXPathResult.snapshotLength; i++) {
        const productCategorySnapshotItem = productCategoriesXPathResult.snapshotItem(i);

        if (!productCategories.includes(productCategorySnapshotItem.textContent)) {
            productCategories.push(productCategorySnapshotItem.textContent);
        }
    }

    return `<ul class="nice-scroll">
                ${productCategories.map(productCategory => `<li><a href="#">${productCategory}</a></li>`).join('')}
            </ul>`;
}

export const createProductBrandsUnorderedList = (xmlDocument, collectionName) => {
    const productBrandsXPathResult = document.evaluate(
        `//collection[@name='${collectionName}']/product/brand`,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let productBrands = [];

    for (let i = 0; i < productBrandsXPathResult.snapshotLength; i++) {
        const productBrandSnapshotItem = productBrandsXPathResult.snapshotItem(i);

        if (!productBrands.includes(productBrandSnapshotItem.textContent)) {
            productBrands.push(productBrandSnapshotItem.textContent);
        }
    }

    return `<ul class="nice-scroll">
                ${productBrands.map(productBrand => `<li><a href="#">${productBrand}</a></li>`).join('')}
            </ul>`;
}

export const createProductSizesLabels = (xmlDocument, collectionName) => {
    const productSizesXPathResult = document.evaluate(
        `//collection[@name='${collectionName}']/product/availableSizes/size`,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let productSizes = [];

    for (let i = 0; i < productSizesXPathResult.snapshotLength; i++) {
        const productSizeSnapshotItem = productSizesXPathResult.snapshotItem(i);

        if (!productSizes.includes(productSizeSnapshotItem.textContent)) {
            productSizes.push(productSizeSnapshotItem.textContent);
        }
    }

    return `${productSizes
        .map(productSize =>
            `<label for="${productSize}">${productSize}
                <input type="radio" id="${productSize}" />
            </label>`)
        .join('')}`;
}

export const createProductColorsLabels = (xmlDocument, collectionName) => {
    const productColorsXPathResult = document.evaluate(
        `//collection[@name='${collectionName}']/product/color`,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let productColors = [];

    for (let i = 0; i < productColorsXPathResult.snapshotLength; i++) {
        const productColorSnapshotItem = productColorsXPathResult.snapshotItem(i);

        if (!productColors.includes(productColorSnapshotItem.textContent)) {
            productColors.push(productColorSnapshotItem.textContent);
        }
    }

    return `${productColors
        .map(productColor => `
            <label for="${productColor}" style="background-color: ${productColor};">
                <input type="radio" id="${productColor}" />
            </label>`
        )
        .join('')}`;
}

export const createProductTagsLinks = (xmlDocument, collectionName) => {
    const productTagsXPathResult = document.evaluate(
        `//collection[@name='${collectionName}']/product/tag`,
        xmlDocument,
        null,
        XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,
        null
    );

    let productTags = [];

    for (let i = 0; i < productTagsXPathResult.snapshotLength; i++) {
        const productTagSnapshotItem = productTagsXPathResult.snapshotItem(i);

        if (!productTags.includes(productTagSnapshotItem.textContent)) {
            productTags.push(productTagSnapshotItem.textContent);
        }
    }

    return `${productTags.map(productTag => `<a href="#">${productTag}</a>`).join('')}`;
}

export const removeActiveClass = (targetElement) => {
    if (targetElement.classList.contains("active")) {
        targetElement.classList.remove("active");
    }
}

export const toggleHTMLElementActiveClass = (targetElement) => {
    if (!targetElement.classList.contains("active")) {
        targetElement.classList.add("active");
    } else {
        targetElement.classList.remove("active");
    }
}