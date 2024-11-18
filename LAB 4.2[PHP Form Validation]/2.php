<?php
    if(isset($_POST['submit'])){
        $useremail = $_POST['email']; 

        if(empty($useremail)){
            echo '<script>alert("Email field can not be empty")</script>'; 
        }
        else if(filter_var($useremail, FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("Validation Successful")</script>'; 
        }
        else{
            echo '<script>alert("Invalid Email Format")</script>'; 
        }
    }
    else{
        header('location: 2.html');
    }
?>