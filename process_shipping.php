<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve form data
    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $street_address = test_input($_POST["street_address"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $zip_code = test_input($_POST["zip_code"]);
    $ship_date = test_input($_POST["ship_date"]);
    $order_number = test_input($_POST["order_number"]);
    $length = test_input($_POST["length"]);
    $width = test_input($_POST["width"]);
    $height = test_input($_POST["height"]);
    $declared_value = test_input($_POST["declared_value"]);

    $errors = array();
    if ($declared_value > 1000) {
        $errors[] = "Declared value must be less than or equal to $1000.";
    }     // Validate the declared value
    if ($length > 36 || $width > 36 || $height > 36) {
        $errors[] = "Dimensions of the package cannot exceed 36 inches.";
    }     // Validate the package dimensions

    if (empty($errors)) {
        display_shipping_label($first_name, $last_name, $street_address, $city, $state, $zip_code, $ship_date, $order_number, $length, $width, $height, $declared_value);
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}

// Function to handle input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to display shipping label
function display_shipping_label($first_name, $last_name, $street_address, $city, $state, $zip_code, $ship_date, $order_number, $length, $width, $height, $declared_value) {
    $from_address = "123 Main Street";
    $to_address = "$first_name $last_name, $street_address, $city, $state, $zip_code";
    echo "<h2>Shipping Label</h2>";
    echo "<p><strong>From Address:</strong> $from_address</p>";
    echo "<p><strong>To Address:</strong> $to_address</p>";
}

?>