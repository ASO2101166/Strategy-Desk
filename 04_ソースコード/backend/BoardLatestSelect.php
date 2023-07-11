<?php
public class BoardLatestSelect{
public function boardLatestSelect(){
    require_once 'Dbconect.php';
    $pdo = $dbcon->dbConnect();
    $sql = 'SELECT * FROM boards AS b INNER JOIN
     (SELECT board_id,MAX(comment_date) AS max_date FROM comments GROUP BY board_id) AS c
     ON b.board_id = c.board_id ORDER BY max_date DESC';
    $ps = $pdo->prepare($sql);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    return $searchArray;
}
}
?>