<?php
class BoardHistorySelect{
    public function boardHistorySelect(){
        if(isset($_COOKIE['history'])){
            $his_id = explode(',',$_COOKIE['history']);
            return $his_id;
    }else{
            return null;
        }
    }
    public function boardHistorySelectByHistoryBoardid($board_his){
        require_once 'Dbconect.php';
        $dbcon = new Dbconect();
        $pdo = $dbcon->dbConnect();
        foreach($board_his as $row){                                   
            $sql = "SELECT b.*, GROUP_CONCAT(t.tag_name) AS 'tags' FROM boards AS b
                    INNER JOIN tags AS t
                    ON b.board_id = t.board_id
                    WHERE b.board_id = ?
                    GROUP BY b.board_id;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,intval($row),PDO::PARAM_INT);
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
}
?>