<?php
require_once '../includes/session-init.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/items.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>TawTaw/home-l</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container" id="search-section">
        <h2 class="grey">Search Item</h2>
        <div class="container">
            <input class="search" type="text">
            <div class="icon-holder">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="pointer"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M16.6 18L10.3 11.7C9.8 12.1 9.225 12.4167 8.575 12.65C7.925 12.8833 7.23333 13 6.5 13C4.68333 13 3.146 12.3707 1.888 11.112C0.63 9.85333 0.000667196 8.316 5.291e-07 6.5C-0.000666137 4.684 0.628667 3.14667 1.888 1.888C3.14733 0.629333 4.68467 0 6.5 0C8.31533 0 9.853 0.629333 11.113 1.888C12.373 3.14667 13.002 4.684 13 6.5C13 7.23333 12.8833 7.925 12.65 8.575C12.4167 9.225 12.1 9.8 11.7 10.3L18 16.6L16.6 18ZM6.5 11C7.75 11 8.81267 10.5627 9.688 9.688C10.5633 8.81333 11.0007 7.75067 11 6.5C10.9993 5.24933 10.562 4.187 9.688 3.313C8.814 2.439 7.75133 2.00133 6.5 2C5.24867 1.99867 4.18633 2.43633 3.313 3.313C2.43967 4.18967 2.002 5.252 2 6.5C1.998 7.748 2.43567 8.81067 3.313 9.688C4.19033 10.5653 5.25267 11.0027 6.5 11Z"
                        fill="#C4C4C4" />
                </svg>
            </div>
        </div>
    </div>
    <div id="shop">
        <div class="container">
            <div class="left-shop" id="left-shop-title">
                <h2>Filters</h2><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.9999 12V19.88C14.0399 20.18 13.9399 20.5 13.7099 20.71C13.6174 20.8027 13.5075 20.8763 13.3865 20.9264C13.2655 20.9766 13.1359 21.0024 13.0049 21.0024C12.8739 21.0024 12.7442 20.9766 12.6233 20.9264C12.5023 20.8763 12.3924 20.8027 12.2999 20.71L10.2899 18.7C10.1809 18.5933 10.098 18.4629 10.0477 18.319C9.99739 18.175 9.98103 18.0213 9.99989 17.87V12H9.96989L4.20989 4.62C4.0475 4.41153 3.97422 4.14726 4.00607 3.88493C4.03793 3.6226 4.17232 3.38355 4.37989 3.22C4.56989 3.08 4.77989 3 4.99989 3H18.9999C19.2199 3 19.4299 3.08 19.6199 3.22C19.8275 3.38355 19.9618 3.6226 19.9937 3.88493C20.0256 4.14726 19.9523 4.41153 19.7899 4.62L14.0299 12H13.9999Z"
                        fill="#C4C4C4" />
                </svg>
            </div>
            <div class="right-shop" id="right-shop-title">
                <h2>Search Results <span class="grey">(123)</span></h2>
                <select name="Tri" id="Tri">
                    <option value="Price(Down)">Price(Down)</option>
                    <option value="Price(up)">Price(up)</option>
                    <option value="Date(Down)">Date(Down)</option>
                    <option value="Date(Up)">Date(Up)</option>
                </select>
            </div>
        </div>
        <div class="container">
            <div class="left-shop" id="left-shop">
                <div class="categorie">
                    <h3>Category</h3>
                    <div class="container">
                        <div class="button-holder">
                            <input type="checkbox" id="Desktop" name="category" value="Desktop">
                            <label for="desktop">Desktop</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="Laptop" name="category" value="Laptop">

                            <label for="laptop">Laptop</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="SmartWatch" name="category" value="SmartWatch">

                            <label for="watch">SmartWatch</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="Smartphone" name="category" value="SmartPhone">
                            <label for="SmartPhone">SmartPhone<label />
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="categorie">
                    <h3>Company</h3>
                    <div class="container">
                        <div class="button-holder">
                            <input type="checkbox" id="Apple" name="company" value="Apple">
                            <label for="apple">Apple</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="Samsung" name="company" value="Samsung">
                            <label for="samsung">Samsung</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="Asus" name="company" value="Asus">
                            <label for="asus">Asus</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="Dell" name="company" value="Dell">

                            <label for="dell">Dell</label>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="categorie">
                    <h3>Price</h3>
                    <div class="button-holder">
                        <input type="number" class="min" name="min" value="700" min="0">
                        <p class="grey">-</p>
                        <input type="number" class="max" name="max" value="7000" max="10000">
                    </div>
                    <hr>
                </div>
                <div class="categorie">
                    <h3>Disponibilty</h3>
                    <div class="container">
                        <div class="button-holder">
                            <input type="checkbox" id="in-stock" name="disponibility" value="in-stock">
                            <label for="in-stock">In stock</label>
                        </div>
                        <div class="button-holder">
                            <input type="checkbox" id="out-stock" name="disponibility" value="out-stock">
                            <label for="out-stock">Out of stock</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="items-holder">
                <?php
                // Include the PHP file that fetches and displays products
                $category = null; // Set the category dynamically or leave it null for all products
                include '../php/shop-products.php';
                ?>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const itemsHolder = document.querySelector('.items-holder');
            if (!itemsHolder) {
                return;
            }

            const filterInputs = document.querySelectorAll('#left-shop input');
            const searchInput = document.querySelector('.search');
            const sortSelect = document.getElementById('Tri');
            const resultsCounter = document.querySelector('#right-shop-title .grey');

            const getProducts = () => Array.from(itemsHolder.querySelectorAll('.container[data-category]'));

            function applyFilters() {
                const categoryInputs = Array.from(document.querySelectorAll('input[name="category"]:checked'));
                const selectedCategoryValues = categoryInputs.map(input => input.value);
                const selectedCategories = selectedCategoryValues.map(value => value.toLowerCase());
                const selectedCompanies = Array.from(document.querySelectorAll('input[name="company"]:checked')).map(input => input.value.toLowerCase());
                const availability = Array.from(document.querySelectorAll('input[name="disponibility"]:checked')).map(input => input.value);
                const minPrice = parseFloat(document.querySelector('input[name="min"]').value) || 0;
                const maxPrice = parseFloat(document.querySelector('input[name="max"]').value) || Infinity;
                const searchQuery = searchInput ? searchInput.value.trim().toLowerCase() : '';

                let visibleCount = 0;

                getProducts().forEach(product => {
                    const category = (product.dataset.category || '').toLowerCase();
                    const company = (product.dataset.company || '').toLowerCase();
                    const name = (product.dataset.name || '').toLowerCase();
                    const description = (product.dataset.description || '').toLowerCase();
                    const price = parseFloat(product.dataset.price || '0');
                    const stock = parseInt(product.dataset.stock || '0', 10);

                    const matchesCategory = !selectedCategories.length || selectedCategories.includes(category);
                    const matchesCompany = !selectedCompanies.length || selectedCompanies.includes(company);
                    const matchesPrice = price >= minPrice && price <= maxPrice;
                    const matchesAvailability = !availability.length ||
                        (availability.includes('in-stock') && stock > 0) ||
                        (availability.includes('out-stock') && stock === 0);
                    const matchesSearch = !searchQuery || name.includes(searchQuery) || company.includes(searchQuery) || description.includes(searchQuery);

                    if (matchesCategory && matchesCompany && matchesPrice && matchesAvailability && matchesSearch) {
                        product.style.display = '';
                        visibleCount += 1;
                    } else {
                        product.style.display = 'none';
                    }
                });

                if (resultsCounter) {
                    resultsCounter.textContent = `(${visibleCount})`;
                }

                syncUrlWithFilters(selectedCategoryValues);
            }

            function syncUrlWithFilters(selectedCategoryValues) {
                const params = new URLSearchParams(window.location.search);
                params.delete('category');
                const newQuery = params.toString();
                const newUrl = `${window.location.pathname}${newQuery ? `?${newQuery}` : ''}`;
                window.history.replaceState({}, '', newUrl);
            }

            function sortProducts(sortValue) {
                const products = getProducts();
                if (!products.length) {
                    return;
                }

                const compare = (a, b) => {
                    switch (sortValue) {
                        case 'Price(Down)':
                            return parseFloat(b.dataset.price || '0') - parseFloat(a.dataset.price || '0');
                        case 'Price(up)':
                            return parseFloat(a.dataset.price || '0') - parseFloat(b.dataset.price || '0');
                        case 'Date(Down)':
                            return parseInt(b.dataset.productId || '0', 10) - parseInt(a.dataset.productId || '0', 10);
                        case 'Date(Up)':
                            return parseInt(a.dataset.productId || '0', 10) - parseInt(b.dataset.productId || '0', 10);
                        default:
                            return 0;
                    }
                };

                products.sort(compare).forEach(product => itemsHolder.appendChild(product));
            }

            filterInputs.forEach(input => {
                input.addEventListener('change', applyFilters);
                if (input.type === 'number') {
                    input.addEventListener('input', applyFilters);
                }
            });

            if (searchInput) {
                searchInput.addEventListener('input', applyFilters);
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', () => {
                    sortProducts(sortSelect.value);
                    applyFilters();
                });
            }

            const urlParams = new URLSearchParams(window.location.search);
            const categoryParam = urlParams.get('category');
            if (categoryParam) {
                const normalizedParam = categoryParam.toLowerCase();
                const categoryCheckboxes = document.querySelectorAll('input[name="category"]');
                categoryCheckboxes.forEach((checkbox) => {
                    const checkboxValue = (checkbox.value || '').toLowerCase();
                    if (checkboxValue === normalizedParam) {
                        checkbox.checked = true;
                    }
                });
            }
            window.history.replaceState({}, '', window.location.pathname);

            if (sortSelect) {
                sortProducts(sortSelect.value);
            }

            applyFilters();
        });
    </script>
    <?php include '../includes/scripts.php'; ?>

</body>

</html>