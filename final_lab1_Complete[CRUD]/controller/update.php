<?php 
    session_start();
    require_once('../model/userModel.php');
    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['username']);
        $password = trim($_REQUEST['password']);
        $email = trim($_REQUEST['email']);

        if($username == null || empty($password || empty($email))){
            echo "Null username/password/email";
        }
        else{
            $status = editUser($_SESSION['update_id'], $username, $password, $email);
            if($status){
                header('location: ../view/userlist.php');
                unset($_SESSION['update_id']);
            } 
            else{
                echo "an error occured";
                ?>
                <a href="../view/userlist.php"> Return to Userlist </a>
<?php
                
            }
        }

    }
    else{
        header('location: ../view/signup.html');
    }

?>