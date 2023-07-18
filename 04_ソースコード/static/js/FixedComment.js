let fixed_toggle_button = document.getElementById("fixed_toggle_button");
let fixed_toggle_icon = document.getElementById("fixed_toggle_icon");
let add_fixed_button = document.querySelectorAll(".add_fixed_button");
let remove_fixed_button = document.querySelectorAll(".remove_fixed_button");
fixed_toggle_button.addEventListener("click", fixedtoggle);
function fixedtoggle(){
    add_fixed_button = document.querySelectorAll(".add_fixed_button");
    remove_fixed_button = document.querySelectorAll(".remove_fixed_button");
    if(user_id == 0){
        alert("固定コメント機能を使うにはログインをしてください！");
        return;
    }
    if(fixed_toggle_button.checked == false){
        add_fixed_button.forEach(function(target){
            target.hidden = true;
        });
        remove_fixed_button.forEach(function(target){
            target.hidden = true;
        });
    }else{
        add_fixed_button.forEach(function(target){
            target.hidden = false;
        });
        remove_fixed_button.forEach(function(target){
            target.hidden = false;
        });
    }
}

function addfixedcomment(e,board_id,comment_id,user_id){
    e.currentTarget.children[0].style.color = "#FFC122";
    const data = {
        board_id: board_id,
        comment_id: comment_id,
        user_id: user_id
    }
    fetch('../backend/FixedCommentCreation.php', {
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
        if(res == "Already fixed!"){
            alert("既に固定コメントに登録されています!");
            console.log(res);
            clone_tag = clone_fixed_comment.cloneNode(true)
            clone_fixed_comment = document.getElementById("clone_fixed_comment");
            
        }else{
            clone_fixed_comment = document.getElementById("clone_fixed_comment");
            clone_tag = clone_fixed_comment.cloneNode(true);
            clone_tag.children[0].children[0].innerHTML = res['comment_id'];
            clone_tag.children[0].children[1].innerHTML = res['user_name'];
            clone_tag.children[0].children[2].innerHTML = res['comment_date'];
            clone_tag.children[0].children[3].onclick = function(e) {
                var argument1 = res['board_id'];
                var argument2 = res['comment_id'];
                removefixedcomment(e,argument1, argument2);
            };
            clone_tag.children[1].children[0].innerHTML = res['comment_content'];
            clone_tag.children[2].children[0].value = res['user_evaluation'];
            clone_tag.children[2].children[1].onclick = function(e) {
                fixedCommentGood(e, res['board_id'], res['comment_id'], res['user_id'], res['user_evaluation']);
            };
            clone_tag.children[2].children[2].onclick = function(e) {
                fixedCommentBad(e, res['board_id'], res['comment_id'], res['user_id'], res['user_evaluation']);
            };
            if(res['user_evaluation'] == 1){
                clone_tag.children[2].children[1].children[0].hidden = true;
            }
            if(res['user_evaluation'] != 1){
                clone_tag.children[2].children[1].children[1].hidden = true;
            }
            if(res['user_evaluation'] == 0){
                clone_tag.children[2].children[2].children[0].hidden = true;
            }
            if(res['user_evaluation'] != 0){
                clone_tag.children[2].children[2].children[1].hidden = true;
            }
            clone_tag.children[2].children[1].children[2].innerHTML = res['fixed_comment_count_high'];
            clone_tag.children[2].children[2].children[2].innerHTML = res['fixed_comment_count_low'];
            clone_tag.removeAttribute("id");
            clone_tag.setAttribute("class", "fixed_comment");
            clone_tag.style.display = "block";
            clone_fixed_comment.before(clone_tag);
        }
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}
function removefixedcomment(e,board_id,comment_id){
    let remove_fixed_button = e.currentTarget;
    let comment_number = document.querySelectorAll('.comment_number');
    let fixed_comment_number = e.currentTarget.parentElement.children[0].innerHTML;
    comment_number.forEach(function(a){
        if(a.innerHTML.substr(3,a.innerHTML.length - 3) == fixed_comment_number){ 
            a.parentElement.children[3].children[0].style.color = "gray";
        }
    });
    const data = {
        board_id: board_id,
        comment_id: comment_id,
    }
    fetch('../backend/FixedCommentDelete.php', {
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
        let fixed_comment = remove_fixed_button.parentElement.parentElement;
        fixed_comment.remove();
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}
function fixedCommentGood(e, board_id, comment_id, user_id, user_evaluation){
    if(user_id == 0){
        alert("コメント評価機能を使うにはログインをしてください！");
        return;
    }
    let cTarget = e.currentTarget;
    cTarget.disabled = true;
    cTarget.parentElement.children[2].disabled = true;
    console.log(user_evaluation);
    const data = {
        board_id: board_id,
        comment_id: comment_id,
        user_id: user_id,
        user_evaluation: user_evaluation,
        evaluation: 1
    }
    switch(user_evaluation){
        case -1:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.children[0].hidden = true;
                cTarget.children[1].hidden = false;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) + 1;
                cTarget.onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, 1);
                };
                cTarget.parentElement.children[2].onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, 1);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[2].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
        case 0:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.parentElement.children[2].children[0].hidden = false;
                cTarget.parentElement.children[2].children[1].hidden = true;
                cTarget.children[0].hidden = true;
                cTarget.children[1].hidden = false;
                cTarget.parentElement.children[2].children[2].innerHTML = Number(cTarget.parentElement.children[2].children[2].innerHTML) - 1;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) + 1;
                cTarget.onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, 1);
                };
                cTarget.parentElement.children[2].onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, 1);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[2].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
        case 1:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.children[0].hidden = false;
                cTarget.children[1].hidden = true;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) - 1;
                cTarget.onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, -1);
                };
                cTarget.parentElement.children[2].onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, -1);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[2].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
    }
}
function fixedCommentBad(e, board_id, comment_id, user_id, user_evaluation){
    let cTarget = e.currentTarget;
    cTarget.disabled = true;
    cTarget.parentElement.children[1].disabled = true;
    console.log(user_evaluation);
    const data = {
        board_id: board_id,
        comment_id: comment_id,
        user_id: user_id,
        user_evaluation: user_evaluation,
        evaluation: 0
    }
    switch(user_evaluation){
        case -1:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.children[0].hidden = true;
                cTarget.children[1].hidden = false;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) + 1;
                cTarget.onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, 0);
                };
                cTarget.parentElement.children[1].onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, 0);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[1].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
        case 0:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.children[0].hidden = false;
                cTarget.children[1].hidden = true;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) - 1;
                cTarget.onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, -1);
                };
                cTarget.parentElement.children[1].onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, -1);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[1].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
        case 1:
            fetch('../backend/FixedCommentEvaluationUpdate.php', {
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
                cTarget.parentElement.children[1].children[0].hidden = false;
                cTarget.parentElement.children[1].children[1].hidden = true;
                cTarget.children[0].hidden = true;
                cTarget.children[1].hidden = false;
                cTarget.parentElement.children[1].children[2].innerHTML = Number(cTarget.parentElement.children[1].children[2].innerHTML) - 1;
                cTarget.children[2].innerHTML = Number(cTarget.children[2].innerHTML) + 1;
                cTarget.onclick = function(e) {
                    fixedCommentBad(e, board_id, comment_id, user_id, 0);
                };
                cTarget.parentElement.children[1].onclick = function(e) {
                    fixedCommentGood(e, board_id, comment_id, user_id, 0);
                };
                cTarget.disabled = false;
                cTarget.parentElement.children[1].disabled = false;
            })
            .catch(error => {
                console.log(error); // エラー表示
            });
            break;
    }
}