<?php
$host = 'localhost';
$database = 'a22iliru'; 
$username = 'OBSERVATÖR';
$password = 'password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo 'Database Connection Error: ' . $e->getMessage();
}

?>