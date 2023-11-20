<?php
$dsn = "mysql:host=localhost;dbname=trial1";
$dbusername = "root";
$dbpassword = "";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("Connection succeeded");
}
catch (PDOException $e) {
    echo "Connection failed: " . $e-> getMessage();
}
?>