<?php
    if(!isset($_SESSION)){
        sssion_start();
    }
    require_once 'Dbconnect.php';
    class QuestionnaireSelect {
        function questionariesSelect($user_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM questionaires AS q 
                    INNER JOIN questionary_details AS qd 
                    ON q.board_id = qd.board_id AND q.questionary_id = qd.questionary_id
                    INNER JOIN questionary_votes AS qv  
                    ON q.board_id = qv.board_id AND q.questionary_id = qv.questionary_id
                    WHERE ";
            $ps = $pdo->prepare($sql);
            
            $ps->execute();
        }
    }
    
?>