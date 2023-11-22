// toggle reply form visability
function toggleReplyForm(commentID) {
    var replyForm = document.getElementById("replyForm" + commentID);
    if (replyForm.style.display === "none") {
        replyForm.style.display = "block";
    } else {
        replyForm.style.display = "none";
    }
}

// togle visability of replies section
function toggleReply(commentID) {
    var reply = document.getElementById("replySection" + commentID);
    if (reply) {
        if (reply.style.display === "none") {
            reply.style.display = "block";
        } else {
            reply.style.display = "none";
        }
    } else {
        console.error("Element not found with ID: replySection" + commentID);
    }
}