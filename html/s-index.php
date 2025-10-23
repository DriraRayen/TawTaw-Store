<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>TawTaw\home</title>
</head>

<body>
    <header>
        <nav>
            <span>
                <h1>Tawtaw</h1>
                <a href="s-index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="contact.html">Contact</a>
            </span>
            <span id="on">
                <button class="btx-red" id="favourates">Favourates</button>
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" class="pointer"
                    onclick="navigateToPage('cart')" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1.25 0C0.918479 0 0.600537 0.131696 0.366117 0.366117C0.131696 0.600537 0 0.918479 0 1.25C0 1.58152 0.131696 1.89946 0.366117 2.13388C0.600537 2.3683 0.918479 2.5 1.25 2.5H1.865C2.13643 2.50047 2.40033 2.58928 2.61682 2.753C2.83331 2.91672 2.99063 3.14646 3.065 3.4075L7.03 17.2825C7.25426 18.0655 7.72735 18.7542 8.37776 19.2445C9.02816 19.7348 9.82051 20 10.635 20H22.0575C22.8071 20.0001 23.5396 19.7756 24.1603 19.3554C24.7811 18.9351 25.2616 18.3385 25.54 17.6425L29.225 8.4275C29.3765 8.04831 29.4328 7.6378 29.389 7.23183C29.3452 6.82586 29.2026 6.43679 28.9737 6.09865C28.7449 5.7605 28.4366 5.48357 28.076 5.29205C27.7154 5.10053 27.3133 5.00026 26.905 5H6.12L5.4675 2.72C5.24381 1.93693 4.77129 1.24797 4.12135 0.757241C3.47141 0.266517 2.67939 0.00071092 1.865 0H1.25ZM9.435 16.5925L6.835 7.5H26.905L23.2175 16.715C23.1246 16.9467 22.9645 17.1453 22.7578 17.2852C22.551 17.4251 22.3071 17.4999 22.0575 17.5H10.635C10.3636 17.4995 10.0997 17.4107 9.88318 17.247C9.66669 17.0833 9.50937 16.8535 9.435 16.5925ZM11.25 30C11.7425 30 12.2301 29.903 12.6851 29.7145C13.14 29.5261 13.5534 29.2499 13.9017 28.9017C14.2499 28.5534 14.5261 28.14 14.7146 27.6851C14.903 27.2301 15 26.7425 15 26.25C15 25.7575 14.903 25.2699 14.7146 24.8149C14.5261 24.36 14.2499 23.9466 13.9017 23.5983C13.5534 23.2501 13.14 22.9739 12.6851 22.7855C12.2301 22.597 11.7425 22.5 11.25 22.5C10.2554 22.5 9.30161 22.8951 8.59835 23.5983C7.89509 24.3016 7.5 25.2554 7.5 26.25C7.5 27.2446 7.89509 28.1984 8.59835 28.9017C9.30161 29.6049 10.2554 30 11.25 30ZM11.25 27.5C10.9185 27.5 10.6005 27.3683 10.3661 27.1339C10.1317 26.8995 10 26.5815 10 26.25C10 25.9185 10.1317 25.6005 10.3661 25.3661C10.6005 25.1317 10.9185 25 11.25 25C11.5815 25 11.8995 25.1317 12.1339 25.3661C12.3683 25.6005 12.5 25.9185 12.5 26.25C12.5 26.5815 12.3683 26.8995 12.1339 27.1339C11.8995 27.3683 11.5815 27.5 11.25 27.5ZM21.25 30C21.7425 30 22.2301 29.903 22.6851 29.7145C23.14 29.5261 23.5534 29.2499 23.9017 28.9017C24.2499 28.5534 24.5261 28.14 24.7146 27.6851C24.903 27.2301 25 26.7425 25 26.25C25 25.7575 24.903 25.2699 24.7146 24.8149C24.5261 24.36 24.2499 23.9466 23.9017 23.5983C23.5534 23.2501 23.14 22.9739 22.6851 22.7855C22.2301 22.597 21.7425 22.5 21.25 22.5C20.2554 22.5 19.3016 22.8951 18.5984 23.5983C17.8951 24.3016 17.5 25.2554 17.5 26.25C17.5 27.2446 17.8951 28.1984 18.5984 28.9017C19.3016 29.6049 20.2554 30 21.25 30ZM21.25 27.5C20.9185 27.5 20.6005 27.3683 20.3661 27.1339C20.1317 26.8995 20 26.5815 20 26.25C20 25.9185 20.1317 25.6005 20.3661 25.3661C20.6005 25.1317 20.9185 25 21.25 25C21.5815 25 21.8995 25.1317 22.1339 25.3661C22.3683 25.6005 22.5 25.9185 22.5 26.25C22.5 26.5815 22.3683 26.8995 22.1339 27.1339C21.8995 27.3683 21.5815 27.5 21.25 27.5Z"
                        fill="#31C1E1" />
                </svg>
                <svg width="42" height="40" viewBox="0 0 42 40" class="profile-logo" fill="none"
                    onclick="handleLogout()" xmlns="http://www.w3.org/2000/svg" title="dont click me">
                    <g clip-path="url(#clip0_121_707)">
                        <path
                            d="M28.2638 17.5C28.2638 21.65 24.8208 25 20.5555 25C16.2902 25 12.8472 21.65 12.8472 17.5C12.8472 13.35 16.2902 10 20.5555 10C24.8208 10 28.2638 13.35 28.2638 17.5Z"
                            fill="#31C1E1" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M41.1111 20C41.1111 31.05 31.9125 40 20.5556 40C9.19861 40 0 31.05 0 20C0 8.95 9.19861 0 20.5556 0C31.9125 0 41.1111 8.95 41.1111 20ZM10.2778 34.375C10.6889 33.71 14.6715 27.5 20.5299 27.5C26.3625 27.5 30.3708 33.725 30.7819 34.375C33.1712 32.7675 35.1234 30.6193 36.4706 28.1153C37.8178 25.6113 38.5197 22.8264 38.516 20C38.516 10.325 30.4736 2.5 20.5299 2.5C10.5861 2.5 2.54375 10.325 2.54375 20C2.54375 25.95 5.60139 31.225 10.2778 34.375Z"
                            fill="#31C1E1" />
                    </g>
                    <defs>
                        <clipPath id="clip0_121_707">
                            <rect width="41.1111" height="40" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </span>
        </nav>
    </header>
    <div class="Hero">
        <div class="hero-content">
            <h2>TawTaw Store</h2>
            <p>The most secure marketplace for buying unique and top-tier products</p>
            <div><button class="btx-red" id="Shop">Shop now</button>
                <button class="btx-blue" id="contact">Contact</button>
            </div>
        </div>
        <div class="hero-image">
        </div>
    </div>
    <div class="why">
        <h2 class="section"><span>Why</span> shop with us <span>?</span></h2>
        <hr class="hr">
        <div class="container">
            <div class="why-card">
                <img src="../Images/Icons/fast-delivery.png" alt="van icon">
                <h3>Fast delivery</h3>
                <p>swift delivery for your immediate satisfaction</p>
            </div>
            <div class="why-card">
                <img src="../Images/Icons/free.png" alt="coin icon that says free">
                <h3>Free shipping</h3>
                <p>enjoy cost free shipping on all orders</p>
            </div>
            <div class="why-card">
                <img src="../Images/Icons/Medal.png" alt="achievement icon">
                <h3>Best Quality</h3>
                <p>top-tier quality you can always trust</p>
            </div>
        </div>
    </div>
    <div class="today">
        <h2 class="section"><span>Today</span>'s Deals <span>!</span></h2>
        <hr class="hr">
        <div class="container">
            <div class="arrow-left arrow" id="#product-carousel-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" transform="rotate(180 0 0)"
                    viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
            <div class="product-wrapper" id="product-wrapper">
                <?php include __DIR__ . '/../php/product-cards.php'; ?>
            </div>
            <div class="arrow-right arrow" id="#product-carousel-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
        </div>
        <button class="btx-red" id="Shop">See More</button>
    </div>
    <div class="trending">
        <h2 class="section">laptops <span>!</span></h2>
        <hr class="hr">
        <div class="container">
            <div class="arrow-left arrow" id="#product-carousel-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" transform="rotate(180 0 0)"
                    viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
            <div class="product-wrapper" id="product-wrapper">
                <?php
                $category = 'laptop';
                include __DIR__ . '/../php/product-cards.php'; ?>
            </div>
            <div class="arrow-right arrow" id="#product-carousel-right">
                <svg xmlns="http://www.w3.org/2000/svg" width="3.5em" height="3.5em" viewBox="0 0 1024 1024">
                    <path fill="#FF2330"
                        d="M338.752 104.704a64 64 0 0 0 0 90.496l316.8 316.8l-316.8 316.8a64 64 0 0 0 90.496 90.496l362.048-362.048a64 64 0 0 0 0-90.496L429.248 104.704a64 64 0 0 0-90.496 0" />
                </svg>
            </div>
        </div>
        <button class="btx-red" id="Shop">See More</button>
    </div>

    <footer>
        <div>
            <h4>you can find us on</h4>
            <div><img src="../Images/Icons/facebook.png" class="pointer" alt="Facebook logo">
                <a>Facebook.com</a>
            </div>
            <div><img src="../Images/Icons/instagram.png" alt="Instagram logo" class="pointer">
                <a>Instagram.com</a>
            </div>
            <div><img src="../Images/Icons/mail.png" alt="email logo" class="pointer">
                <a>email@domaine.com</a>
            </div>
            <div><img src="../Images/Icons/telephone-call.png" alt="Number logo" class="pointer">
                <a>Number</a>
            </div>
            <div><img src="../Images/Icons/gps-navigation.png" alt="location logo" class="pointer">
                <a>Address of the store</a>
            </div>
        </div>
        <div class="gap-footer">
            <h4>Tawtaw</h4>
            <a href="s-index.php">home</a>
            <a href="shop.php">shop</a>
            <a href="contact.html">contact</a>
        </div>
        <div class="gap-footer">
            <h4>Categories</h4>
            <a href="shop.php?category=Desktop">Desktop</a>
            <a href="shop.php?category=Laptop">Laptop</a>
            <a href="shop.php?category=Smartphone">Smart phone</a>
            <a href="shop.php?category=SmartWatch">Smart watch</a>
            <a href="shop.php?category=Smarttv">Smart tv</a>
        </div>
    </footer>
    <script>
        //script to manage cart
        function addToCart(variationId) {
         
            const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                alert('You must be logged in to add items to the cart.');
                return;
            }

            // Send the AJAX request
            fetch('../php/add-to-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ variation_id: variationId }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Item added to cart successfully!');
                    } else {
                        alert('Failed to add item to cart: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
    <script src="../JS/logout.js"></script>
    <script src="../JS/index.js"></script>
    <script src="../JS/courousel.js"></script>


</body>

</html>