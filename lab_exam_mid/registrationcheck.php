<?php
    session_start();
   
    if (isset($_REQUEST['submit'])) {
        $name = trim($_REQUEST['name']);
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST['password']);
        $repassword = trim($_REQUEST['repassword']);
        $gender = trim($_REQUEST['gender']);
        $age = trim($_REQUEST['age']);
        
 
        if ($name == null||$email == null||$password == null||$repassword == null||$gender == null||$age == null){
            echo "All fields are required!";
        } 
        elseif ($password !== $repassword) {
            echo "Passwords do not match!";
        } 
        else {
            $_SESSION['users'][$email] = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'gender' => $gender,
                'age' => $age
            ];
            echo "Registration successful! <a href='login.html'>Login here</a>";
        }
    } 
    else {
        header('location: registration.php');
    }
?>