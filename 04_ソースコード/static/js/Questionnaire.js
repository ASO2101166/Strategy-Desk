let tag_area,clone_tag,add_tag_button;
window.onload = function(){
    // ページ読み込み時に実行したい処理
    board_creation_form = document.getElementById("board_creation_form");
    clone_questionary_detail = document.getElementById("clone_questionary_detail");
    add_tag_button = document.getElementById("add_tag_button");
    add_tag_button.firstElementChild.addEventListener("click", add_tag_area);

    questionaryCheck();
    
}
function add_tag_area(){
    clone_tag = clone_questionary_detail.cloneNode(true);
    clone_tag.firstElementChild.setAttribute("name", "questionary_detail[]");
    clone_tag.firstElementChild.required = true;
    clone_tag.style.display = "block";
    add_tag_button.before(clone_tag);
}
function delete_questionary_detail(e){
    e.currentTarget.parentNode.remove();
}

function questionaryCheck(){
    let board_id = document.getElementById('board_id').value;
    data = {
        board_id: board_id
    }
    fetch('../backend/QuestionnaireTimeSelect.php', {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then((response) => {
        if(!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }   
        return response.json()
    })
    .then(res => {
        console.log(res);
        console.log(new Date());
        console.log(new Date(res));
        console.log((new Date() - new Date(res)) / 1000);
        if((new Date() - new Date(res)) / 1000 < 900){
            showQuestionarySelect();
        }else{
            showQuestionaryCreate();
            
        }
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}
function showQuestionarySelect() {
    let select_questionary_area = document.getElementById("select_questionary_area");
    select_questionary_area.hidden = false;
    console.log("?");
}
function showQuestionaryCreate() {
    let create_questionary_area = document.getElementById("create_questionary_area");
    create_questionary_area.hidden = true;
    console.log("!");
}