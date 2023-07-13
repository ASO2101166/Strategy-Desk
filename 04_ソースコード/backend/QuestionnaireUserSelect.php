<?php
    require_once 'Dbconect.php';
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $cls = new Dbconect();
    $pdo = $cls->dbConnect();
    $sql = "SELECT questionary_detail_id FROM questionary_votes
            WHERE board_id = ? AND questionary_id = ? AND user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $data['board_id'], PDO::PARAM_INT);
    $ps->bindValue(2, $data['questionary_id'], PDO::PARAM_INT);
    $ps->bindValue(3, $data['user_id'], PDO::PARAM_INT);
    $ps->execute();
    $questionary_detail_id = $ps->fetch();
    $res = $questionary_detail_id;
    echo json_encode($res);
?>