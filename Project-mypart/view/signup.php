<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriPro</title>
</head>
<body>
    <form method="post" action="../controller/signupCheck.php" enctype="multipart/form-data">
        <table id="sign-up" border="1"  cellpadding="10" align="center"cellspacing="0">
            <tr>
                <th colspan="3">SignUp Form</th>
            </tr>

            <tr>
                <td align="center">
                    <br>Name: <input type="text" name="name" value="" id="user-name"><br><br>
                    Email: <input type="email" name="email" value="" id="user-email"><br><br>
                    Phone: <input type="text" name="phone" value="" id="user-phone"><br><br>
                    Gender: 
                    <select name="gender" id="user-gender">
                        <option value="male">MALE</option>
                        <option value="female">FEMALE</option>
                        <option value="others">OTHERS</option>
                    </select><br><br>

                    User Type: 
                    <input type="radio" name="utype" value="admin" id="user-type">Admin
                    <input type="radio" name="utype" value="advisor" id="user-type">Advisor
                    <input type="radio" name="utype" value="farmer" id="user-type">Farmer<br><br>

                    Date of Birth: <input type="date" name="dob" value="" id="user-dob"><br><br>
                    Password: <input type="password" name="pass" value="" id="user-pass"><br><br>
                    Re-Password: <input type="password" name="repass" value="" id="user-repass"><br><br>
                    Upload Profile Picture: <input type="file" name="image" value="" id="user-iamge"><br><br>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <input type="submit" name="submit" value="Signup" id="user-signupbtn"><br>
                    <a href="login.php">Already have an account</a>
                </td>
            </tr>
            
        </table>
    </form>
</body>
</html>