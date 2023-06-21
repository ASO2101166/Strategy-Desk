<?php
public function userSelect($id){
    require_once 'Dbconect.php';
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$id,PDO::PARAM_INT);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    if(isset($searchArray)){
        /*require_once 'UserInfo.php'
        $userInfo = new UserInfo();
        $userInfo = $searchArray;
        return $userInfo;*/
        return $searchArray;
    }else{
        return "";
    }
}
?>