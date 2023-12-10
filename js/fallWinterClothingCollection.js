
let shoesWinterCollectionColumns = document.querySelectorAll('.product__item__col.shoes-winter-collection');

for (let i = 0; i < shoesWinterCollectionColumns.length; i++) {
    shoesWinterCollectionColumns[i].remove();
}

let accessoriesFallCollectionColumns = document.querySelectorAll('.product__item__col.accessories-fall-collection');

for (let i = 0; i < accessoriesFallCollectionColumns.length; i++) {
    accessoriesFallCollectionColumns[i].remove();
}

const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");

let paginationItemsColumns = paginatedList.querySelectorAll(".product__item__col");

const shownPaginationResultsParagraph = document.querySelector("div.shop__product__option__left p");

const paginationLimit = 12;

let pagesCount = Math.ceil(paginationItemsColumns.length / paginationLimit);
let currentPage = 1;

window.addEventListener("load", () => {
    loadPagination();
});

fetch('./xml/class-outfitters.xml')
    .then(response => {
        if (!response.ok) {
            throw new Error('Error fetching class-outfitters.xml');
        }

        return response.text();
    })
    .then(classOutfittersXMLString => {
        const classOutfittersXMLDocument = new DOMParser().parseFromString(classOutfittersXMLString, "application/xml");
        const fallWinterClothingCollectionName = 'Fall-Winter Clothing Collection 2023/2024';

        const productCategoriesXPathResult = document.evaluate(
            `//collection[@name='${fallWinterClothingCollectionName}']/product/@category`,
            classOutfittersXMLDocument,
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

        const productCategoriesUnorderedList = `
                <ul class="nice-scroll">
                    ${productCategories.map(productCategory => `<li><a href="#">${productCategory}</a></li>`).join('')}
                </ul>
            `;

        const shopSidebarCategoriesDiv = document.querySelector(".shop__sidebar__categories");
        shopSidebarCategoriesDiv.innerHTML = productCategoriesUnorderedList;

        shopSidebarCategoriesDiv.querySelector("ul").addEventListener("click", (event) => {
            event.preventDefault();

            const categoriesLinks = Array.from(shopSidebarCategoriesDiv.querySelectorAll("ul li a"))
                .filter(a => a !== event.target);

            for (const categoryLink of categoriesLinks) {
                if (categoryLink.classList.contains("active")) {
                    categoryLink.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });

        const productBrandsXPathResult = document.evaluate(
            `//collection[@name='${fallWinterClothingCollectionName}']/product/brand`,
            classOutfittersXMLDocument,
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

        const productBrandsUnorderedList = `
                <ul class="nice-scroll">
                    ${productBrands.map(productBrand => `<li><a href="#">${productBrand}</a></li>`).join('')}
                </ul>
            `;

        const shopSidebarBrandDiv = document.querySelector(".shop__sidebar__brand");
        shopSidebarBrandDiv.innerHTML = productBrandsUnorderedList;

        shopSidebarBrandDiv.querySelector("ul").addEventListener("click", (event) => {
            event.preventDefault();

            const brandsLinks = Array.from(shopSidebarBrandDiv.querySelectorAll("ul li a"))
                .filter(a => a !== event.target);

            for (const brandLink of brandsLinks) {
                if (brandLink.classList.contains("active")) {
                    brandLink.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });

        const shopSidebarPriceDiv = document.querySelector(".shop__sidebar__price");

        shopSidebarPriceDiv.querySelector("ul").addEventListener("click", (event) => {
            event.preventDefault();

            const pricesLinks = Array.from(shopSidebarPriceDiv.querySelectorAll("ul li a"))
                .filter(a => a !== event.target);
            
            for (const priceLink of pricesLinks) {
                if (priceLink.classList.contains("active")) {
                    priceLink.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });

        const productSizesXPathResult = document.evaluate(
            `//collection[@name='${fallWinterClothingCollectionName}']/product/availableSizes/size`,
            classOutfittersXMLDocument,
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

        const productSizesLabels = `
                ${productSizes.
                map(productSize => `
                        <label for="${productSize}">${productSize}
                            <input type="radio" id="${productSize}" />
                        </label>`
                )
                .join('')
            }
            `;

        const shopSidebarSizeDiv = document.querySelector(".shop__sidebar__size");
        shopSidebarSizeDiv.innerHTML = productSizesLabels;

        shopSidebarSizeDiv.addEventListener("click", (event) => {
            event.preventDefault();

            const sizesLabels = Array.from(shopSidebarSizeDiv.querySelectorAll("label")).filter(lbl => lbl !== event.target);

            for (const sizeLabel of sizesLabels) {
                if (sizeLabel.classList.contains("active")) {
                    sizeLabel.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });

        const productColorsXPathResult = document.evaluate(
            `//collection[@name='${fallWinterClothingCollectionName}']/product/color`,
            classOutfittersXMLDocument,
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

        const productColorsLabels = `
                ${productColors
                .map(productColor => `
                        <label for="${productColor}" style="background-color: ${productColor};">
                            <input type="radio" id="${productColor}" />
                        </label>`
                )
                .join('')
            }
            `;

        const shopSidebarColorDiv = document.querySelector(".shop__sidebar__color");
        shopSidebarColorDiv.innerHTML = productColorsLabels;

        shopSidebarColorDiv.addEventListener("click", (event) => {
            event.preventDefault();

            const colorsLabels = Array.from(shopSidebarColorDiv.querySelectorAll("label")).filter(lbl => lbl !== event.target);

            for (const colorLabel of colorsLabels) {
                if (colorLabel.classList.contains("active")) {
                    colorLabel.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });

        const productTagsXPathResult = document.evaluate(
            `//collection[@name='${fallWinterClothingCollectionName}']/product/tag`,
            classOutfittersXMLDocument,
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

        const productTagsLinks = `${productTags.map(productTag => `<a href="#">${productTag}</a>`).join('')}`;

        const shopSidebarTagsDiv = document.querySelector(".shop__sidebar__tags");
        shopSidebarTagsDiv.innerHTML = productTagsLinks;

        shopSidebarTagsDiv.addEventListener("click", (event) => {
            event.preventDefault();

            const tagsLinks = Array.from(shopSidebarTagsDiv.querySelectorAll("a")).filter(a => a !== event.target);

            for (const tagLink of tagsLinks) {
                if (tagLink.classList.contains("active")) {
                    tagLink.classList.remove("active");
                }
            }

            if (!event.target.classList.contains("active")) {
                event.target.classList.add("active");
            } else {
                event.target.classList.remove("active");
            }

            filterClothing(classOutfittersXMLDocument, fallWinterClothingCollectionName);
        });
    })
    .catch((error) => {
        console.log('An error occurred', error);
    })

const filterClothing = (xmlDocument, collectionName) => {
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
                xpathClothingFilteringExpression += ` and price>=${priceRange[0]} and price<=${priceRange[1]}'`;
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

    displayClothing(filteredProducts);
}

const displayClothing = (products) => {
    const filteredProductsHTML = products.map(product =>
        `<div class="col-lg-4 col-md-6 col-sm-6 product__item__col fall-winter-clothing-collection">
                <div class="product__item">
                    <div class="product__item__pic set-bg" 
                        data-setbg="${product.getElementsByTagName("images")[0].getElementsByTagName("modelCenterImage")[0].textContent}"
                        style="background-image: url(&quot;${product.getElementsByTagName("images")[0].getElementsByTagName("modelCenterImage")[0].textContent}&quot;);">
                        ${product.getElementsByTagName('tag')[0].textContent !== 'regular'
                            ? `<span class="label">${product.getElementsByTagName('tag')[0].textContent}</span>`
                            : ''
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

    document.querySelector("#paginated-list").innerHTML = filteredProductsHTML !== ''
        ? filteredProductsHTML
        : `<h2>No products found, corresponding to the chosen filters</h2>`;

    document.getElementById("pagination-numbers").innerHTML = '';

    paginationItemsColumns = paginatedList.querySelectorAll(".product__item__col");
    pagesCount = Math.ceil(paginationItemsColumns.length / paginationLimit);

    loadPagination();
}

const loadPagination = () => {
    getPaginationNumbers();
    setCurrentPage(1);

    document.querySelectorAll(".pagination-number").forEach((button) => {
        const pageIndex = Number(button.getAttribute("page-index"));

        if (pageIndex) {
            button.addEventListener("click", () => {
                setCurrentPage(pageIndex);
            });
        }
    });
}

const appendPageNumber = (index) => {
    const pageNumber = document.createElement("a");
    pageNumber.className = "pagination-number";
    pageNumber.innerHTML = index;
    pageNumber.setAttribute("page-index", index);
    pageNumber.setAttribute("aria-label", `Page ${index}`);
    paginationNumbers.appendChild(pageNumber);
}

const getPaginationNumbers = () => {
    for (let i = 1; i <= pagesCount; i++) {
        appendPageNumber(i);
    }
}

const setCurrentPage = (pageNumber) => {
    currentPage = pageNumber;

    handleActivePageNumber();

    const previousPagesRange = (pageNumber - 1) * paginationLimit;
    const nextPagesRange = pageNumber * paginationLimit;

    paginationItemsColumns.forEach((paginationListItem, index) => {
        paginationListItem.classList.add("hidden");

        if (index >= previousPagesRange && index < nextPagesRange) {
            paginationListItem.classList.remove("hidden");
        }
    });

    shownPaginationResultsParagraph.innerHTML = `Showing ${previousPagesRange + 1}-` +
        `${nextPagesRange > paginationItemsColumns.length ? paginationItemsColumns.length : nextPagesRange} ` +
        `results out of ${paginationItemsColumns.length}`;
}

const handleActivePageNumber = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
        button.classList.remove("active");
        const pageIndex = Number(button.getAttribute("page-index"));

        if (pageIndex === currentPage) {
            button.classList.add("active");
        }
    });
}