<?php
public function commntSelect($id){
    session_start();
    require_once 'Dbconect';
    $dbcon = new Dbcocect();
    $pdo = $dbcon->dbConnect();
    $sql = 'SELECT c.comment_id,c.commnt_content,c.comment_date,c.fixed_comment,c.comment_date,c.map_id,c.parent_comment_id,u.user_name FROM commnts AS c LEFT OUTER JOIN users AS u ON c.user_id = u.user_id WHERE c.board_id = ?';
    $ps->prepare($sql);
    $ps->bindValue(1,$id,PDO::PARAM_INT);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    return $searchArray;
}
?>