<?php
session_start();
require_once('../model/userModel.php');
if (!isset($_COOKIE['status'])) {
    header('location: login.php');
}

if (isset($_REQUEST['id'])) {
    $users = getUser($_REQUEST['id']);
    $_SESSION['update_id'] = $_REQUEST['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../asset/CSS/viewEditProfile.css" />
    <script src="../asset/JS/editProfile.js"></script>
    
</head>
<body>
    <table width="600" border="1" cellpadding="20" cellspacing="0" align="center">
        <thead>
            <tr>
                <th colspan="2" align="center">Edit Profile</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" align="center">
                    <img src="<?= '../asset/' . htmlspecialchars($users['image']); ?>" alt="Profile Picture" width="150" height="150" border="1" />
                </td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td>
                    <input type="text" id="name" value="<?= htmlspecialchars($users['username']); ?>" onkeyup="validateName()"/>
                    <span id="nameMessage" class="message"></span>
                </td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td>
                    <input type="email" id="email" value="<?= htmlspecialchars($users['email']); ?>" onkeyup="validateEmail()" />
                    <span id="emailMessage" class="message"></span>
                </td>
            </tr>
            <tr>
                <td><strong>Phone Number:</strong></td>
                <td>
                    <input type="text" id="phone" value="<?= htmlspecialchars($users['phone']); ?>" onkeyup="validatePhone()"/>
                    <span id="phoneMessage" class="message"></span>
                </td>
            </tr>
            <tr>
                <td><strong>Gender:</strong></td>
                <td>
                    <select id="gender">
                        <option value="Male" <?= $users['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?= $users['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Others" <?= $users['gender'] == 'Others' ? 'selected' : ''; ?>>Others</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><strong>Date of Birth:</strong></td>
                <td>
                    <input type="date" id="dob" value="<?= htmlspecialchars($users['dob']); ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button onclick="ajaxUpdate()">Save Changes</button><br>
                    <a href="viewProfile.php">Go to Profile</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="message" align="center"></div>
    
</body>
</html>
