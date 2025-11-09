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
    <title>Product</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../php/product-page.php'; ?>
    <div class="filesheet">
        <h2 class="section"><span>More </span>Details <span>!</span></h2>
        <hr class="hr">
        <div class="container">
            <div class="left-sheet">
                <h2 class="section" id="blue-title"><span>About </span>this Item</h2>
                <p id="about-product"></p>
            </div>
            <div class="right-sheet">
                <h2 class="section" id="blue-title">Technical <span>Sheet</span></h2>
                <div class="table" id="specifications-table"></div>
            </div>
        </div>
    </div>
    <div class="trending">
        <h2 class="section"><span>You</span> May also like <span>!</span></h2>
        <hr class="hr">
        <div class="container product-carousel">
            <div class="arrow-left arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" transform="rotate(180 0 0)"
                    viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
            <div class="product-wrapper" id="product-wrapper">
                <?php include '../php/product-cards.php'; ?>
            </div>
            <div class="arrow-right arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
        </div>
        <button class="btx-red" id="Shop">See More</button>
    </div>
    <div class="Review">
        <h2 class="section"><span>Top</span> Reviews</h2>
        <hr class="hr">
        <div class="container">
            <div class="table">
                <h2>Sa7a Bechiur</h2>
                <div class="button-holder">
                    <div class="rating">
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                    </div>
                    <p id="title">A reliable Computer </p>
                    <p class="grey" id="Date">Reviewed in Tunisia on September 8,2024</p>
                </div>
                <div>
                    <p class="grey">Apple Macbook Pro M3 || 512GB SSD || Space Grey || <span class="Verified">Verified
                            Purchase</span></p>
                </div>
                <div>
                    <p>I bought this Mac so I could play sims 4 with some of my expansion packs and this thing runs like
                        an absolute dream. I'm a firm believer in paying what you get for, and this is one of those
                        cases. It's a great quality computer.</p>
                </div>
                <div class="button-holder">
                    <button class="btx-red">Helpful</button>
                    <p id="helpful" class="grey">10 people find this helpful</p>
                </div>
            </div>
            <div class="table">
                <h2>Mnawar Mounir</h2>
                <div class="button-holder">
                    <div class="rating">
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#FF2330" />
                        </svg>
                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 0L15.3064 8.63729H24.3882L17.0409 13.9754L19.8473 22.6127L12.5 17.2746L5.15268 22.6127L7.95911 13.9754L0.611794 8.63729H9.69357L12.5 0Z"
                                fill="#D9D9D9" fill-opacity="0.36" />
                        </svg>

                    </div>
                    <p id="title">Great Battery Life</p>
                    <p class="grey" id="Date">Reviewed in Tunisia on September 8,2024</p>
                </div>
                <div>
                    <p class="grey">Apple Macbook Pro M3 || 1TB SSD || Space Grey || <span class="Verified">Verified
                            Purchase</span></p>
                </div>
                <div>
                    <p>I bought this Mac so I could play sims 4 with some of my expansion packs and this thing runs like
                        an absolute dream. I'm a firm believer in paying what you get for, and this is one of those
                        cases. It's a great quality computer.</p>
                </div>
                <div class="button-holder">
                    <button class="btx-red">Helpful</button>
                    <p id="helpful" class="grey">10 people find this helpful</p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <?php include '../includes/scripts.php'; ?>
    <script src="../JS/courousel.js"></script>
    <script>
        (function () {
            const variations = Array.isArray(window.variations) ? window.variations : [];
            if (!variations.length) {
                return;
            }

            const initialVariationId = Number(window.initialVariationId);

            const notify = typeof window.notifyUser === 'function'
                ? (message, type = 'info') => window.notifyUser(message, type)
                : (message) => window.alert(message);

            const PLACEHOLDER_IMAGE = 'Images/Products/placeholder.png';
            const IMAGE_BASE_PATH = '../';

            const mainImg = document.getElementById('main-img');
            const thumbnailTrack = document.getElementById('thumbnail-track');
            const prevButton = document.getElementById('gallery-prev');
            const nextButton = document.getElementById('gallery-next');
            const quantitySelect = document.getElementById('quantity');
            const stockElement = document.querySelector('.right-product .top p:nth-of-type(3)');
            const priceElements = document.querySelectorAll('.product-price');
            const buyButton = document.getElementById('buy');
            const addToCartButton = document.getElementById('add-to-cart');
            const colorButtons = document.querySelectorAll('.choice[data-color]');
            const storageButtons = document.querySelectorAll('.choice[data-storage]');
            const favouriteButton = document.querySelector('.main-card .heart');
            const aboutElement = document.getElementById('about-product');
            const specsContainer = document.getElementById('specifications-table');
            const details = window.productDetails || {};
            const specifications = Array.isArray(window.productSpecifications) ? window.productSpecifications : [];
            const FAVOURITE_ACTIVE_ICON = '../Images/Icons/heart_on.svg';
            const FAVOURITE_INACTIVE_ICON = '../Images/Icons/heart.svg';

            let currentVariation = variations.find((variation) => Number(variation.variation_id) === initialVariationId) || variations[0];
            let selectedColor = currentVariation ? currentVariation.color : null;
            let selectedStorage = currentVariation ? currentVariation.storage : null;
            let currentGalleryIndex = 0;
            let lastVariationForSpecs = currentVariation || null;
            let lastStockStatus = null;

            function escapeHtml(value) {
                return String(value || '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function buildImageSrc(path) {
                if (!path) {
                    return IMAGE_BASE_PATH + PLACEHOLDER_IMAGE;
                }
                const trimmed = path.trim();
                if (trimmed.startsWith('http://') || trimmed.startsWith('https://') || trimmed.startsWith('//')) {
                    return trimmed;
                }
                if (trimmed.startsWith('../')) {
                    return trimmed;
                }
                return IMAGE_BASE_PATH + trimmed.replace(/^\/+/, '');
            }

            function getImages(variation) {
                if (!variation || !Array.isArray(variation.images) || variation.images.length === 0) {
                    return [PLACEHOLDER_IMAGE];
                }
                return variation.images;
            }

            function updatePriceElements(variation) {
                const value = variation
                    ? `${Number(variation.price).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })} TND`
                    : '-- TND';
                priceElements.forEach((element) => {
                    element.textContent = value;
                });
            }

            function updateStockMessage(variation) {
                if (!stockElement) {
                    return;
                }
                if (!variation) {
                    stockElement.innerHTML = '<span>Currently unavailable</span>';
                    return;
                }
                const quantity = Math.max(Number(variation.quantity) || 0, 0);
                if (quantity <= 0) {
                    stockElement.innerHTML = '<span>Currently out of stock</span>';
                    return;
                }
                stockElement.innerHTML = `<span>Only ${quantity}</span> left in stock - order <span>soon.</span>`;
            }

            function updateQuantityOptions(variation) {
                if (!quantitySelect) {
                    return;
                }

                quantitySelect.innerHTML = '';

                if (!variation) {
                    const option = document.createElement('option');
                    option.value = 0;
                    option.textContent = 'Out of stock';
                    option.disabled = true;
                    option.selected = true;
                    quantitySelect.appendChild(option);
                    return;
                }

                const available = Math.max(parseInt(variation.quantity, 10) || 0, 0);
                if (available === 0) {
                    const option = document.createElement('option');
                    option.value = 0;
                    option.textContent = 'Out of stock';
                    option.disabled = true;
                    option.selected = true;
                    quantitySelect.appendChild(option);
                    return;
                }

                for (let qty = 1; qty <= available; qty += 1) {
                    const option = document.createElement('option');
                    option.value = qty;
                    option.textContent = `Quantity: ${qty}`;
                    quantitySelect.appendChild(option);
                }
            }

            function updateActionButtons(variation) {
                const isAvailable = Boolean(variation && Number(variation.quantity) > 0);
                if (buyButton) {
                    buyButton.disabled = !isAvailable;
                }
                if (addToCartButton) {
                    addToCartButton.disabled = !isAvailable;
                    if (variation) {
                        addToCartButton.dataset.variationId = variation.variation_id;
                    } else {
                        delete addToCartButton.dataset.variationId;
                    }
                }
                if (lastStockStatus !== isAvailable) {
                    lastStockStatus = isAvailable;
                    if (!isAvailable) {
                        notify('This product is out of stock.', 'error');
                    }
                }
            }

            function updateActiveThumbnail() {
                if (!thumbnailTrack) {
                    return;
                }
                thumbnailTrack.querySelectorAll('.thumbnail-button').forEach((button) => {
                    button.classList.toggle('active', button.dataset.index === String(currentGalleryIndex));
                });
            }

            function ensureThumbnailVisible(index) {
                if (!thumbnailTrack) {
                    return;
                }
                const target = thumbnailTrack.querySelector(`.thumbnail-button[data-index="${index}"]`);
                if (target && typeof target.scrollIntoView === 'function') {
                    target.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }
            }

            function updateGalleryControls(totalImages) {
                const hasMultiple = totalImages > 1;
                if (prevButton) {
                    prevButton.disabled = !hasMultiple || currentGalleryIndex <= 0;
                }
                if (nextButton) {
                    nextButton.disabled = !hasMultiple || currentGalleryIndex >= totalImages - 1;
                }
            }

            function setMainImage(index) {
                const images = getImages(currentVariation);
                if (!mainImg || index < 0 || index >= images.length) {
                    return;
                }

                currentGalleryIndex = index;
                mainImg.src = buildImageSrc(images[index]);
                updateActiveThumbnail();
                ensureThumbnailVisible(index);
                updateGalleryControls(images.length);
            }

            function rebuildThumbnails(images) {
                if (!thumbnailTrack) {
                    return;
                }

                thumbnailTrack.innerHTML = '';

                images.forEach((imagePath, index) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.dataset.index = index.toString();
                    button.className = `image-holder thumbnail-button${index === currentGalleryIndex ? ' active' : ''}`;

                    const thumb = document.createElement('img');
                    thumb.className = 'side-img';
                    thumb.alt = `Product image ${index + 1}`;
                    thumb.src = buildImageSrc(imagePath);

                    button.appendChild(thumb);
                    button.addEventListener('click', () => setMainImage(index));
                    thumbnailTrack.appendChild(button);
                });
            }

            function refreshGallery(resetIndex = false) {
                const images = getImages(currentVariation);
                if (resetIndex || currentGalleryIndex >= images.length) {
                    currentGalleryIndex = 0;
                }

                rebuildThumbnails(images);
                setMainImage(currentGalleryIndex);
            }

            function updateOptionButtons(type, value) {
                const buttons = type === 'color' ? colorButtons : storageButtons;
                buttons.forEach((button) => {
                    const buttonValue = type === 'color' ? button.dataset.color : button.dataset.storage;
                    const isActive = Boolean(value) && buttonValue === value;
                    button.classList.toggle('is-active', isActive);
                    button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                });
            }

            function updateFavouriteUi(variation) {
                if (!favouriteButton) {
                    return;
                }

                const isFavourite = Boolean(variation && variation.is_favourite);
                const variationId = variation ? variation.variation_id : null;

                favouriteButton.setAttribute('data-favourite', isFavourite ? 'true' : 'false');
                favouriteButton.setAttribute('aria-pressed', isFavourite ? 'true' : 'false');

                if (variationId) {
                    favouriteButton.setAttribute('data-variation-id', variationId);
                } else {
                    favouriteButton.removeAttribute('data-variation-id');
                }

                favouriteButton.src = isFavourite ? FAVOURITE_ACTIVE_ICON : FAVOURITE_INACTIVE_ICON;
            }

            function selectVariation(variation, resetGallery = true) {
                currentVariation = variation || null;

                if (!currentVariation) {
                    updateOptionButtons('color', selectedColor);
                    updateOptionButtons('storage', selectedStorage);
                    updatePriceElements(null);
                    updateStockMessage(null);
                    updateQuantityOptions(null);
                    updateActionButtons(null);
                    refreshGallery(resetGallery);
                    updateSpecsForVariation(null);
                    updateFavouriteUi(null);
                    return;
                }

                selectedColor = currentVariation.color || null;
                selectedStorage = currentVariation.storage || null;

                updateOptionButtons('color', selectedColor);
                updateOptionButtons('storage', selectedStorage);
                updatePriceElements(currentVariation);
                updateStockMessage(currentVariation);
                updateQuantityOptions(currentVariation);
                updateActionButtons(currentVariation);
                refreshGallery(resetGallery);
                updateSpecsForVariation(currentVariation);
                updateFavouriteUi(currentVariation);
            }

            function findBestVariation() {
                let match = null;

                if (selectedColor && selectedStorage) {
                    match = variations.find((variation) => variation.color === selectedColor && variation.storage === selectedStorage);
                }

                if (!match && selectedColor) {
                    match = variations.find((variation) => variation.color === selectedColor);
                    if (match) {
                        selectedStorage = match.storage || null;
                    }
                }

                if (!match && selectedStorage) {
                    match = variations.find((variation) => variation.storage === selectedStorage);
                    if (match) {
                        selectedColor = match.color || null;
                    }
                }

                if (!match) {
                    match = variations[0] || null;
                    if (match) {
                        selectedColor = match.color || null;
                        selectedStorage = match.storage || null;
                    }
                }

                return match;
            }

            function applySelection(resetGallery = true) {
                const variation = findBestVariation();
                selectVariation(variation, resetGallery);
            }

            function handleColorSelection(color) {
                const normalized = color || null;
                if (normalized === selectedColor) {
                    return;
                }

                selectedColor = normalized;

                if (selectedColor) {
                    const hasCombination = variations.some((variation) => {
                        if (variation.color !== selectedColor) {
                            return false;
                        }
                        if (!selectedStorage) {
                            return true;
                        }
                        return variation.storage === selectedStorage;
                    });

                    if (!hasCombination) {
                        selectedStorage = null;
                    }
                }

                applySelection(true);
            }

            function handleStorageSelection(storage) {
                const normalized = storage || null;
                if (normalized === selectedStorage) {
                    return;
                }

                selectedStorage = normalized;
                applySelection(true);
            }

            function bindOptionButtons() {
                colorButtons.forEach((button) => {
                    const buttonColor = button.dataset.color || null;
                    button.addEventListener('click', () => handleColorSelection(buttonColor));
                });

                storageButtons.forEach((button) => {
                    const buttonStorage = button.dataset.storage || null;
                    button.addEventListener('click', () => handleStorageSelection(buttonStorage));
                });
            }

            function stepGallery(delta, options = {}) {
                const images = getImages(currentVariation);
                if (images.length <= 1) {
                    return;
                }

                let nextIndex = currentGalleryIndex + delta;
                if (options.wrap) {
                    const total = images.length;
                    nextIndex = (nextIndex + total) % total;
                }

                if (nextIndex < 0 || nextIndex >= images.length) {
                    return;
                }

                setMainImage(nextIndex);
            }

            if (prevButton) {
                prevButton.addEventListener('click', () => stepGallery(-1));
            }
            if (nextButton) {
                nextButton.addEventListener('click', () => stepGallery(1));
            }
            if (mainImg) {
                mainImg.addEventListener('click', () => stepGallery(1, { wrap: true }));
            }

            bindOptionButtons();

            window.selectColor = handleColorSelection;
            window.selectStorage = handleStorageSelection;

            if (favouriteButton) {
                favouriteButton.addEventListener('click', () => {
                    if (!currentVariation) {
                        notify('Choose a variation first.', 'info');
                        return;
                    }

                    if (typeof window.toggleFavourite !== 'function') {
                        notify('Could not update favourites. Try again.', 'error');
                        return;
                    }

                    const result = window.toggleFavourite(favouriteButton, currentVariation.variation_id);
                    if (result && typeof result.then === 'function') {
                        result.then((data) => {
                            if (!data || data.success !== true) {
                                return;
                            }
                            const isFavourite = favouriteButton.getAttribute('data-favourite') === 'true';
                            currentVariation.is_favourite = isFavourite;
                            const match = variations.find((variation) => Number(variation.variation_id) === Number(currentVariation.variation_id));
                            if (match) {
                                match.is_favourite = isFavourite;
                            }
                            updateFavouriteUi(currentVariation);
                        }).catch(() => {
                            /* errors already surfaced */
                        });
                    }
                });
            }

            if (aboutElement) {
                if (typeof details.about === 'string' && details.about.trim() !== '') {
                    const normalizedAbout = details.about.replace(/\r\n/g, '\n');
                    const escaped = escapeHtml(normalizedAbout)
                        .replace(/\n\s*\n/g, '<br><br>')
                        .replace(/\n/g, '<br>');
                    aboutElement.innerHTML = escaped;
                } else {
                    aboutElement.textContent = 'Product description coming soon.';
                }
            }

            function updateSpecsForVariation(variation) {
                if (!specsContainer) {
                    return;
                }

                specsContainer.innerHTML = '';

                const queuedRows = [];

                const queueSpecRow = (label, value) => {
                    const normalizedLabel = typeof label === 'string' ? label.trim() : '';
                    let normalizedValue = typeof value === 'number' ? String(value) : (typeof value === 'string' ? value.trim() : '');
                    if (!normalizedLabel || !normalizedValue) {
                        return;
                    }
                    if (normalizedValue.toUpperCase() === 'N/A') {
                        return;
                    }
                    queuedRows.push({ label: normalizedLabel, value: normalizedValue });
                };

                queueSpecRow('Brand', (variation && variation.company) || (lastVariationForSpecs && lastVariationForSpecs.company));
                queueSpecRow('Category', (variation && variation.category) || (lastVariationForSpecs && lastVariationForSpecs.category));
                queueSpecRow('CPU', details.cpu || '');
                queueSpecRow('Display', details.display || '');
                queueSpecRow('Storage', (variation && variation.storage) || (lastVariationForSpecs && lastVariationForSpecs.storage));
                queueSpecRow('Memory', (variation && variation.memory) || (lastVariationForSpecs && lastVariationForSpecs.memory));

                specifications.slice(0, 4).forEach((spec) => {
                    if (spec && typeof spec.label === 'string' && typeof spec.value === 'string') {
                        queueSpecRow(spec.label, spec.value);
                    }
                });

                const MAX_SPEC_ROWS = 8;

                queuedRows.slice(0, MAX_SPEC_ROWS).forEach(({ label, value }) => {
                    const row = document.createElement('div');
                    row.className = 'button-holder';

                    const labelEl = document.createElement('div');
                    labelEl.className = 'choice';
                    labelEl.textContent = label;

                    const valueEl = document.createElement('div');
                    valueEl.className = 'choice secondary-choice';
                    valueEl.textContent = value;

                    row.appendChild(labelEl);
                    row.appendChild(valueEl);
                    specsContainer.appendChild(row);
                });

                if (variation) {
                    lastVariationForSpecs = variation;
                }
            }

            if (addToCartButton) {
                addToCartButton.addEventListener('click', () => {
                    if (!currentVariation) {
                        notify('Choose a variation first.', 'info');
                        return;
                    }
                    const quantity = quantitySelect ? Number(quantitySelect.value) || 1 : 1;
                    if (typeof window.addToCart === 'function') {
                        window.addToCart(currentVariation.variation_id, quantity).catch((error) => {
                            if (error && error.message === 'Login required') {
                                return;
                            }
                            const message = error && typeof error.message === 'string' && error.message.trim()
                                ? error.message
                                : 'Could not add to cart. Try again.';
                            notify(message, 'error');
                        });
                    } else {
                        notify('Could not add to cart. Try again.', 'error');
                    }
                });
            }

            if (buyButton) {
                buyButton.addEventListener('click', () => {
                    if (!currentVariation) {
                        notify('Choose a variation before buying.', 'info');
                        return;
                    }
                    const quantity = quantitySelect ? Number(quantitySelect.value) || 1 : 1;

                    if (typeof window.quickBuy === 'function') {
                        window.quickBuy(currentVariation.variation_id, quantity).catch((error) => {
                            if (error && error.message === 'Login required') {
                                return;
                            }
                            const message = error && typeof error.message === 'string' && error.message.trim()
                                ? error.message
                                : 'Purchase could not start. Try again.';
                            notify(message, 'error');
                        });
                        return;
                    }

                    if (typeof window.addToCart === 'function') {
                        window.addToCart(currentVariation.variation_id, quantity, {
                            mode: 'set',
                            silentSuccess: true,
                        }).then(() => {
                            window.location.href = `pay.php?items=${currentVariation.variation_id}`;
                        }).catch((error) => {
                            if (error && error.message === 'Login required') {
                                return;
                            }
                            const message = error && typeof error.message === 'string' && error.message.trim()
                                ? error.message
                                : 'Purchase could not start. Try again.';
                            notify(message, 'error');
                        });
                        return;
                    }

                    window.location.href = `pay.php?items=${currentVariation.variation_id}`;
                });
            }

            applySelection(true);
        })();
    </script>
</body>

</html>