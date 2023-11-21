
function toggleReplyForm(commentID) {
    var replyForm = document.getElementById("replyForm" + commentID);
    if (replyForm.style.display === "none") {
        replyForm.style.display = "block";
    } else {
        replyForm.style.display = "none";
    }
}