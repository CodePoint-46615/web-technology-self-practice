<?php
    session_start();
    require_once('../model/userModel.php');

    // Retrieve all users by default
    $users = searchUsers(""); // Fetch all users when no search query is provided

    if(isset($_REQUEST['submit'])){
        // Check if search query is set and not empty
        if (isset($_REQUEST['search']) && !empty(trim($_REQUEST['search']))) {
            $query = trim($_REQUEST['search']);
            $users = searchUsers($query);   
        }
        else{
            $users = searchUsers("");
        }
    }
    
    
?>
