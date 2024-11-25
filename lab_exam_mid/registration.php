<?php
    session_start();
    if(!isset($_SESSION['users'])){
        $_SESSION['users'] = []; 
    }
?>



<html>
<head>
    <title>registration</title>
</head>
<body>
    <form method="post" action="registrationcheck.php" enctype="">
        <table border="1" width="100%" height="100%" cellspacing="0">
            <th colspan="3"><h1>PERSON PROFILE</h1></th>

            <tr>
                <td width="30%" align="left">
                    <label for="">Name</label>
                </td>
                <td width="60%" align="left">
                    <input type="text" name="name" value=""/>
                </td>
                <td width="10%"></td>
            </tr>

            <tr>
                <td align="left">
                    <label for="">Email</label>
                </td>
                <td align="left">
                    <input type="email" name="email" value=""/>
                </td>
                <td></td>
            </tr>

            <tr>
                <td align="left">
                    <label for="">Password</label>
                </td>
                <td align="left">
                    <input type="password" name="password" value=""/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td align="left">
                    <label for="">Repassword</label>
                </td>
                <td align="left">
                    <input type="password" name="repassword" value=""/>
                </td>
                <td></td>
            </tr>
            <tr>
                <td align="left">
                    <label for="">Age</label>
                </td>
                <td align="left">
                    <input type="text" name="age" value=""/>
                </td>
                <td></td>
            </tr>

            <tr>
                <td align="left">
                    <label for="">Gender</label>
                </td>
                <td>
                    <input type="radio" name="gender" value="male"/>Male
                    <input type="radio" name="gender" value="female"/>Female
                    <input type="radio" name="gender" value="other"/>Other
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <input type="submit" name="submit" value="Submit"/>
                    <input type="reset" name="reset" value="Reset"/>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>