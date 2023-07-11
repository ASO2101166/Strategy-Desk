$(function(){
    $('.plus').click(function(){
        $(this).toggleClass("show");
    });
});
let post_comment = document.getElementById("post_comment");
post_comment.addEventListener("focus", gotfocus);
post_comment.addEventListener("blur", lostfocus);
function gotfocus(){
    this.rows = "3";
}
function lostfocus(){
    if( this.value.length == 0 ) {
        this.rows = "1";
    }
}
