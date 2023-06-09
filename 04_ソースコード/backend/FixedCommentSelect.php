<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class FixedCommentSelect {
        
        public function fixedCommentSelect($board_id) {
            require_once 'Dbconect.php';
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT * FROM comments AS c 
                             INNER JOIN users AS u
                             ON c.user_id = u.user_id
                    WHERE c.board_id = ? AND c.fixed_comment = 1;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();
            return $searchArray;
        }
        public function fixedCommentCheck($board_id, $comment_id) {
            require_once 'Dbconect.php';
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT * FROM comments AS c 
                    INNER JOIN users AS u
                    ON c.user_id = u.user_id
                    WHERE c.board_id = ? AND c.comment_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->bindValue(2,$comment_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();
            return $searchArray;
        }
        public function fixedCommentEvaluationsSelect($board_id, $comment_id) {
            require_once 'Dbconect.php';
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT COUNT(*) AS high, (SELECT COUNT(*) FROM comment_evaluations
                                              WHERE WHERE board_id = ? AND comment_id = ? AND evaluation = 0) AS low
                    FROM comment_evaluations 
                    WHERE board_id = ? AND comment_id = ? AND evaluation = 1";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->bindValue(1,$comment_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();
        }
    }
?>