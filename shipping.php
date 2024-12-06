<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder - Shipping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header>
        <div class="banner">
            <h1>Placeholder Company</h1>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <?php if ($loggedIn): ?>
                    <li class="nav-item"><a class="nav-link" href="logout.html">Logout</a></li>
                    <li class="nav-item"><a class="nav-link" href="shipping.html">Shipping</a></li>
                    <li class="nav-item"><a class="nav-link" href="create.html">Create</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                        <li><a class="dropdown-item" href="category1.html">Category 1</a></li>
                        <li><a class="dropdown-item" href="category2.html">Category 2</a></li>
                        <li><a class="dropdown-item" href="category3.html">Category 3</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Shipping Label Generator</h2>
        <form action="process_shipping.php" method="post">
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required><br>

            <label for="street_address">Street Address:</label><br>
            <input type="text" id="street_address" name="street_address" required><br>

            <label for="city">City:</label><br>
            <input type="text" id="city" name="city" required><br>

            <label for="state">State:</label><br>
            <input type="text" id="state" name="state" required><br>

            <label for="zip_code">Zip Code:</label><br>
            <input type="text" id="zip_code" name="zip_code" required><br>

            <label for="ship_date">Ship Date:</label><br>
            <input type="date" id="ship_date" name="ship_date" required><br>

            <label for="order_number">Order Number:</label><br>
            <input type="text" id="order_number" name="order_number" required><br>

            <label for="length">Length (in.):</label><br>
            <input type="number" id="length" name="length" min="1" max="36" required><br>

            <label for="width">Width (in.):</label><br>
            <input type="number" id="width" name="width" min="1" max="36" required><br>

            <label for="height">Height (in.):</label><br>
            <input type="number" id="height" name="height" min="1" max="36" required><br>

            <label for="declared_value">Declared Value ($):</label><br>
            <input type="number" id="declared_value" name="declared_value" min="1" max="1000" required><br>

            <button type="submit">Generate Label</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Ian Espinal</p>
        <div class="footer-links">
            <ul>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="privacy.html">Privacy Statement</a></li>
            </ul>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>