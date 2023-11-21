<?php
class Comment {
    private $row;

    public function __construct($row, $pdo) {
        $this->row = $row;
        $this->pdo = $pdo;
    }

    public function render() {
        $createdAt = $this->row["CreatedAt"];
        $formattedDate = date("Y-m-d", strtotime($createdAt));

        $output = "<div class=\"comment\">
                        <div style=\"margin-bottom:10px\">
                            <div>" . $this->row["Name"] . "</div>
                            <div>" . $formattedDate . "</div>
                            <button class=\"replyButton\" onclick=\"toggleReplyForm(" . $this->row["Id"] . ")\">Reply</button>
                        </div>
                        <div>" . $this->row["Content"] . "</div> 
                        <div id=\"replyForm" . $this->row["Id"] . "\" style=\"display:none;\">";

        require_once 'CommentForm.php';
        $replyForm = new CommentForm();
        $output .= $replyForm->renderForm($this->row["Id"]);

        $output .= "    </div>
                        <script src=\"includes/ToggleForm.js\"></script>
                    </div><br>";

        $output .= $this->renderReplies();

        return $output;
    }

    public function renderReply() {
        $createdAt = $this->row["CreatedAt"];
        $formattedDate = date("Y-m-d", strtotime($createdAt));

        $output = "<div class=\"comment\">
                        <div style=\"margin-bottom:10px\">
                            <div>" . $this->row["Name"] . "</div>
                            <div>" . $formattedDate . "</div>
                        </div>
                        <div>" . $this->row["Content"] . "</div> 
                    </div><br>";

        return $output;
    }

    private function renderReplies() {
        $query = "SELECT * FROM replies WHERE Comment_FK =" . $this->row["Id"] . "  ORDER BY CreatedAt DESC";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();
        $replySection = "<div class=\"replySection\">";
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $replyComment = new Comment($row, $this->pdo);
                $replySection .=  $replyComment->renderReply();
            }
        }
        $replySection .= "</div>";
        return $replySection;
        $stmt = null;
    }
}

?>