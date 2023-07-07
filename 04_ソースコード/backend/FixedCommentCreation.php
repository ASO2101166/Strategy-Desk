<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "Dbconect.php";
    require_once "FixedCommentSelect.php";
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $dbcon = new Dbconect();
    $ClsFixedCommentSelect = new FixedCommentSelect();
    $pdo = $dbcon->dbConnect();
    $fixed_comment = $ClsFixedCommentSelect->fixedCommentCheck($data['board_id'],$data['comment_id']);
    foreach($fixed_comment as $fixed_comment){
        if($fixed_comment['fixed_comment'] == 0){
            $sql = "UPDATE comments SET fixed_comment = 1 WHERE board_id = ? AND comment_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
            $ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
            $ps->execute();
            $res = array('comment_id'=>$fixed_comment['comment_id'],
                         'user_name'=>$fixed_comment['user_name'],
                         'comment_date'=>$fixed_comment['comment_date'],
                         'comment_content'=>$fixed_comment['comment_content'],);
        }else{
            $res = "Already fixed!";
        }
    }
    
    
    echo json_encode($res);
?>