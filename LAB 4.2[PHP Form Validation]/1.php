<?php
 
    if(isset($_POST['submit'])){
        $username = $_POST['name'];
 
        if(empty($username)){
            echo '<script>alert("Name can not be empty")</script>';
        }else{
            $words = explode(" ", trim($username));
            if (count($words) < 2) {
                echo '<script>alert("Name must contain at least two words")</script>';
            }
        }
       
    }else{
        header('location: 1.html');
    }
 
 
?>