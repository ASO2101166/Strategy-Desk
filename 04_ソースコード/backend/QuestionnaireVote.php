<?php
    require_once 'Dbconect.php';

    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $board_id = $data['board_id'];
    $questionary_id = $data['questionary_id'];
    $questionary_detail_id = $data['questionary_detail_id'];
    $user_id = $data['user_id'];

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
        if($searchquestionarystatus['questionary_status'] == 1){
            $sql = "SELECT user_id FROM questionary_votes
                    WHERE board_id = ? AND questionary_id = ? AND user_id = ?;";
                                                    
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $board_id, PDO::PARAM_INT);
            $ps->bindValue(2, $questionary_id, PDO::PARAM_INT);
            $ps->bindValue(3, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $searchArray = $ps->fetchAll();
            if(!count($searchArray) > 0){
                $sql = "INSERT INTO questionary_votes(board_id, questionary_id, questionary_detail_id, user_id) VALUES
                (?, ?, ?, ?);";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $board_id, PDO::PARAM_INT);
                $ps->bindValue(2, $questionary_id, PDO::PARAM_INT);
                $ps->bindValue(3, $questionary_detail_id, PDO::PARAM_INT);
                $ps->bindValue(4, $user_id, PDO::PARAM_INT);
                $ps->execute();

                $sql2 = "UPDATE questionary_details SET questionary_votes = questionary_votes + 1
                WHERE board_id = ? AND questionary_id = ? AND questionary_detail_id = ?";
                $ps2 = $pdo->prepare($sql2);
                $ps2->bindValue(1, $board_id, PDO::PARAM_INT);
                $ps2->bindValue(2, $questionary_id, PDO::PARAM_INT);
                $ps2->bindValue(3, $questionary_detail_id, PDO::PARAM_INT);
                $ps2->execute();
            }
            $res = "VoteOK";
        }else{
            $res = "VoteNG";
        }
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $res = $e;
    }
    
    echo json_encode($res);
?>