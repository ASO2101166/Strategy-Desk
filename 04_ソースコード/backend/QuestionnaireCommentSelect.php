<?php
    class QuestionnaireCommentSelect {
        public function questionnaireCommentSelect($board_id, $questionary_id){
            require_once 'Dbconect.php';
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT q.*, GROUP_CONCAT(qd.questionary_detail) AS questionary_details,
                     GROUP_CONCAT(qd.questionary_votes) AS questionary_votes, SUM(qd.questionary_votes) AS sum_votes
                    FROM questionaires AS q
                    INNER JOIN questionary_details AS qd
                    ON q.board_id = qd.board_id
                    AND q.questionary_id = qd.questionary_id
                    WHERE q.board_id = ? AND q.questionary_id = ?
                    GROUP BY q.board_id, q.questionary_id";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$board_id,PDO::PARAM_INT);
            $ps->bindValue(2,$questionary_id,PDO::PARAM_INT);
            $ps->execute();
            $searchArray=$ps->fetch();
            $retArray = [];
            $retArray['questionary_title'] = $searchArray['questionary_title'];
            $retArray['sum_votes'] = $searchArray['sum_votes'];
            $questionary_detail = explode(",", $searchArray['questionary_details']);
            $questionary_votes = explode(",", $searchArray['questionary_votes']);
            for($j = 0; $j < count($questionary_detail); $j++){
                $retArray['questionary_detail'][$j] = $questionary_detail[$j];
                $retArray['questionary_votes'][$j] = $questionary_votes[$j];
                if($searchArray['sum_votes'] == 0){
                    $searchArray['sum_votes'] = 1;
                }
                $retArray['questionary_percent'][$j] = $questionary_votes[$j] / $searchArray['sum_votes'] * 100;

                
            }
            return $retArray;
        }
    }
?>