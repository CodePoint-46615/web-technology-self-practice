<?php
    session_start(); 
    unset($_SESSION['status']);
    setcookie('status', 'true', time()-5, '/');
    header('location: ../view/login.php');
?>