<?php
	require_once 'Dbconect.php';
	$raw = file_get_contents('php://input');
	$data = json_decode($raw,true);

	$dbcon = new Dbconect();
	$pdo = $dbcon->dbConnect();
	
	switch($data['user_evaluation']){
		case -1:
			$sql = "INSERT INTO comment_evaluations(board_id, comment_id, user_id, evaluation)
				VALUES(?, ?, ?, ?)";
			$ps = $pdo->prepare($sql);
			$ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
			$ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
			$ps->bindValue(3,$data['user_id'],PDO::PARAM_INT);
			// goodを押したかbadを押したか
			if($data['evaluation'] == 1){
				$ps->bindValue(4, 1, PDO::PARAM_INT);
			}else{
				$ps->bindValue(4, 0, PDO::PARAM_INT);
			}
			$ps->execute();
			break;
		case 0:
			if($data['evaluation'] == 1){
				$sql = "UPDATE comment_evaluations SET evaluation = 1
						WHERE board_id = ? AND comment_id = ? AND user_id = ?";
				$ps = $pdo->prepare($sql);
				$ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
				$ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
				$ps->bindValue(3,$data['user_id'],PDO::PARAM_INT);
				$ps->execute();
			}else{
				$sql = "DELETE FROM comment_evaluations
						WHERE board_id = ? AND comment_id = ? AND user_id = ?";
				$ps = $pdo->prepare($sql);
				$ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
				$ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
				$ps->bindValue(3,$data['user_id'],PDO::PARAM_INT);
				$ps->execute();
			}
			break;
			
		case 1:
			if($data['evaluation'] == 1){
				$sql = "DELETE FROM comment_evaluations
						WHERE board_id = ? AND comment_id = ? AND user_id = ?";
				$ps = $pdo->prepare($sql);
				$ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
				$ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
				$ps->bindValue(3,$data['user_id'],PDO::PARAM_INT);
				$ps->execute();
				
			}else{
				$sql = "UPDATE comment_evaluations SET evaluation = 0
						WHERE board_id = ? AND comment_id = ? AND user_id = ?";
				$ps = $pdo->prepare($sql);
				$ps->bindValue(1,$data['board_id'],PDO::PARAM_INT);
				$ps->bindValue(2,$data['comment_id'],PDO::PARAM_INT);
				$ps->bindValue(3,$data['user_id'],PDO::PARAM_INT);
				$ps->execute();
			}
			break;
	}
	$res = 'UPDATEOK';
	echo json_encode($res);
?>