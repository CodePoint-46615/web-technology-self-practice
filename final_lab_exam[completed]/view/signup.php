<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPro</title>
</head>
<body>
    <form method="post" action="../controller/signupCheck.php" enctype="multipart/form-data">
        <table id="sign-up" border="1" cellpadding="10" align="center"cellspacing="0">
            <tr>
                <th colspan="3">SignUp Form</th>
            </tr>

            <tr>
                <td align="center">
                    <br>Name: <input type="text" name="name" value="" id="user-name" onkeyup="validateName()">
                    <span id="nameMessage"></span><br><br>
                    
                    Conatact: <input type="text" name="phone" value="" id="user-phone" onkeyup="validateContact()">
                    <span id="phoneMessage"></span><br><br>

                    Username: <input type="email" name="email" value="" id="user-email" onkeyup="validateUserName()">
                    <span id="emailMessage"></span><br><br>

                    User Type: 
                    <select name="utype" id="user-type" onkeyup="validateUserType()">
                        <option value="Admin">Admin</option>
                        <option value="Author">Author</option>
                    </select>
                    <span id="utypeMessage"></span><br><br>

                    Password: <input type="password" name="pass" value="" id="user-pass" onkeyup="validatePassword()">
                    <span id="passMessage"></span><br><br>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <input type="submit" name="submit" value="Signup" id="user-signupbtn" onclick="ajaxSignup()"><br>
                    <a href="login.php">Already have an account</a>
                </td>
            </tr>
            
        </table>
    </form>
    <script src="../asset/signup.js"></script>
</body>
</html>