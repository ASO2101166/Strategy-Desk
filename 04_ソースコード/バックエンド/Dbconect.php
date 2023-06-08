<?php
private function dbConnect(){
    $pdo = new PDO('mysql:host=localhost;dbname=Strategy_Desk;charset=utf8','webuser','abccsd2');
    return $pdo;
}
?>