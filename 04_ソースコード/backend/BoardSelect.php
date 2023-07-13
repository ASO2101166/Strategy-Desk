<?php
    require_once 'Dbconect.php';
    $dbcon = new Dbconect();

    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);
    
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT b.*, GROUP_CONCAT(t.tag_name) AS 'tags' FROM boards AS b
            INNER JOIN tags AS t
            ON b.board_id = t.board_id
            WHERE b.board_title LIKE ?
            OR b.board_id IN(SELECT DISTINCT(board_id) FROM tags
                            WHERE tag_name LIKE ?)
            GROUP BY b.board_id;";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,'%'.$data['search_form'].'%',PDO::PARAM_STR);
    $ps->bindValue(2,'%'.$data['search_form'].'%',PDO::PARAM_STR);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    $retArray = [];
    for($i = 0; $i < count($searchArray); $i++) {
        $retArray[$i][0] = $searchArray[$i]['board_id'];
        $retArray[$i][1] = $searchArray[$i]['board_title'];
        $tags = explode(",", $searchArray[$i]['tags']);
        for($j = 0; $j < count($tags); $j++){
            $retArray[$i][2][$j] = $tags[$j];
        }
    }
    $res = $retArray;
    echo json_encode($res);
?>