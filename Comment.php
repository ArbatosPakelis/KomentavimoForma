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
                            <div><b>" . $this->row["Name"] . "</b></div>
                            <div class=\"Font2\" >" . $formattedDate . "</div>
                            <button class=\"replyButton\" onclick=\"toggleReplyForm(" . $this->row["Id"] . ")\">
                            <i style=\"font-size:24px\" class=\"fa\">&#xf112;</i>
                            </button>
                        </div>
                        <div class=\"Font1\">" . $this->row["Content"] . "</div> 
                        <div id=\"replyForm" . $this->row["Id"] . "\" style=\"display:none;\">";

        require_once 'CommentForm.php';
        $replyForm = new CommentForm();
        $output .= $replyForm->renderForm($this->row["Id"]);

        $output .= "    </div>
                        <script src=\"includes/Toggle.js\"></script>
                    </div><br>";

        $output .= $this->renderReplies($this->row["Id"]);

        return $output;
    }

    public function renderReply() {
        $createdAt = $this->row["CreatedAt"];
        $formattedDate = date("Y-m-d", strtotime($createdAt));

        $output = "<div class=\"reply\">
                        <div style=\"margin-bottom:10px\">
                            <div><b>" . $this->row["Name"] . "</b></div>
                            <div class=\"Font2\">" . $formattedDate . "</div>
                        </div>
                        <div class=\"Font1\">" . $this->row["Content"] . "</div> 
                    </div>";

        return $output;
    }

    private function renderReplies($commentID) {
        $query = "SELECT * FROM replies WHERE Comment_FK =" . $this->row["Id"] . "  ORDER BY CreatedAt DESC";
        $stmt = $this->pdo->prepare($query);

        $stmt->execute();
        $replySection = "";
        if ($stmt->rowCount() > 0) {
            $replySection = "<button class=\"replies\" onclick=\"toggleReply(" . $commentID . ")\"></button>
            <div class=\"replySection\" id=\"replySection" . $commentID . "\" style=\"display:none;\">";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $replyComment = new Comment($row, $this->pdo);
                $replySection .=  $replyComment->renderReply();
            }
            $replySection .= "</div><script src=\"includes/Toggle.js\"></script><br>";
        }
        return $replySection;
        $stmt = null;
    }
}

?>