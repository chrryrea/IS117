<?php
session_start();
include_once 'db_config.php';

// Database connection
$dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
$username = 'ie48';
$password = 'cZ_263161_Cz';

try {
    $db = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = 'SELECT * FROM `IS117 TEMP Manager List` WHERE EmailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();

    // Fetch the manager record
    $manager = $statement->fetch(PDO::FETCH_ASSOC);
    // Verify the password
        if ($manager && password_verify($password, $manager['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['FirstName'] = $manager['FirstName'];
        $_SESSION['LastName'] = $manager['LastName'];
        $_SESSION['email'] = $manager['emailAddress'];

        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placeholder - Login</title>
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
                <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
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
        <h2>Login</h2>
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
</html>
