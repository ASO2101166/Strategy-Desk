<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'SessionCheck.php';
    require_once 'UserSelect.php';

    $ClsUserSelect = new UserSelect();
    $ClsSessionCheck = new SessionCheck();
    if($ClsSessionCheck->usersessioncheck() == true){
        header('Location: ../frontend/Home.php',true, 307);
        exit();
    }else{
        if($ClsUserSelect->userselectbynamepass($_POST['uname'], $_POST['upwd'])){
            header('Location: ../frontend/Home.php',true, 307);
            exit();
        }else{
            header('Location: ../frontend/Login.php?error',true, 307);
            exit();
        }
    }
?>