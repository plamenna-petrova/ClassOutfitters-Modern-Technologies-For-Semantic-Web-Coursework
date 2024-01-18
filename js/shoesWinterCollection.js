
import {
    generateFilteredProductsHTML,
    applyFiltersByCategory,
    applyFiltersByBrand,
    applyFiltersByPriceRange,
    applyFiltersBySize,
    applyFiltersByColor,
    applyFiltersByTag,
    applyFiltersBySearchTerm,
    sortProducts
} from "./shopFilters.js";

let fallWinterClothingCollectionColumns = document.querySelectorAll('.product__item__col.fall-winter-clothing-collection');

for (let i = 0; i < fallWinterClothingCollectionColumns.length; i++) {
    fallWinterClothingCollectionColumns[i].remove();
}

let accessoriesFallCollectionColumns = document.querySelectorAll('.product__item__col.accessories-fall-collection');

for (let i = 0; i < accessoriesFallCollectionColumns.length; i++) {
    accessoriesFallCollectionColumns[i].remove();
}

const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");

let paginationItemsColumns = paginatedList.querySelectorAll(".product__item__col");

const shownPaginationResultsParagraph = document.querySelector("div.shop__product__option__left p");

const paginationLimit = 9;

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
        const shoesWinterCollectionName = 'Shoes Winter Collection 2023/2024';
        let breadCrumbLinksSpan = document.querySelector(".breadcrumb__links span");
        breadCrumbLinksSpan.innerHTML = shoesWinterCollectionName;

        applyFiltersByCategory(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
        applyFiltersByBrand(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
        applyFiltersByPriceRange(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
        applyFiltersBySize(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
        applyFiltersByColor(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
        applyFiltersByTag(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);

        applyFiltersBySearchTerm(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);

        sortProducts(displayShoes, classOutfittersXMLDocument, shoesWinterCollectionName);
    })
    .catch((error) => {
        console.log('An error occurred', error);
    })

const displayShoes = (clothingItems) => {
    const filteredProductsHTML = generateFilteredProductsHTML(clothingItems, 'winter-shoes-collection');

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

    if (paginationItemsColumns.length === 0) {
        shownPaginationResultsParagraph.innerHTML = '';
    } else {
        shownPaginationResultsParagraph.innerHTML = `Showing ${previousPagesRange + 1}-` +
            `${nextPagesRange > paginationItemsColumns.length ? paginationItemsColumns.length : nextPagesRange} ` +
            `results out of ${paginationItemsColumns.length}`;
    }
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