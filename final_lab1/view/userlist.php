<?php
    include '../model/userModel.php'; 
    session_start();
    if(!isset($_COOKIE['status'])){
        header('location: login.html');  
    }
    $userdata= [$id, ];
    $users = getAllUser(); 
?>


<html lang="en">
<head>
    <title>Userlist </title>
</head>
<body>
        <h2>User List</h2>    
        <a href="home.php"> Back </a> | 
        <a href="../controller/logout.php"> logout </a>

        <br>

        <table border=1>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
            </tr>
            <?php 
                for($i=0; $i<count($users); $i++){ 
            ?>
            <tr>
                <td><?php getAllUser(); ?></td>
                <td><?=$users[$i]['username'] ?></td>
                <td><?=$users[$i]['email'] ?></td>
                <td>
                    <a href="edit.php?id=<?=$users[$i]['id']?>"> EDIT </a> |
                    <a href="delete.php"> DELETE </a> 
                </td>  
            </tr>

            <?php } ?>
        </table>
</body>
</html>
