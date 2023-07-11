function search_board(e){
    const data = {
        
    }
    fetch('', {
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
        
    })
    .catch(error => {
        console.log(error); // エラー表示
    });
}