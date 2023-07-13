<?php
class BoardLatestSelect{
    function boardLatestSelect(){
        require_once 'Dbconect.php';
        $dbcon = new Dbconect();
        $pdo = $dbcon->dbConnect();
        $sql = "SELECT b.*, GROUP_CONCAT(t.tag_name) AS 'tags', max_date FROM boards AS b
                INNER JOIN tags AS t
                ON b.board_id = t.board_id
                INNER JOIN (SELECT board_id,MAX(comment_date) AS max_date FROM comments GROUP BY board_id) AS c
                ON b.board_id = c.board_id
                GROUP BY b.board_id
                ORDER BY max_date DESC";
            
        // $sql = 'SELECT * FROM boards AS b INNER JOIN
        //     (SELECT board_id,MAX(comment_date) AS max_date FROM comments GROUP BY board_id) AS c
        //     ON b.board_id = c.board_id ORDER BY max_date DESC';
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        $retArray = [];
        for($i = 0; $i < count($searchArray); $i++) {
            $retArray[$i]['board_id'] = $searchArray[$i]['board_id'];
            $retArray[$i]['board_title'] = $searchArray[$i]['board_title'];
            $tags = explode(",", $searchArray[$i]['tags']);
            for($j = 0; $j < count($tags); $j++){
                $retArray[$i]['tag_name'][$j] = $tags[$j];
            }
        }
        return $retArray;
    }
}
?>