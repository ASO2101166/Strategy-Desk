<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require_once 'Dbconect.php';
    require_once 'UserInfo.php';
    class UserSelect {
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
                construct($searchArray['user_name'],$searchArray['user_id']);
                return $userInfo;*/
                return $searchArray;
            }else{
                return "";
            }
        }
        public function userselectbynamepass($user_name, $pass){
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT * FROM users WHERE user_name = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user_name,PDO::PARAM_STR);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            foreach($searchArray as $row){  
                if(password_verify($pass, $row['password']) == true){
                    $_SESSION['user'] = serialize(new UserInfo($row['user_id'], $row['user_name']));
                    return true;
                }
            }
            return false;
        }
        public function userselectcheckbynamepass($user_name, $pass){
            $dbcon = new Dbconect();
            $pdo = $dbcon->dbConnect();
            $sql = "SELECT * FROM users WHERE user_name = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1,$user_name,PDO::PARAM_STR);
            $ps->execute();
            $searchArray=$ps->fetchAll();
            foreach($searchArray as $row){  
                if(password_verify($pass, $row['password']) == true){
                    return true;
                }
            }
            return false;
        }
    }
?>