<?php
    require_once 'Dbconect.php';
    $pdo = dbConnect();
    $sql = "INSERT INTO user_table(user_id,user_name,password) VALUES(?,?,?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$id,PDO::PARAM_INT);
    $ps->bindValue(2,$name,PDO::PARAM_STR);
    $ps->bindValue(3,$pass,PDO::PARAM_STR);
    $ps->execute();
?>