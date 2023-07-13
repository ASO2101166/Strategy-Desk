<?php
    require_once 'Dbconect.php';
    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $cls = new Dbconect();
    $pdo = $cls->dbConnect();
    $sql = "SELECT questionary_date FROM questionaires 
            WHERE board_id = ?
            AND questionary_id = (SELECT MAX(questionary_id)
                                  FROM questionaires AS q
                                  WHERE board_id = ?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $data['board_id'], PDO::PARAM_INT);
    $ps->bindValue(2, $data['board_id'], PDO::PARAM_INT);
    $ps->execute();
    $questionary_date = $ps->fetch();
    $res = $questionary_date['questionary_date'];
    echo json_encode($res);
?>