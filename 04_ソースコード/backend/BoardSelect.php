<?php
public function boardSelect(){
    require_once 'Dbconect';
    $pdo = $dbcon->dbConnect();
    $sql = "SELECT * FROM board_table WHERE board_title LIKE ?";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1,'%'+$_POST['']+'%',PDO::PARAM_STR);
    $ps->execute();
    $searchArray=$ps->fetchAll();
    if(isset($searchArray)){
        return $searchArray;
    }else{
        return "";
    }
}
?>