<?php
    require_once 'Dbconect.php';

    $raw = file_get_contents('php://input');
    $data = json_decode($raw,true);

    $cls = new Dbconect();
    $pdo = $cls->dbConnect();
    try{
        $pdo->beginTransaction();
        $sql = "INSERT INTO comments(board_id, comment_id, comment_content, fixed_comment, comment_date, questionary_id, map_id, parent_board_id, parent_comment_id, user_id) VALUES
                                    (?, (SELECT IFNULL(MAX(comment_id) + 1, 1) AS max_comment_id
                                        FROM comments AS com 
                                        WHERE board_id = ?), 'questionary', 0, cast(NOW() AS DATETIME),
                                        ?, NULL, NULL, NULL, ?);";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $data['board_id'], PDO::PARAM_INT);
        $ps->bindValue(2, $data['board_id'], PDO::PARAM_INT);
        $ps->bindValue(3, $data['questionary_id'], PDO::PARAM_INT);
        $ps->bindValue(4, $data['user_id'], PDO::PARAM_INT);
        $ps->execute();

        $sql2 = "UPDATE questionaires SET questionary_status = 0
                 WHERE board_id = ? AND questionary_id = ?;";
        $ps2 = $pdo->prepare($sql2);
        $ps2->bindValue(1, $data['board_id'], PDO::PARAM_INT);
        $ps2->bindValue(2, $data['questionary_id'], PDO::PARAM_INT);
        $ps2->execute();
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
    }
    $res = "PostOK";
    echo json_encode($res);
?>