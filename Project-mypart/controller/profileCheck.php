<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $id = $_SESSION['update_id'];
    
        $status = getUser($id);
            if($status){
                header('location: ../view/viewProfile.php');
                unset($_SESSION['update_id']);
            } 
            else {
                echo '<script>alert("Failed to update profile. Please try again.")</script>';
                header('location: ../view/viewEditProfile.php');
            }
    } 
    else {
        header('location: ../view/viewEditProfile.php');
    }
    
?>