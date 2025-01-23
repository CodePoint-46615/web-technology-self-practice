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
    <title>Change Password</title>
    <link rel="stylesheet" href="../asset/CSS/viewChangePass.css" />
    <script src="../asset/JS/changePass.js"></script>
</head>
<body>

    <table border="1" cellpadding="25" cellspacing="0" align="center" valign="center">
        <tr>
            <th colspan="2">Change Password</th>
        </tr>
        
        <form id="change-pass" method="post" action="../controller/changePass.php" enctype="">
            <tr>
                <td>
                    <label for="current-password">Current Password:</label>
                </td>
                <td>
                    <input type="password" id="current-password" name="current-password" value="" placeholder="Enter current password" onkeyup="validateCurrentPass()" />
                    <span id="currentPassMessage"></span>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label for="new-password">New Password:</label>
                </td>
                <td>
                    <input type="password" id="new-password" name="new-password" placeholder="Enter new password" onkeyup="validateNewPass()"/>
                    <span id="newPassMessage"></span>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="confirm-password">Confirm New Password:</label>
                </td>
                <td>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password" onkeyup="validateConfirmPass()"/>
                    <span id="confirmPassMessage"></span>
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <button type="submit" name="submit" onclick="ajaxUpdatePass()">Change Password</button><br>
                    <a href="viewProfile.php">Go to Profile</a>
                </td>
            </tr>

        </form>
    </table>
    
</body>
</html>
