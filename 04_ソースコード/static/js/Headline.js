let search_form = document.getElementById("search_form");
let boardsearch_background = document.getElementById("boardsearch_background");
let add_boardsearch_area = document.getElementById("add_boardsearch_area");
let search_button = document.getElementById("search_button");
search_form.addEventListener("focus", gotfocus);
search_form.addEventListener("blur", lostfocus);
function gotfocus(){
    boardsearch_background.hidden = false;
    add_boardsearch_area.hidden = false;
    search_button.hidden = false;
}
function lostfocus(){
    if( this.value.length == 0 ) {
        boardsearch_background.hidden = true;
        add_boardsearch_area.hidden = true;
        search_button.hidden = true;
    }
}