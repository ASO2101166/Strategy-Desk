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
let fixed_toggle_button = document.getElementById("fixed_toggle_button");
let fixed_status = document.getElementById("fixed_status");
let fixed_toggle_icon = document.getElementById("fixed_toggle_icon");
let add_fixed_button = document.querySelectorAll(".add_fixed_button");
let remove_fixed_button = document.getElementById("remove_fixed_button");
fixed_toggle_button.addEventListener("click", fixedtoggle);
function fixedtoggle(){
    if(fixed_status.innerHTML == "ON"){
        add_fixed_button.forEach(function(target){
            target.hidden = true;
        });
        remove_fixed_button.hidden = true;
        fixed_toggle_icon.style.color = "gray";
        fixed_status.innerHTML = "OFF";
    }else{
        add_fixed_button.forEach(function(target){
            target.hidden = false;
        });
        remove_fixed_button.hidden = false;
        fixed_toggle_icon.style.color = "#FFC122";
        fixed_status.innerHTML = "ON";
    }
}