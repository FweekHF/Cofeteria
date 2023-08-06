<?php 
    session_start();

    session_unset();

    session_destroy();
    
    header('Location: /Coffee-s-UTP/Login.php')
?>