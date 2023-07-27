<?php
// cronの設定名 [アンケート1分毎終了チェック]
// 日付 ( 月 ) [７月]
// 日付 ( 日 ) [毎日]
// 曜日 [毎日]
// 時間 ( 時 ) [毎時]
// 時間 ( 分 ) [１分毎]
// 実行ファイルパス [Strategy-desk/backend/cron/QuestionnaireEnd.php]
    require_once '../Dbconect.php';
    $cls = new Dbconect();
    $pdo = $cls->dbConnect();
    try{
        $pdo->beginTransaction();
        $sql = "SELECT * FROM questionaires
                WHERE TIMEDIFF(cast(NOW() AS DATETIME),questionary_date) > '00:10:00'
                AND questionary_status = 1;";
        $ps = $pdo->prepare($sql);
        $ps->execute();
        $searchArray = $ps->fetchAll();
        foreach($searchArray as $row){
            $sql = "UPDATE questionaires SET questionary_status = 0
                    WHERE board_id = ? AND questionary_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $row['board_id'], PDO::PARAM_INT);
            $ps->bindValue(2, $row['questionary_id'], PDO::PARAM_INT);
            $ps->execute();

            $sql2 = "INSERT INTO comments(board_id, comment_id, comment_content, fixed_comment, comment_date, questionary_id, map_id, parent_board_id, parent_comment_id, user_id) VALUES
                        (?, (SELECT IFNULL(MAX(comment_id) + 1, 1) AS max_comment_id
                            FROM comments AS com 
                            WHERE board_id = ?), 'questionary', 0, cast(NOW() AS DATETIME),
                            ?, NULL, NULL, NULL, ?)";
            $ps2 = $pdo->prepare($sql2);
            $ps2->bindValue(1, $row['board_id'], PDO::PARAM_INT);
            $ps2->bindValue(2, $row['board_id'], PDO::PARAM_INT);
            $ps2->bindValue(3, $row['questionary_id'], PDO::PARAM_INT);
            $ps2->bindValue(4, $row['user_id'], PDO::PARAM_INT);
            $ps2->execute();
        }
        $pdo->commit();
        echo "OK";
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo $e;
    }
?>