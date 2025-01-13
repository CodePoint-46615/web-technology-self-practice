<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../controller/loginCheck.php" enctype="">
        <table border="1" width="300" height="100" cellpadding="10" align="center" cellspacing="0">
            <tr>
                <th>
                    Login
                </th>
            </tr>

            <tr>
                <td>
                Username: <input type="email" name="uname" value="" placeholder="Email..."/><br><br>
                Password: <input type="password" name="pass" value=""/>
                </td>
            </tr>
            
            <tr>
                <td align="center">
                    <input type="submit" name="submit" value="Login"/><br>
                    <a href="signup.php">Go to SignUp</a>
                </td>
            </tr>
            
        </table>

    </form>
</body>
</html>