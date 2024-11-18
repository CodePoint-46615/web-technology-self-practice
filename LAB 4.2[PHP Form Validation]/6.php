<?php
    if(isset($_POST['submit'])){
        $bloodgrp = $_POST['blood-group']; 

        if(empty($bloodgrp)){
            echo '<script>alert("Field can not be empty")</script>';
        }
        else{
            echo '<script>alert("Validation Successful")</script>';
        }
    }
    else{
        header('location: 6.html');
    }
?>