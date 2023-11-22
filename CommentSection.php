<?php

class CommentSection {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function renderComments() {
        $output = '';
        require_once 'Comment.php';
        $query = "SELECT * FROM comments ORDER BY CreatedAt DESC";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $comment = new Comment($row, $this->pdo);
                $output .= $comment->render();
            }
        }
        $pdo = null;
        $stmt = null;

        return $output;
    }
}

?>