let fixed_toggle_button = document.getElementById("fixed_toggle_button");
let fixed_status = document.getElementById("fixed_status");
let fixed_toggle_icon = document.getElementById("fixed_toggle_icon");
let add_fixed_button = document.querySelectorAll(".add_fixed_button");
let remove_fixed_button = document.querySelectorAll(".remove_fixed_button");
fixed_toggle_button.addEventListener("click", fixedtoggle);
function fixedtoggle(){
    if(fixed_status.innerHTML == "ON"){
        add_fixed_button.forEach(function(target){
            target.hidden = true;
        });
        remove_fixed_button.forEach(function(target){
            target.hidden = true;
        });
        fixed_toggle_icon.style.color = "gray";
        fixed_status.innerHTML = "OFF";
    }else{
        add_fixed_button.forEach(function(target){
            target.hidden = false;
        });
        remove_fixed_button.forEach(function(target){
            target.hidden = false;
        });
        fixed_toggle_icon.style.color = "#FFC122";
        fixed_status.innerHTML = "ON";
    }
}

function addfixedcomment(e,board_id,comment_id){
    e.currentTarget.children[0].style.color = "#FFC122";
    const data = {
        board_id: board_id,
        comment_id: comment_id,
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
            alert("既に固定コメントに登録されています");
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
        console.log(fixed_comment);
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}