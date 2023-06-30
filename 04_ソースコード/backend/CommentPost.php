<?php
    session_start();
    require_once 'Dbconect';
    $dbcon = new Dbcocect();
    $pdo = $dbcon->dbConnect();
    $sql = 'INSERT INTO comments (board_id,comment_id,comment_content,fixed_comment,comment_date,map_id,parent_board_id,parent_comment_id,user_id)
    VALUES(?,(SELECT MAX(comment_id) FROM commnts)+1,?,false,CURRENT_DATE,?,?,?,$_SESSION['user_id'])';
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST[''],PDO::PARAM_INT);
    $ps->bindValue(2,$_POST[''],PDO::PARAM_STR);
    if(isset($_POST{'map_id'})){
        $ps->bindValue(3,$_POST['map_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(3,null,PDO::PARAM_NULL);
    }
    
    if(isset($_POST{'parent_board_id'})){
        $ps->bindValue(4,$_POST['parent_board_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(4,null,PDO::PARAM_NULL);
    }

    if(isset($_POST{'parent_comment_id'})){
        $ps->bindValue(5,$_POST['parent_comment_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(5,null,PDO::PARAM_NULL);
    }
    $ps->execute();
?>