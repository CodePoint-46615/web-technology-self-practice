<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['name']);
        $words = explode(" ", $username);
        $email = trim($_REQUEST['email']);
        $phone = trim($_REQUEST['phone']);
        $id = $_SESSION['update_id']; 
    
        if(empty($username) || empty($email) || empty($phone)){
            echo '<script>alert("All fields are required. Please fill them out.")</script>'; 
        } 
        else if (!ctype_alpha($username[0]) || count($words) < 2 || !preg_match('/^[a-zA-Z .-]+$/', $username)) {
            echo '<script>alert("Invalid name format.")</script>';
        } 
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid Email Format")</script>'; 
        } 
        else if (!preg_match('/^\d{11}$/', $phone)) {
            echo '<script>alert("Invalid phone number. It must be exactly 11 digits.")</script>';
        } 
        else {
            $status = editProfile($id, $username, $email, $phone);
            if($status){
                header('location: ../view/viewProfile.php');
                unset($_SESSION['update_id']);
            } else {
                echo '<script>alert("Failed to update profile. Please try again.")</script>';
                header('location: ../view/viewEditProfile.php');
            }
        }
    } 
    else {
        header('location: ../view/viewEditProfile.php');
    }
    
?>