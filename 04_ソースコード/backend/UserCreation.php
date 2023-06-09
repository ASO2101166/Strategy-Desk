<?php
    require_once 'Dbconect.php';
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "INSERT INTO user_table(user_id,user_name,password) VALUES(?,?,?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['id'],PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['name'],PDO::PARAM_STR);
    $ps->bindValue(3,$_POST['pass'],PDO::PARAM_STR);
    $ps->execute();
?>