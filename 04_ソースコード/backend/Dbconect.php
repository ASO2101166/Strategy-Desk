<?php
    class Dbconect{
        public function dbConnect(){
            $pdo = new PDO('mysql:host=localhost;dbname=strategy_desk;charset=utf8','root','root');
            return $pdo;
        }
    }
?>