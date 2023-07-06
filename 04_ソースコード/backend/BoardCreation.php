<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconect.php';
    require_once 'UserInfo.php';
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $user = unserialize($_SESSION['user']);
    try{
        $pdo->beginTransaction();

        $sql = 'INSERT INTO boards(board_id,board_title,user_id) VALUES(null,?,?)';
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1,$_POST['title'],PDO::PARAM_STR);
        $ps->bindValue(2,$user->user_id,PDO::PARAM_INT);
        $ps->execute();
        $bid = $pdo->lastInsertId();
        $sql2 = 'INSERT INTO comments(board_id,comment_id,comment_content,fixed_comment,comment_date,map_id,parent_board_id,parent_comment_id,user_id)
                 VALUES(?,1,?,0,CURRENT_DATE,null,null,null,?)';
        
        $ps2 = $pdo->prepare($sql2);
        $ps2->bindValue(1,$bid,PDO::PARAM_INT);
        $ps2->bindValue(2,$_POST['first_comment'],PDO::PARAM_STR);
        $ps2->bindValue(3,$user->user_id,PDO::PARAM_INT);
        $ps2->execute();
        if(isset($_POST['tag'])){       
            $sql3 = 'INSERT INTO tags(tag_id,tag_name,board_id) VALUES(?,?,?)';
            foreach($_POST['tag'] as $row){
                $ps3 = $pdo->prepare($sql3);
                $ps3->bindValue(1,null,PDO::PARAM_INT);
                $ps3->bindValue(2,$row,PDO::PARAM_STR);
                $ps3->bindValue(3,$bid,PDO::PARAM_INT);
                $ps3->execute();
            }
        }
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
    }
    header('Location: ../frontend/Board.php',true, 307);
?>