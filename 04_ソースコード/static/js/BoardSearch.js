function search_board(e){
    let search_form = document.getElementById("search_form").value;
    const data = {
        search_form : search_form
    }
    fetch('../backend/BoardSelect.php', {
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
        let search_main = document.getElementById("search_main");
        while(search_main.firstChild){
            search_main.removeChild(search_main.firstChild);
        }
        let clone_search_board_area = document.getElementById("clone_search_board_area");
        res.forEach(function(data){
            let clone_area = clone_search_board_area.cloneNode(true);
            clone_area.hidden = false;
            clone_area.children[0].children[1].children[0].innerHTML = data[1];
            clone_area.children[0].children[0].value = data[0];
            for(let i = 0; i < data[2].length; i++){
                let tag_name = document.createElement("div");
                tag_name.className = "search_tag";
                tag_name.innerHTML = data[2][i];
                clone_area.children[0].children[1].children[1].appendChild(tag_name);
            }
            search_main.appendChild(clone_area);
        })
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}