<?php
    class CommentSelect {
        public function commentSelect($board_id){
            require_once 'Dbconect.php';
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT c.comment_id,c.comment_content,c.comment_date,c.fixed_comment,c.comment_date,c.map_id,c.parent_comment_id,u.user_name 
                    FROM comments AS c LEFT OUTER JOIN users 
                    AS u ON c.user_id = u.user_id 
                    WHERE c.board_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            return $searchArray;
        }
    }
?>