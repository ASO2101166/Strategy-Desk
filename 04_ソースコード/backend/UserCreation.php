<?php
    require_once 'Dbconect.php';
    require_once 'UserSelect.php';

    $dbcon = new Dbconect();
    $ClsUserSelect = new UserSelect();
    $pdo = $dbcon->dbConnect();
    $uname = $_POST['uname'];
    $upwd = $_POST['upwd'];
    if($ClsUserSelect->userselectcheckbynamepass($uname, $upwd)){
        header('Location: ../frontend/Signup.php?error',true, 307);
    }
    $sql = "INSERT INTO users(user_id,user_name,password) VALUES(null,?,?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$uname,PDO::PARAM_STR);
    $ps->bindValue(2,password_hash($upwd, PASSWORD_DEFAULT),PDO::PARAM_STR);
    $ps->execute();

    header('Location: ../frontend/Login.php?newcomplete',true, 307);
?>