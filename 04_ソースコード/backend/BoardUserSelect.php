<?php
public function boardUserSelect($id){
    require_once 'Dbconect';
    $dbcon = new Dbconect();
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT * FROM boards WHERE user_id = ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,$id,PDO::PARAM_INT);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    if(isset($searchArray)){
        return $searchArray;
    }else{
        return "";
    }
}
?>