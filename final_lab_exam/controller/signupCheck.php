<?php 
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['name']);
        $words = explode(" ", $username);
        $email = trim($_REQUEST['email']);
        $phone = trim($_REQUEST['phone']);
        $utype = ($_REQUEST['utype']);
        $password = trim($_REQUEST['pass']);
        

        // Validate inputs
        if (empty($username) || empty($email) || empty($phone) || empty($utype) || empty($password)) {
            echo '<script>alert("Null Field is not accepted.")</script>';
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
        else if (strlen($password) != 5 || !ctype_digit($password)) {
            echo '<script>alert("Password is in Invalid Format.")</script>';
        } 
        else {
            // Add to database
            $status = addUser($username, $phone, $email, $password, $utype);
            if($status){
                header('location: ../view/login.php');
            } 
            else {
                echo '<script>alert("This id is already exist")</script>';
            }
        }
    } 
    else {
        header('location: ../view/signup.php');
    }
?>
