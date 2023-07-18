<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class FixedCommentEvaluationSelect {
        public function fixedCommentEvaluationSelect($board_id, $comment_id) {
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT COUNT(*) AS high, (SELECT COUNT(*) FROM comment_evaluations
                                              WHERE board_id = ? AND comment_id = ? AND evaluation = 0) AS low
                    FROM comment_evaluations 
                    WHERE board_id = ? AND comment_id = ? AND evaluation = 1";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->bindValue(2,$comment_id,PDO::PARAM_INT);
            $ps->bindValue(3,$board_id,PDO::PARAM_INT);
            $ps->bindValue(4,$comment_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            return $searchArray;
        }
        public function fixedCommentEvaluationUser($board_id, $comment_id, $user_id){
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT * FROM comment_evaluations 
                    WHERE board_id = ? AND comment_id = ? AND user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->bindValue(2,$comment_id,PDO::PARAM_INT);
            $ps->bindValue(3,$user_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            if(empty($searchArray)){
                $searchArray[0]['evaluation'] = -1;
            }
            return $searchArray;
        }
    }
?>