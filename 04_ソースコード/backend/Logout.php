<?php
    session_start();
    session_destroy();
    $_SESSION = array();
    header('Location: ../frontend/Login.php', true, 307);
    exit();
?>