<?php
    session_start(); // Ensure the session is started
    require_once('../model/userModel.php'); 
    $utype = trim($_REQUEST['utype']);

    // Function to check if the user is an advisor
    function isAdvisor() {
        return isset($utype) && $utype === 'advisor';
    }
?>
