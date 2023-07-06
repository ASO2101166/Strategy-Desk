<?php
    if(!isset($_SESSION)){
        session_start();
    }
    class UserInfo{
        public $user_id;
        public $user_name;
        function __construct($user_id, $user_name){
            $this->user_id = $user_id;
            $this->username = $user_name;
        }
    }
?>