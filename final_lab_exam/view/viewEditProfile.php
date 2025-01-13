<?php
    session_start();
    require_once('../model/userModel.php');
    if(!isset($_COOKIE['status'])){
        header('location: login.php');  
    }

    if(isset($_REQUEST['id'])){
        //echo $_REQUEST['id']; 
    }
   
    $users = getUser($_REQUEST['id']);
    $_SESSION['update_id'] = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <table id="profile-table" width="600" border="1" cellpadding="20" cellspacing="0" align="center">
    <thead>
        <tr>
            <th colspan="2" id="edit-profile-header" align="center">Edit Profile</th>
        </tr>
    </thead>
    
    <form method="post" action="../controller/editProfile.php" enctype="">
        

        <tr id="name-row">
            <td>
                <label for="name" id="name-label">
                    <strong>Name:</strong>
                </label>
            </td>
            <td>
                <input type="text" id="name" name="name" width="100%" value="<?=$users['name']?>"/>
            </td>
        </tr>

        <tr id="email-row">
            <td>
                <label for="email" id="email-label">
                    <strong>Username:</strong>
                </label>
            </td>
            <td>
                <input type="email" id="email" name="email" value="<?=$users['username']?>" width="100%">
            </td>
        </tr>

        <tr id="phone-row">
            <td>
                <label for="phone" id="phone-label">
                    <strong>Contact:</strong>
                </label>
            </td>
            <td>
                <input type="text" id="phone" name="phone" value="<?=$users['contact']?>" width="100%">
            </td>
        </tr>


        <tr id="save-changes-row">
            <td colspan="2" align="center">
                <button type="submit" name="submit" id="save-changes-btn">Update</button><br> <br>
                <button type="submit" name="submit" id="save-changes-btn">Delete</button><br> <br>
                <a href="viewProfile.php">Go to Profile</a>
            </td>
        </tr> 
    </form>
   
</table>
</body>
</html>
