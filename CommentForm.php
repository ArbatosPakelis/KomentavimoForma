<?php

class CommentForm {
    public function renderForm($additionalIdentifier) {
        return '
        <form action="includes/formhandler.inc.php" method="post">
            <div>
                <input type="hidden" name="additional_identifier" value="' .
                 htmlspecialchars($additionalIdentifier) . '">
                <div class="firstLine">
                    <label for="email">Email</label>
                    <br>
                    <input type="text" id="email" name="email">
                </div>
                <div class="firstLine" style="padding-left:50px">
                    <label for="name">Name</label>
                    <br>
                    <input  type="text" id="name" name="name">
                </div>
            </div>
            <br>
            <div>
                <div class="secondLine">
                    <label for="comment">Comment</label>
                    <br>
                    <textarea class="big" type="text" name="comment"></textarea>
                </div>
            </div>
            <br>
            <button class="submitButton" type="submit">Submit</button>
        </form>';
    }
}

?>