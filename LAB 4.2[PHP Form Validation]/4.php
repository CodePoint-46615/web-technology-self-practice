<?php
    if(isset($_POST['submit'])){
        $userDOB = $_POST['DOB'];

        if(empty($userDOB)){
            echo '<script>alert("Field can not be empty")</script>'; 
        }
        else{
            echo '<script>alert("Validation Successful")</script>';
        }

    }
    else{
        header('location: 4.html');
    }
?>