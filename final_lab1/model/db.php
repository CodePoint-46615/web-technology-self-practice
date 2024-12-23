<?php

    $con = mysqli_connect('127.0.0.1', 'root', '', 'user_management');

    //var_dump($result);
    //var_dump($row);

    // for($i=0;$i<mysqli_num_rows($result); $i++){
    //     $row = mysqli_fetch_assoc($result);
    //     print_r($row);
    //     echo "<br>";
    // }

    // data insert
    // $sql1 = "insert into users VALUES('', 'Iub', '123', 'iub@gmail.com')";
    // if(mysqli_query($con, $sql1)){
    //     echo "Success";
    // } else{
    //     echo "Error";
    // }
    
    //data show
    // $sql = "select * from users";
    // $result = mysqli_query($con, $sql);

    // while($row = mysqli_fetch_assoc($result)){
    //     print_r($row);
    //     echo "<br>";
    // }
?>