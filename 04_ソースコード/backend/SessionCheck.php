<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class SessionCheck{
        function usersessioncheck(){
            if(isset($_SESSION['user']) == true){
                return true;
            }else{
                return false;
            }
        }
    }
?>
