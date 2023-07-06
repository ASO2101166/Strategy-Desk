let tag_area,clone_tag,add_tag_button;
window.onload = function(){
    // ページ読み込み時に実行したい処理
    board_creation_form = document.getElementById("board_creation_form");
    tag_area = document.getElementById("tag_area");
    add_tag_button = document.getElementById("add_tag_button");
    add_tag_button.firstElementChild.addEventListener("click", add_tag_area);
}
function add_tag_area(){
    clone_tag = tag_area.cloneNode(true);
    clone_tag.firstElementChild.setAttribute("name", "tag[]");
    clone_tag.firstElementChild.required = true;
    clone_tag.style.display = "block";
    add_tag_button.before(clone_tag);
    delete_tag_button = document.querySelectorAll(".delete_tag_button");
    delete_tag_button.forEach(function(target){
        target.addEventListener("click", delete_tag_area);
    });
}
function delete_tag_area(e){
    console.log();
    e.target.parentNode.parentNode.parentNode.remove();
}