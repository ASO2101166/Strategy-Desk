<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconect.php';
    require_once 'UserInfo.php';
    if(!isset($_SESSION['user'])){
        header('Location: ../frontend/Login.php',true, 307);
        exit();
    }
    $user = unserialize($_SESSION['user']);
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "INSERT INTO comments (board_id, comment_id, comment_content, fixed_comment, comment_date, questionary_id, map_id, parent_board_id, parent_comment_id, user_id)
            VALUES(?,
                  (SELECT IFNULL(MAX(comment_id) + 1, 1) AS max_comment_id
                   FROM comments AS com 
                   WHERE board_id = ?), 
                   ?, false, cast(NOW() AS DATETIME), 0, ?, ?, ?, ?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['board_id'],PDO::PARAM_INT);
    $ps->bindValue(2,$_POST['board_id'],PDO::PARAM_INT);
    $ps->bindValue(3,$_POST['post_comment'],PDO::PARAM_STR);
    if(isset($_POST{'map_id'})){
        $ps->bindValue(4,$_POST['map_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(4,null,PDO::PARAM_NULL);
    }
    
    if(isset($_POST{'parent_board_id'})){
        $ps->bindValue(5,$_POST['parent_board_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(5,null,PDO::PARAM_NULL);
    }

    if(isset($_POST{'parent_comment_id'})){
        $ps->bindValue(6,$_POST['parent_comment_id'],PDO::PARAM_INT);
    }else{
        $ps->bindValue(6,null,PDO::PARAM_NULL);
    }
    $ps->bindValue(7,$user->user_id,PDO::PARAM_INT);
    $ps->execute();

    header('Location: ../frontend/Board.php',true, 307);
    exit();
?>