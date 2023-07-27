<?php
    require_once 'Dbconect.php';
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $cls = new Dbconect();
    $pdo = $cls->dbConnect();
    $sql = "SELECT q.*, cast(NOW() AS DATETIME) AS now_date, GROUP_CONCAT(qd.questionary_detail_id) AS questionary_detail_ids,
                   GROUP_CONCAT(qd.questionary_detail) AS questionary_details
            FROM questionaires AS q
            INNER JOIN questionary_details AS qd
            ON q.board_id = qd.board_id
            AND q.questionary_id = qd.questionary_id
            WHERE q.board_id = ?
            AND q.questionary_id = (SELECT MAX(questionary_id)
                                  FROM questionaires AS q
                                  WHERE board_id = ?)
            GROUP BY q.board_id, q.questionary_id";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $data['board_id'], PDO::PARAM_INT);
    $ps->bindValue(2, $data['board_id'], PDO::PARAM_INT);
    $ps->execute();
    $questionary_date = $ps->fetch();
    $retArray = [];
    if(!$questionary_date == false){
        $retArray['board_id'] = $questionary_date['board_id'];
        $retArray['questionary_id'] = $questionary_date['questionary_id'];
        $retArray['questionary_title'] = $questionary_date['questionary_title'];
        $retArray['questionary_date'] = $questionary_date['questionary_date'];
        $retArray['now_date'] = $questionary_date['now_date'];
        $retArray['questionary_status'] = $questionary_date['questionary_status'];
        $ids = explode(",", $questionary_date['questionary_detail_ids']);
        $details = explode(",", $questionary_date['questionary_details']);
        for($j = 0; $j < count($ids); $j++){
            $retArray['questionary_detail_id'][$j] = $ids[$j];
            $retArray['questionary_detail'][$j] = $details[$j];
        }
    }
    $res = $retArray;
    echo json_encode($res);
?>