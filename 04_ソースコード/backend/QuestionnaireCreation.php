<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconect.php';

    $board_id = $_POST['board_id'];
    $questionary_title = $_POST['questionary_title'];
    $questionary_detail = $_POST['questionary_detail'];

    questionnairesCreate($board_id, $questionary_title, $questionary_detail);

    function questionnairesCreate($board_id, $questionary_title, $questionary_detail){
        $cls = new Dbconect();
        $pdo = $cls->dbConnect();
        try{
            $pdo->beginTransaction();
            $sql = "SELECT IFNULL(MAX(questionary_id) + 1, 1) AS max_questionary_id
                    FROM questionaires
                    WHERE board_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $board_id, PDO::PARAM_INT);
            $ps->execute();
            $searchquestionary_id = $ps->fetch();
            $questionary_id = $searchquestionary_id['max_questionary_id'];

            $sql2 = "SELECT IFNULL(MAX(questionary_detail_id) + 1, 1) AS max_questionary_detail_id
                    FROM questionary_details
                    WHERE board_id = ? AND questionary_id = ?;";
            $ps2 = $pdo->prepare($sql2);
            $ps2->bindValue(1, $board_id, PDO::PARAM_INT);
            $ps2->bindValue(2, $questionary_id, PDO::PARAM_INT);
            $ps2->execute();
            $searchquestionary_detail_id = $ps2->fetch();
            $questionary_detail_id = $searchquestionary_detail_id['max_questionary_detail_id'];

            $sql3 = "INSERT INTO questionaires (board_id, questionary_id, questionary_title, questionary_date) VALUES 
                    (?, ?, ?, cast(NOW() AS DATETIME))";
            $ps3 = $pdo->prepare($sql3);
            $ps3->bindValue(1, $board_id, PDO::PARAM_INT);
            $ps3->bindValue(2, $questionary_id, PDO::PARAM_INT);
            $ps3->bindValue(3, $questionary_title, PDO::PARAM_STR);
            $ps3->execute();
            for($i = 1; $i <= count($questionary_detail); $i++){
                $sql4 = "INSERT INTO questionary_details (board_id, questionary_id, questionary_detail_id, questionary_detail, questionary_votes) VALUES
                        (?, ?, ?, ?, 0);";
                $ps4 = $pdo->prepare($sql4);
                $ps4->bindValue(1, $board_id, PDO::PARAM_INT);
                $ps4->bindValue(2, $questionary_id, PDO::PARAM_INT);
                $ps4->bindValue(3, $questionary_detail_id, PDO::PARAM_INT);
                $ps4->bindValue(4, $questionary_detail[$i-1], PDO::PARAM_INT);
                $ps4->execute();
                $questionary_detail_id++;
            }
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
        }
    }
    
?>