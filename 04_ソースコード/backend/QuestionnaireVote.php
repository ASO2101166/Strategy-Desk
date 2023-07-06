<?php
    if(!isset($_SESSION)){
        sssion_start();
    }
    require_once 'Dbconnect.php';
    $user = unserialize($_SESSION['user']);
    
    $board_id = $_POST['board_id'];
    $questionary_detail_id = $_POST['questionary_detail_id'];
    $user_id = $user->user_id;

    questionaryvoteCreate($board_id, $questionary_detail_id, $user_id);

    function questionaryvoteCreate($board_id, $questionary_detail_id, $user_id){
        $cls = new Dbconnect();
        $pdo = $cls->dbConnect();
        $sql = "INSERT INTO questionary_votes(board_id, questionary_detail_id, user_id) VALUES
                                             (?, ?, ?);";
        $ps = $pdo->prepare($sql);
        $ps->bindValue(1, $board_id, PDO::PARAM_INT);
        $ps->bindValue(2, $questionary_detail_id, PDO::PARAM_INT);
        $ps->bindValue(3, $user_id, PDO::PARAM_INT);
        $ps->execute();
    }
?>