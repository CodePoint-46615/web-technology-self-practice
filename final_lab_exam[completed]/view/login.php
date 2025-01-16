<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../controller/loginCheck.php" enctype="">
        <table border="1" width="400" height="100" cellpadding="10" align="center" cellspacing="0">
            <tr>
                <th>
                    Login
                </th>
            </tr>

            <tr>
                <td>
                Username: 
                <input type="email" name="uname" id="user-name" value="" placeholder="Email..." onkeyup="validateName()"/>
                <span id="nameMessage"></span><br><br>
                Password: <input type="password" name="pass" id="user-pass" value="" onkeyup="validatePassword()"/>
                <span id="passMessage"></span>
                </td>
            </tr>
            
            <tr>
                <td align="center">
                    <input type="submit" name="submit" value="Login" onclick="ajaxLogin()"/><br>
                    <a href="signup.php">Go to SignUp</a>
                </td>
            </tr>
            
        </table>
        <script src="../asset/login.js"></script>
    </form>
</body>
</html>