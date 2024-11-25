<?php
    session_start();
    if(!isset($_SESSION['status'])){
        header('location: login.html');  
    }

    $user = $_SESSION['users'][$_SESSION['useremail']];
?>


<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
        <h1>Welcome Home! <?=$_SESSION['username']?></h1>
        <p><b>Name:</b> <?= $user['name'] ?></p>
        <p><b>Username:</b> <?= $user['email'] ?></p>
        <p><b>Age:</b> <?= $user['age'] ?></p>
        <p><b>Gender:</b> <?= $user['gender'] ?></p>    
        <a href="logout.php"> logout </a>
</body>
</html>
