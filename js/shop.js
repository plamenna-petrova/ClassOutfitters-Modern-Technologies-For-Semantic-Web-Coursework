// pagination logic

const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");
const paginationItemsColumns = paginatedList.querySelectorAll(".product__item__col");
const shownPaginationResultsParagraph = document.querySelector("div.shop__product__option__left p");

const paginationLimit = 12;
const pagesCount = Math.ceil(paginationItemsColumns.length / paginationLimit);

let currentPage = 1;

window.addEventListener("load", () => {
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
});

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
        `${nextPagesRange > paginationItemsColumns.length ? paginationItemsColumns.length : nextPagesRange } ` +
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