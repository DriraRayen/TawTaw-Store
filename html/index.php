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
                <a href="login.php">Home</a>
                <a href="login.php">Shop</a>
                <a href="login.php">Contact</a>
            </span>
            <span>
                <button class="btx-red" id="login">Login</button>
                <button class="btx-red-reverse" id="signup">SignUp</button>
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
        <button class="btx-red see-more">See More</button>
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
        <button class="btx-red see-more">See More</button>
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
            <a href="login.php">home</a>
            <a href="login.php">shop</a>
            <a href="login.php">contact</a>
        </div>
        <div class="gap-footer">
            <h4>Categories</h4>
            <a href="login.php">Desktop</a>
            <a href="login.php">Laptop</a>
            <a href="login.php">Smart phone</a>
            <a href="login.php">Smart watch</a>
            <a href="login.php">Smart tv</a>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginButton = document.getElementById('login');
            const signupButton = document.getElementById('signup');
            const contactButton = document.getElementById('contact');
            const shopButton = document.getElementById('Shop');
            const seeMoreButtons = document.getElementsByClassName('see-more');
           
            Array.from(seeMoreButtons).forEach(function (button) {
                button.addEventListener('click', function () {
                    window.location.href = 'login.php';
                });
            });
            shopButton.addEventListener('click', function () {
                window.location.href = 'login.php';
            });
            loginButton.addEventListener('click', function () {
                window.location.href = 'login.php';
            });
            
            signupButton.addEventListener('click', function () {
                window.location.href = 'signup.php';
            });
            contactButton.addEventListener('click', function () {
                window.location.href = 'login.php';
            });
        });
    </script>
    <script src="../JS/courousel.js"></script>

</body>

</html>