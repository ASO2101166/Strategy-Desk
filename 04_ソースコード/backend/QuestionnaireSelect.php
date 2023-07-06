<?php
    if(!isset($_SESSION)){
        sssion_start();
    }
    require_once 'Dbconnect.php';
    class QuestionnaireSelect {
        function questionariesSelect($user_id){
            $cls = new Dbconnect();
            $pdo = $cls->dbConnect();
            $sql = "SELECT * FROM questionaires WHERE ";
            $ps = $pdo->prepare($sql);
            
            $ps->execute();
        }
    }
    
?>