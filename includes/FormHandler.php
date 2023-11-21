<?php

class FormHandler {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function handleFormSubmission($additionalIdentifier) {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
            $name = isset($_POST["name"]) ? trim($_POST["name"]) : '';
            $comment = isset($_POST["comment"]) ? trim($_POST["comment"]) : '';
            $additionalIdentifier = isset($_POST["additional_identifier"]) ? $_POST["additional_identifier"] : '';
    
            $errorMessages = [];
    
            if (empty($email)) {
                $errorMessages[] = "Please fill out the email field.<br>";
            }
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessages[] = "Invalid email format.<br>";
            }

            if (empty($name)) {
                $errorMessages[] = "Please fill out the name field.<br>";
            }
            elseif (preg_match('/[0-9]/', $name)) {
                $errorMessages[] = "Name should not contain numbers.<br>";
            }
            if (empty($comment)) {
                $errorMessages[] = "Please fill out the comment field.<br>";
            }
    
            if (!empty($errorMessages)) {
                $_SESSION['error_message'] = implode(' ', $errorMessages);
                header("Location: ../index.php");
                exit();
            }

            try {
                if($additionalIdentifier == "comment"){
                    $query = "INSERT INTO comments (Email, Name, Content) VALUES (?, ?, ?);";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([$email, $name, $comment]);
                }
                elseif (is_numeric($additionalIdentifier)) {
                    $query = "INSERT INTO replies (Email, Name, Content, Comment_FK) VALUES (?, ?, ?, ?);";
                    $stmt = $this->pdo->prepare($query);
                    $stmt->execute([$email, $name, $comment, $additionalIdentifier]);
                } else {
                // Handle the case where the identifier is neither "comment" nor a number
                throw new Exception("Invalid additional identifier");
                }

                // Redirect to the index.php page
                header("Location: ../index.php");
                exit();
            } catch (PDOException $e) {
                die("Query failed: " . $e->getMessage());
            }
        } else {
            // Redirect to the index.php page if it's not a POST request
            header("Location: ../index.php");
        }
    }
}

?>