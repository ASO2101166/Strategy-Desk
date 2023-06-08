<?php
    require_once 'Dbconect.php';
    $pdo = dbConnect();
    $sql = "SELECT * FROM user_table WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$id,PDO::PARAM_INT);
    $ps->execute();
    $searchArray=$ps->fetchAll();
?>