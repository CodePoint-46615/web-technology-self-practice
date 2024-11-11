<?php
 $number_1 = 100;
 $number_2 = 150; 
 $number_3 = 450; 
 
 if($number_1 > $number_2 && $number_1 > $number_3 ){
    echo "$number_1 is the greatest number"; 
 }
 else if($number_2 > $number_1 && $number_2 > $number_3 ){
    echo "$number_2 is the greatest number"; 
 }
 else{
    echo "$number_3 is the greatest number";
 }
?>