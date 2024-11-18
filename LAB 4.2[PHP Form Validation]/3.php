<?php
    if(isset($_POST['submit'])){
        echo '<script>alert("Validation Successful")</script>';  
    }
    else{
        header('location: 3.html');
    }
?>