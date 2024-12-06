<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if item_code is empty
    if(empty(trim($_POST["item_code"]))){
        echo "No item code received.";
        exit;
    }
    $dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
    $username = 'ie48';
    $password = 'cZ_263161_Cz';

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `IS117 TEMP Items` WHERE ItemCode = :item_code";

        if($stmt = $db->prepare($sql)){
            $stmt->bindParam(":item_code", $param_item_code, PDO::PARAM_STR);
            $param_item_code = trim($_POST["item_code"]);
            if($stmt->execute()){
                // Records deleted successfully.
                header("location: products.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        unset($stmt);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    $db = null;
}
?>