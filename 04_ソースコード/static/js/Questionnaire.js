let tag_area,clone_tag,add_tag_button,user_id;
window.onload = function(){
    // ページ読み込み時に実行したい処理
    board_creation_form = document.getElementById("board_creation_form");
    clone_questionary_detail = document.getElementById("clone_questionary_detail");
    add_tag_button = document.getElementById("add_tag_button");
    add_tag_button.firstElementChild.addEventListener("click", add_tag_area);
    user_id = document.getElementById('user_id').value;
    console.log(user_id);
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
    fetch('../backend/QuestionnaireSelect.php', {
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
        let select_questionary_area = document.getElementById('select_questionary_area');
        console.log(res);
        console.log(new Date());
        console.log(new Date(res['questionary_date']));
        console.log((new Date() - new Date(res['questionary_date'])) / 1000);
        let time = document.getElementById("time");
        if((new Date() - new Date(res['questionary_date'])) / 1000 < 900){
            showQuestionarySelect();
            time.innerHTML = "残り" + Math.trunc((900 - (new Date() - new Date(res['questionary_date'])) / 1000) / 60) + "分" + Math.trunc((900 - (new Date() - new Date(res['questionary_date'])) / 1000) % 60) + "秒";
            let getquestionary_detail_id = getQuestionaryVote(res['board_id'],res['questionary_id'],user_id);
            let questionary_detail_id;
            getquestionary_detail_id.then(function(response){
                questionary_detail_id = response;
                select_questionary_area.children[0].innerHTML = res['questionary_title'];
                clone_select_questionary_detail_area = document.getElementById("clone_select_questionary_detail_area");
                console.log(questionary_detail_id);
                for(let i = 0; i < res['questionary_detail_id'].length; i++) {
                    clone_tag = clone_select_questionary_detail_area.cloneNode(true);
                    clone_tag.hidden = false;
                    if(typeof questionary_detail_id === "undefined"){
                        clone_tag.onclick = function(e) {
                            var argument1 = res['board_id'];
                            var argument2 = res['questionary_id'];
                            QuestionaryVote(e, argument1, argument2);
                        };
                    }
                    if(questionary_detail_id == res['questionary_detail_id'][i]){
                        clone_tag.style.backgroundColor = "aquamarine";
                    }
                    clone_tag.children[0].value = res['questionary_detail_id'][i];
                    clone_tag.children[1].innerHTML = res['questionary_detail'][i];
                    select_questionary_area.appendChild(clone_tag);
                }
            })
            
            
        }else{
            showQuestionaryCreate();
            if(res['questionary_status'] == 1){
                endQuestionnaire(res['board_id'], res['questionary_id']);
            }
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
async function getQuestionaryVote(board_id, questionary_id, user_id) {
    console.log(user_id);
    let retid;
    data = {
        board_id: board_id,
        questionary_id: questionary_id,
        user_id: user_id
    }
    await fetch('../backend/QuestionnaireUserSelect.php', {
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
        retid = res['questionary_detail_id'];
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
    return retid;
}
function showQuestionaryCreate() {
    let create_questionary_area = document.getElementById("create_questionary_area");
    create_questionary_area.hidden = false;
    console.log("!");
}
function QuestionaryVote(e, board_id, questionary_id){
    console.log(user_id);
    questionary_detail_id = e.currentTarget.children[0].value;
    e.currentTarget.style.backgroundColor = "aquamarine";
    let select_questionary_detail_area = document.querySelectorAll(".select_questionary_detail_area");
    select_questionary_detail_area.forEach(function(element) {
        element.onclick = () =>{
            return false;
        }
    })
    data = {
        board_id: board_id,
        questionary_id: questionary_id,
        questionary_detail_id: questionary_detail_id,
        user_id: user_id,
    }
    fetch('../backend/QuestionnaireVote.php', {
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

    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}
function endQuestionnaire(board_id, questionary_id){
    data = {
        board_id: board_id,
        questionary_id: questionary_id,
        user_id: user_id
    }
    fetch('../backend/QuestionnaireCommentPost.php', {
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

    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}