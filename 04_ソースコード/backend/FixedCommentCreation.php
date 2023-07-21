<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once "Dbconect.php";
    require_once "FixedCommentSelect.php";
    require_once 'FixedCommentEvaluationSelect.php';
    require_once 'Sanitize.php';
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $dbcon = new Dbconect();
    $ClsFixedCommentSelect = new FixedCommentSelect();
    $ClsFixedCommentEvaluationSelect = new FixedCommentEvaluationSelect();
    $ClsSanitize = new Sanitize();
    $pdo = $dbcon->dbConnect();

    $fixed_comment = $ClsFixedCommentSelect->fixedCommentCheck($data['board_id'],$data['comment_id']);
    $fixed_comment_count = $ClsFixedCommentEvaluationSelect->fixedCommentEvaluationSelect($data['board_id'], $data['comment_id']);
    $fixed_comment_user = $ClsFixedCommentEvaluationSelect->fixedCommentEvaluationUser($data['board_id'], $data['comment_id'], $data['user_id']);
    foreach($fixed_comment as $fixed_comment){
        if($fixed_comment['fixed_comment'] == 0){
            $sql = "UPDATE comments SET fixed_comment = 1 WHERE board_id = ? AND comment_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
            $ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
            $ps->execute();
            $res = array('comment_id'=>$fixed_comment['comment_id'],
                         'user_id'=>$fixed_comment['user_id'],
                         'user_name'=>$fixed_comment['user_name'],
                         'comment_date'=>$fixed_comment['comment_date'],
                         'comment_content'=>$ClsSanitize->sanitize_br($fixed_comment['comment_content']),
                         'board_id'=>$fixed_comment['board_id'],
                         'comment_id'=>$fixed_comment['comment_id'],
                         'user_evaluation'=>$fixed_comment_user[0]['evaluation'],
                         'fixed_comment_count_high'=>$fixed_comment_count[0]['high'],
                         'fixed_comment_count_low'=>$fixed_comment_count[0]['low']
                        );
        }else{
            $res = "Already fixed!";
        }
    }
    
    
    
    echo json_encode($res);
?>