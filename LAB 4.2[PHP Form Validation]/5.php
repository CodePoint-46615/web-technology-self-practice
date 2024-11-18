<?php
    if(isset($_POST['submit'])){
        $allowedValues = ['SSC', 'HSC', 'BSc'];

        if(isset($_POST['choices']) && is_array($_POST['choices'])){
            $selectedValues = array_intersect($_POST['choices'], $allowedValues); 
            
            if(count($selectedValues) < 2){
                echo '<script>alert("You need to select at least two options")</script>';
            } 
            else{
                echo '<script>alert("Validation Successful")</script>';
            }
        } 
        else{
            echo '<script>alert("No checkboxes selected")</script>';
        }
    }
    else{
        header('location: 5.html');
    }
?>