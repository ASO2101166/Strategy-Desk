<?php
    require_once 'Dbconect.php';
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT * FROM user_table WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    if(!empty($searchArray)){
        
    }  
?>