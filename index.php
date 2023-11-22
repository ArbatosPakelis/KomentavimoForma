<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Comment Form</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#commentForm').on('submit', function (event) {
                    event.preventDefault();

                    // Store form data
                    var formData = $('#commentForm form').serialize();

                    // Perform Ajax request to submit the form
                    $.ajax({
                        url: 'includes/formhandler.inc.php',
                        method: 'POST',
                        data: formData,
                        success: function (response) {
                            // Perform Ajax request to renew comment section
                            $.ajax({
                                url: 'CommentSection.php',
                                method: 'GET',
                                success: function (comments) {
                                    $commentSectionRenderer->renderComments();
                                },
                                error: function (xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <hr>
        <h1>Comment form</h1>
        <hr>
        <?php
        // warning field
        if (isset($_SESSION['error_message'])) {
            echo '<div class="warning">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
        <div id="commentForm">
            <?php
            // comment form
            require_once 'CommentForm.php';
            $commentForm = new CommentForm();
            echo $commentForm->renderForm("comment");
            ?>
        </div>
        <div class="commentSection">
            <?php
                // comment section
                require_once "CommentSection.php";
                require_once 'includes/dbh.inc.php';
                $commentSectionRenderer = new CommentSection($pdo);
                echo $commentSectionRenderer->renderComments();
            ?>
        </div>
    </body>
</html>