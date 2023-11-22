<?php
$dsn = "mysql:host=sql11.freesqldatabase.com;dbname=sql11664215";
$dbusername = "sql11664215";
$dbpassword = "vDilIApdrs";

// database connection
try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_log("Connection succeeded");
}
catch (PDOException $e) {
    echo "Connection failed: " . $e-> getMessage();
}
?>