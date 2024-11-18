<?php 

    if(isset($_POST['submit'])){
        $username = $_POST['name'];
        $words = explode(" ", trim($username));
    

        if(empty($username)){ 
            echo '<script>alert("Name can not be empty")</script>';
        }
        elseif(ctype_alpha($username[0])!=$words[0]){
            echo '<script>alert("Must start with a letter")</script>';
        }
        else if(!preg_match('/^[a-zA-Z .-]+$/', $username)){
            echo '<script>alert("Can contain a-z, A-Z, period, dash only")</script>';
        }
        elseif(count($words) < 2){
            echo '<script>alert("Name must contain at least two words")</script>';
        }
        else{
            echo '<script>alert("Validation Successful")</script>';
        }
        
    }
    else{
        header('location: 1.html');
    }


?>