<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    require_once 'Dbconect.php';

    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "UPDATE comments SET fixed_comment = 0 WHERE board_id = ? AND comment_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
    $ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
    $ps->execute();
    
    if(!isset($_SESSION)){
        session_start();
    }
    
    $res = "Delete!";
    echo json_encode($res);
?>