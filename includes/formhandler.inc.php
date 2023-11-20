<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $name = $_POST["name"];
    $comment = $_POST["comment"];

    try{
        require_once "dbh.inc.php";

        $query = "INSERT INTO comments (Email, Name, Content) VALUES 
        (?, ?, ?);";

        $stmt = $pdo->prepare($query);

        $stmt->execute([$email, $name, $comment]);

        $pdo = null;
        $stmt = null;

        header("Location ../index.php");

        exit();
    }
    catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }    
}
else{
    header("Location ../index.php");
}
?>