let tag_area,clone_tag,add_tag_button;
window.onload = function(){
    // ページ読み込み時に実行したい処理
    board_creation_form = document.getElementById("board_creation_form");
    clone_tag_area = document.getElementById("clone_tag_area");
    add_tag_button = document.getElementById("add_tag_button");
    add_tag_button.addEventListener("click", add_tag_area);
}
function add_tag_area(){
    clone_tag = clone_tag_area.cloneNode(true);
    clone_tag.firstElementChild.setAttribute("name", "tag[]");
    clone_tag.firstElementChild.required = true;
    clone_tag.style.display = "block";
    add_tag_button.before(clone_tag);
}
function delete_tag_area(e){
    e.target.parentNode.parentNode.remove();
}