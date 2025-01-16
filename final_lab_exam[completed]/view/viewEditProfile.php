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
                <input type="text" id="name" name="name" width="100%" value="<?=$users['name']?>" onkeyup="validateFullname()"/>
                <span id="nameMessage"></span>
            </td>
        </tr>

        <tr id="email-row">
            <td>
                <label for="email" id="email-label">
                    <strong>Username:</strong>
                </label>
            </td>
            <td>
                <input type="email" id="email" name="userName" value="<?=$users['username']?>" width="100%" onkeyup="validationUsername()">
                <span id="emailMessage"></span>
            </td>
        </tr>

        <tr id="phone-row">
            <td>
                <label for="phone" id="phone-label">
                    <strong>Contact:</strong>
                </label>
            </td>
            <td>
                <input type="text" id="phone" name="phone" value="<?=$users['contact']?>" width="100%" onkeyup="validatePhone()">
                <span id="phoneMessage"></span>
            </td>
        </tr>

        <tr id="save-changes-row">
            <td colspan="2" align="center">
                <button type="submit" name="submit" id="save-changes-btn" onclick= "ajaxUpdate()">Update</button><br> <br>
            </td>
        </tr> 
    </form>
    <script src="../asset/update.js"></script>

    <form method="post" action="../controller/confirmDelete.php">
        <tr id="delete-row">
            <td colspan="2" align="center">
                <hr>
                <h3>Delete User</h3>
                <p>Are you sure you want to delete this user?</p>
                <input type="hidden" name="id" value="<?=$users['id']?>">
                <button type="submit" name="delete" id="delete-btn">Confirm Deletion</button>
                <br><br>
                <a href="viewSearch.php">Cancel</a>
            </td>
        </tr>
    </form>
    </table>
</body>
</html>
