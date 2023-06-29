<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class UserInfo{
        public $user_id;
        public $username;
        function __construct($user_id, $username){
            $this->user_id = $user_id;
            $this->username = $username;
        }
    }
?>