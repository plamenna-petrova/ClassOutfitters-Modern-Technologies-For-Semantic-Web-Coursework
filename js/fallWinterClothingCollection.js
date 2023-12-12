
import {
    generateFilteredProductsHTML,
    applyFiltersByCategory,
    applyFiltersByBrand,
    applyFiltersByPriceRange,
    applyFiltersBySize,
    applyFiltersByColor,
    applyFiltersByTag
} from "./filtersHelperFunctions.js";

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

        applyFiltersByCategory(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
        applyFiltersByBrand(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
        applyFiltersByPriceRange(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
        applyFiltersBySize(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
        applyFiltersByColor(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
        applyFiltersByTag(displayClothing, classOutfittersXMLDocument, fallWinterClothingCollectionName);
    })
    .catch((error) => {
        console.log('An error occurred', error);
    })

const displayClothing = (clothingItems) => {
    const filteredProductsHTML = generateFilteredProductsHTML(clothingItems, 'fall-winter-clothing-collection');

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