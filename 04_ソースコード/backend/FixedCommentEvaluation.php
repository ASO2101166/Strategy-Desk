<?php
    // if(!isset($_SESSION)){
    //     session_start();
    // }
    // class FixedCommentEvaluation {

    //     public function fixedCommentHighEvaluation($board_id) {
    //         require_once 'Dbconect.php';

    //         $dbcon = new Dbconect();
    //         $pdo = $dbcon->dbConnect();
    //         $sql = "SELECT * FROM comments 
    //                 WHERE board_id = ? AND fixed_comment = 1";
    //         $ps = $pdo->prepare($sql);
    //         $ps->bindValue(1,$board_id,PDO::PARAM_INT);
    //         $ps->execute();
    //         $searchArray=$ps->fetchAll();
    //     }
    //     public function fixedCommentLowEvaluation($board_id) {
    //         $dbcon = new Dbconect();
    //         $pdo = $dbcon->dbConnect();
    //         $sql = "SELECT COUNT(*) AS high, (SELECT COUNT(*) FROM comment_evaluations
    //                                           WHERE WHERE board_id = ? AND comment_id = ? AND evaluation = 0) AS low
    //                 FROM comment_evaluations 
    //                 WHERE board_id = ? AND comment_id = ? AND evaluation = 1";
    //         $ps = $pdo->prepare($sql);
    //         $ps->bindValue(1,$board_id,PDO::PARAM_INT);
    //         $ps->bindValue(1,$comment_id,PDO::PARAM_INT);
    //         $ps->execute();
    //         $searchArray=$ps->fetchAll();
    //     }
    // }
?>