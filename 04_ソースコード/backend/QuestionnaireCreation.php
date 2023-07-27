<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconect.php';
    if(!isset($_SESSION['user'])){
        header('Location: ../frontend/Login.php',true, 307);
        exit();
    }
    $board_id = $_POST['board_id'];
    $questionary_title = $_POST['questionary_title'];
    $questionary_detail = $_POST['questionary_detail'];
    $user_id = $_POST['user_id'];
    questionnairesCreate($board_id, $questionary_title, $questionary_detail, $user_id);

    function questionnairesCreate($board_id, $questionary_title, $questionary_detail, $user_id){
        $cls = new Dbconect();
        $pdo = $cls->dbConnect();
        try{
            $pdo->beginTransaction();
            $sql = "SELECT questionary_status
                    FROM questionaires
                    WHERE board_id = ?
                    AND questionary_id = (SELECT MAX(questionary_id)
                                          FROm questionaires AS q
                                          WHERE board_id = ?);";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $board_id, PDO::PARAM_INT);
            $ps->bindValue(2, $board_id, PDO::PARAM_INT);
            $ps->execute();
            $searchquestionarystatus = $ps->fetch();
            if($searchquestionarystatus['questionary_status'] == 0){
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

                $sql3 = "INSERT INTO questionaires (board_id, questionary_id, questionary_title, questionary_date, questionary_status, user_id) VALUES 
                        (?, ?, ?, cast(NOW() AS DATETIME), 1, ?)";
                $ps3 = $pdo->prepare($sql3);
                $ps3->bindValue(1, $board_id, PDO::PARAM_INT);
                $ps3->bindValue(2, $questionary_id, PDO::PARAM_INT);
                $ps3->bindValue(3, $questionary_title, PDO::PARAM_STR);
                $ps3->bindValue(4, $user_id, PDO::PARAM_INT);
                $ps3->execute();
                for($i = 1; $i <= count($questionary_detail); $i++){
                    $sql4 = "INSERT INTO questionary_details (board_id, questionary_id, questionary_detail_id, questionary_detail, questionary_votes) VALUES
                            (?, ?, ?, ?, 0);";
                    $ps4 = $pdo->prepare($sql4);
                    $ps4->bindValue(1, $board_id, PDO::PARAM_INT);
                    $ps4->bindValue(2, $questionary_id, PDO::PARAM_INT);
                    $ps4->bindValue(3, $questionary_detail_id, PDO::PARAM_INT);
                    $ps4->bindValue(4, $questionary_detail[$i-1], PDO::PARAM_STR);
                    $ps4->execute();
                    $questionary_detail_id++;
                }
            }
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
        }
    }
    header('Location: ../frontend/Board.php',true, 307);
    exit();
?>