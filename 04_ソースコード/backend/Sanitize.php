<?php
    class Sanitize {
        function sanitize_br($str){
            return nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
        }
    }
?>