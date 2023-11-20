<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Comment Form</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <hr>
        <h1>Comment form</h1>
        <hr>
        <form action="includes/formhandler.inc.php" method="post">
            <div>
                <div class="firstLine">
                    <label for="first">Email</label>
                    <br>
                    <input type="text" id="first" name="email">
                </div>
                <div class="firstLine" style="padding-left:50px">
                    <label for="second">Name</label>
                    <br>
                    <input  type="text" id="second" name="name">
                </div>
            </div>
            <br>
            <div>
                <div class="secondLine">
                    <label for="comment">Comment</label>
                    <br>
                    <textarea class="big" type="text" name="comment">
                    </textarea>
                </div>
            </div>
            <br>
            <button class="submitButton"type="submit">Submit</button>
        </form>
        <div class="commentSection">
            <?php
            require_once "includes/dbh.inc.php";
            $query = "SELECT * FROM comments";
            $stmt = $pdo->prepare($query);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class=\"comment\">
                            <div style=\"margin-bottom:10px\">
                                <div>" . $row["Name"] . "</div>
                                <button class=\"replyButton\">Reply</button> 
                            </div>
                            <div>" . $row["Content"] . "</div> 
                        </div><br>";
                }
            }
            $pdo = null;
            $stmt = null;
            ?>
        </div>
    </body>
</html>