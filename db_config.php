<?php

function add_manager($db, $email, $password, $firstName, $lastName) {
    // Hash the password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Get the current date and time
    $dateCreated = date("Y-m-d H:i:s"); 

    // Prepare the SQL query
    $query = 'INSERT INTO `IS117 TEMP Manager List` (emailAddress, password, firstName, lastName, dateCreated)
              VALUES (:email, :password, :firstName, :lastName, :dateCreated)';
    $statement = $db->prepare($query);

    // Bind the parameters
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':dateCreated', $dateCreated);
    $statement->execute();
    $statement->closeCursor();
}

$dsn = 'mysql:host=sql1.njit.edu;port=3306;dbname=ie48';
$username = 'ie48';
$dbPassword = 'cZ_263161_Cz';

try {
    // Establish the database connection
    $db = new PDO($dsn, $username, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add managers
    add_manager($db, 'manager1@example.com', 'password1', 'Manager', 'One');
    add_manager($db, 'manager2@example.com', 'password2', 'Manager', 'Two');
    add_manager($db, 'manager3@example.com', 'password3', 'Manager', 'Three');

    echo "Manager records added.";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>