<?php
session_start();
require_once('../model/userModel.php');

if (isset($_REQUEST['submit'])) {
    $email = trim($_REQUEST['uname']);
    $password = trim($_REQUEST['pass']);

    if (empty($email) || empty($password)) {
        echo '<script>alert("Empty username or password")</script>';
    } else {
        $status = login($email, $password);
        if ($status) {
            // Retrieve user details to get the ID
            $user = getUserByEmail($email); // Create a function to get user by email
            if ($user) {
                setcookie('status', 'true', time() + 3600, '/');
                $_SESSION['uname'] = $email;
                $_SESSION['id'] = $user['id']; // Store the ID in session
                header('location: ../view/viewProfile.php');
            } 
            else {
                echo '<script>alert("User not found!")</script>';
            }
        } else {
            echo '<script>alert("Error Username or Password")</script>';
        }
    }
} else {
    header('location: ../view/login.php');
}
?>
