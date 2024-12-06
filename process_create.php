<?php
// Database connection
$dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
$username = 'ie48';
$password = 'cZ_263161_Cz';
$db = new PDO($dsn, $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch categories for the dropdown
$sql = "SELECT CategoryID, CategoryName FROM `IS117 TEMP Categories`";
$stmt = $db->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Validate price
    if (!is_numeric($price) || $price <= 0) {
        echo "Error: Price must be a positive number.";
        exit;
    }

    // Check for duplicate product code
    $stmt = $db->prepare("SELECT * FROM `IS117 TEMP Items` WHERE ItemCode = ?");
    $stmt->execute([$code]);
    if ($stmt->rowCount() > 0) {
        echo "Error: Product code already exists.";
        exit;
    }

    // Insert into database
    $stmt = $db->prepare("INSERT INTO `IS117 TEMP Items` (CategoryID, ItemCode, ItemName, description, price, dateCreated) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$category, $code, $name, $description, $price]);
    header("Location: products.php");
    exit;
}

// Function to sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>