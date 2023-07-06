<?php
    session_start();

    require_once "Dbconect.php";
    $dbm=new Dbconect();

    $userData=$dbm->cheLoginByMailAndPass($_POST['umail'],$_POST['upsw']);
    foreach($userData as $row){
        $_SESSION['usermail']=$row['user_mail'];
        $_SESSION['username']=$row['user_name'];
        header('Location:Home.php');
    }
    if(count($userData)==0){
        header('Location:Login.php');
    }
?>