<?php
// $_POST['']で受け取った値を引数に入れる
public function boardSelect($searchword){
    require_once 'Dbconect';
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT * FROM board_table WHERE board_title LIKE ?
    OR board_id = (SELECT board_id FROM tags WHERE tag_name LIKE ?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,'%'+$searchword+'%',PDO::PARAM_STR);
    $ps->bindValue(2,'%'+$searchword+'%',PDO::PARAM_STR);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    if(isset($searchArray)){
        return $searchArray;
    }else{
        return "";
    }
}
?>