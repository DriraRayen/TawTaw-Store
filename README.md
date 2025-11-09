# 🛒 TawTaw Store

**TawTaw Store** is a modern tech-focused e-commerce web application built with **PHP**, **MySQL**, and **HTML/CSS/JavaScript**. It provides a complete shopping experience with product browsing, filtering, cart management, and favorites functionality.

🌐 **[Live Demo](https://tawtaw-store.kesug.com/)** - Check out the deployed website!

---

## 🚀 Features

-  📦 **Product Catalog**: Browse products with images and detailed information
-  🔍 **Advanced Filtering**: Filter by brand, company, price, and more
-  🛍️ **Shopping Cart**: Add items to cart with quantity management
-  ❤️ **Favorites**: Save favorite products for later
-  🎠 **Product Carousel**: Interactive product showcase
-  👤 **User Authentication**: Secure login and signup system
-  💳 **Payment Integration**: Payment processing page (in development)
-  📧 **Contact Form**: Get in touch for support

### 🔜 Upcoming Features

-  ✅ Checkout process completion
-  ⭐ Product reviews and ratings
-  📊 Admin dashboard

---

## ⚙️ Setup Instructions

### Prerequisites

-  **XAMPP** (or any Apache + MySQL + PHP stack)
-  **PHP** 7.4 or higher
-  **MySQL** 5.7 or higher

### Installation Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/RayenDrira/TawTaw-Store.git
   ```

2. **Move to XAMPP directory**

   ```bash
   # Copy the project folder to your htdocs directory
   # Usually: C:\xampp\htdocs\ (Windows) or /opt/lampp/htdocs/ (Linux)
   ```

3. **Start XAMPP Services**

   -  Open XAMPP Control Panel
   -  Start **Apache** and **MySQL** services

4. **Setup Database**

   -  Open phpMyAdmin: `http://localhost/phpmyadmin`
   -  Create a new database (e.g., `tawtaw_store`)
   -  Import the SQL file: `db/tawtaw_store.sql`

5. **Configure Database Connection**

   -  Copy `php/connexion.php.example` to `php/connexion.php` (if example exists)
   -  Or create `php/connexion.php` with your database credentials:

   ```php
   <?php
   $servername = "localhost";
   $username = "root";  // Your MySQL username
   $password = "";      // Your MySQL password
   $dbname = "tawtaw_store";  // Your database name

   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

6. **Access the Application**
   -  Open your browser and visit: `http://localhost/TawTaw-Store/html/index.php`

---

## 📁 Project Structure

```
TawTaw-Store/
├── 📄 index.php              # Root entry point
├── 📄 README.md              # Project documentation
│
├── 📁 css/                   # Stylesheets
│   ├── style.css            # Main styles
│   ├── dashboard.css        # Admin dashboard styles
│   ├── items.css            # Product item styles
│   ├── cart.css             # Shopping cart styles
│   └── ...
│
├── 📁 html/                  # HTML pages
│   ├── index.php            # Homepage
│   ├── shop.php             # Shop page
│   ├── product.php          # Product details
│   ├── cart.php             # Shopping cart
│   ├── login.php            # User login
│   ├── signup.php           # User registration
│   └── ...
│
├── 📁 php/                   # PHP backend scripts
│   ├── connexion.php        # Database connection (not tracked in Git)
│   ├── product-cards.php    # Product display logic
│   ├── cart-helpers.php     # Cart management
│   ├── verify-login.php     # Authentication
│   └── ...
│
├── 📁 JS/                    # JavaScript files
│   ├── index.js             # Main scripts
│   ├── cart-functions.js    # Cart functionality
│   ├── product-page.js      # Product page logic
│   └── ...
│
├── 📁 Images/                # Image assets
│   ├── Background/          # Background images
│   ├── Icons/               # Icon images
│   └── Products/            # Product images
│
├── 📁 includes/              # Reusable PHP components
│   ├── header.php           # Site header
│   ├── footer.php           # Site footer
│   └── session-init.php     # Session management

```

---

## 🔒 Security Notes

⚠️ **Important**: The following files contain sensitive information and should **never** be committed to Git:

-  `php/connexion.php` - Contains database credentials
-  `db/*.sql` - May contain user data

These files are already included in `.gitignore` to prevent accidental commits.

---

## 🛠️ Technologies Used

-  **Backend**: PHP 7.4+
-  **Database**: MySQL
-  **Frontend**: HTML5, CSS3, JavaScript (ES6+)
-  **Server**: Apache (XAMPP)
-  **Version Control**: Git & GitHub

---

## 🤝 Contributing

Contributions are welcome! If you'd like to contribute:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open source and available for educational purposes.

---

## 👨‍💻 Author

**Rayen Drira**  
Computer Engineering Student | Exploring IoT & Cybersecurity | Scout Leader 🏕️
[GitHub Profile](https://github.com/RayenDrira)

---

## 📧 Contact

For questions or support, please use the contact form on the website or reach out via GitHub.

---

<div align="center">
Made by Rayen Drira
</div>
