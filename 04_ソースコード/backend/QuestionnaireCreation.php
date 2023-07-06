<?php
    if(!isset($_SESSION)){
        sssion_start();
    }
    require_once 'Dbconnect.php';

    $board_id = $_POST['board_id'];
    $questionary_title = $_POST['questionary_title'];
    $questionary_detail = $_POST['questionary_detail'];

    questionnairesCreate($board_id, $questionary_title, $questionary_detail);

    function questionnairesCreate($board_id, $questionary_title){
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();

        $sql = "START TRANSACTION;
                DROP PROCEDURE IF EXISTS createquestionaries;
                DELIMITER //
                CREATE PROCEDURE createquestionaries()
                BEGIN
                    DECLARE v_board_id INT;
                    DECLARE v_questionary_id INT;
                    DECLARE v_questionary_detail_id INT;
                    SET v_board_id = ?;
                    SET v_questionary_id = (SELECT IFNULL(MAX(questionary_id) + 1, 1) AS max_questionary_id
                                            FROM questionaires
                                            WHERE board_id = v_board_id);
                    SET v_questionary_detail_id = (SELECT IFNULL(MAX(questionary_detail_id) + 1, 1) AS max_questionary_detail_id
                                                FROM questionary_details
                                                WHERE board_id = v_board_id AND questionary_id = v_questionary_id);
                
                    INSERT INTO questionaires (board_id, questionary_id, questionary_title) VALUES 
                        (v_board_id, v_questionary_id, ?);
                ";
        for($i = 1; $i <= count($questionary_detail); $i++){
            $sql = $sql."INSERT INTO questionary_details (board_id, questionary_id, questionary_detail_id, questionary_detail, questionary_votes) VALUES
                         (v_board_id, v_questionary_id, v_questionary_detail_id, ?, 0);

                         SET v_questionary_detail_id = v_questionary_detail_id + 1;";
        }
        $sql = $sql."END //
                     DELIMITER ;
                     CALL createquestionaries();
                     DROP PROCEDURE IF EXISTS createquestionaries;
                     COMMIT;";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $board_id, PDO::PARAM_INT);
        $ps->bindValue(2, $board_title, PDO::PARAM_STR);
        for($i = 1; $i <= count($questionary_detail); $i++){
            $ps->bindValue($i + 2, $questionary_detail[$i], PDO::PARAM_INT);
        }
        $ps->execute();
    }
?>



































<?php
"INSERT INTO questionaires(board_id, questionary_id, questionary_title) VALUES 
                          (?, 
                           (SELECT IFNULL(max_questionary_id + 1, 1)
                            FROM (SELECT MAX(questionary_id) AS max_questionary_id 
                                  FROM questionaires 
                                  WHERE board_id = ?) AS temp),
                           'タイトル');"
?>