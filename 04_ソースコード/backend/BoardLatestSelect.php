<?php
    require_once 'Dbconect.php';
    $pdo = $dbcon->dbConnect();
    $sql = 'SELECT * FROM boards INNER JOIN (SELECT ) ORDER BY (commnt_date)'
?>