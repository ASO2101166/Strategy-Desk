<?php
    session_start();
    require_once 'Dbconect';
    $dbcon = new Dbcocect();
    $pdo = $dbcon->dbConnect();
    $sql = "INSERT INTO baords(board_id,board_title,user_id) VALUES(null,?,?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$_POST['title'],PDO::PARAM_STR);
    $ps->bindValue(2,$_SESSION['user_id'],PDO::PARAM_INT);
    $ps->execute();
    $bid = $pdo->lastInsertId();
    $sql2 = "INSERT INTO comments(board_id,comment_id,comment_content,fixed_comment,comment_date,map_id,parent_board_id,parent_comment_id,user_id)
    VALUES($bid,1,$_POST['first_comment'],false,CURRENT_DATE,null,null,null,$_SESSION['user_id'])";
    $ps = $pdo->prepare($sql2);
    if(isset($_POST['tag'])){       
        $sql3 = "INSERT INTO tags(tag_id,tag_name,board_id) VALUES(?,?,?)";
        foreach($_POST['tag'] as $row){
            $ps = $pdo->prepare($sql3);
            $ps->bindValue(1,null,PDO::PARAM_INT);
            $ps->bindValue(2,$row,PDO::PARAM_STR);
            $ps->bindValue(3,$bid,PDO::PARAM_INT);
            $ps->execute();
        }
    }
?>