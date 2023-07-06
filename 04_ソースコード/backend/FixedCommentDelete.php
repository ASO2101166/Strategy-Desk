<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    require_once 'Dbconect.php';

    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "UPDATE comments SET fixed_comment = 0 WHERE board_id = ? AND comment_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$board_id,PDO::PARAM_INT);
    $ps->bindValue(2,$comment_id,PDO::PARAM_INT);
    $ps->execute();
    
?>