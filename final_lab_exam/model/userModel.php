<?php
    //Database connection
    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'blog');
        return $con;
    }

    //check Duplicate Email
    function checkDuplicateEmail($email) {
        $con = getConnection();
        // SQL query to check if email already exists
        $sql = "SELECT COUNT(*) FROM users WHERE username = '{$email}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        
        // If the email exists, return true, otherwise false
        return $row[0] > 0;
    }

    //check Duplicate Phone
    function checkDuplicatePhone($phone) {
        $con = getConnection();
        // SQL query to check if email already exists
        $sql = "SELECT COUNT(*) FROM users WHERE contact = '{$phone}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        
        // If the email exists, return true, otherwise false
        return $row[0] > 0;
    }

    //ADD user to the system
    function addUser($username, $phone, $email, $password, $utype) {
        $con = getConnection();
        if (checkDuplicateEmail($email)|| checkDuplicatePhone($phone)) {
            return false; // If email is duplicate, return false
        }
        else{
            $sql = "INSERT INTO users (name, contact, username, password, user_type) 
            VALUES ('{$username}', '{$phone}', '{$email}','{$password}', '{$utype}')";
            if (mysqli_query($con, $sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    //login
    function login($email, $password){
        $con = getConnection();
        $sql = "select * from users where username='{$email}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    //get all user 
    function getAllUser(){
        $con = getConnection();
        $sql = "select * from users";
        $result = mysqli_query($con, $sql);
        $users = [];

        while($row = mysqli_fetch_assoc($result)){
            array_push($users, $row);
        }  
        return $users;
    }

    //get user by id
    function getUser($id){
        $con = getConnection();
        $sql = "select * from users where id='{$id}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //get user by mail
    function getUserByEmail($email) {
        $con = getConnection();
        $sql = "SELECT * FROM users WHERE username='{$email}'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    

    //Edit Profile
    function editProfile($id, $name, $email, $phone){
        $con = getConnection();
        $sql = "UPDATE users 
                SET name='$name', username='$email', contact='$phone' 
                WHERE id='$id'";
        if(mysqli_query($con, $sql)){
            return true;
        } 
        else {
            return false;
        }
    }

    // //verify pass
    // function verifyPassword($id, $oldpass) {
    //     $con = getConnection();
    //     $id = mysqli_real_escape_string($con, $id);
    //     $old_password = mysqli_real_escape_string($con, $oldpass);
    //     $sql = "SELECT * FROM users WHERE id = '$id' AND password = '$oldpass'";
    //     $result = mysqli_query($con, $sql);
    
    //     if (mysqli_num_rows($result) > 0) {
    //         return true; // Password matches
    //     } else {
    //         return false; // Password does not match
    //     }
    // }
    

    // //update pass
    // function editPassword($id, $password){
    //     $con = getConnection();
    //     $sql = "UPDATE user SET password='$password' WHERE id='$id'";
    //     if(mysqli_query($con, $sql)){
    //         return true;
    //     } 
    //     else {
    //         return false;
    //     }
    // }

    // function updateImage($id, $image) {
    //     $con = getConnection(); 
    //     $stmt = $con->prepare("UPDATE user SET image = ? WHERE id = ?");
    //     $stmt->bind_param("si", $image, $id);
    //     $status = $stmt->execute();
    //     $stmt->close();
    //     return $status;
    // }

    //search user
    function searchUsers($query) {
        $con = getConnection();
        
        // Use prepared statements to prevent SQL injection
        $sql = "
            SELECT * 
            FROM users 
            WHERE name LIKE ? 
            OR username LIKE ? 
            OR contact LIKE ? 
            OR id LIKE ?
        ";
        $stmt = mysqli_prepare($con, $sql);
        
        $likeQuery = "%{$query}%";
        mysqli_stmt_bind_param($stmt, 'ssss', $likeQuery, $likeQuery, $likeQuery, $likeQuery);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        
        return $users;
    }
    
?>