<?php
    include 'db.php';
    function getConnection(){
        $con = mysqli_connect('127.0.0.1', 'root', '', 'user_management');
        return $con;
    }

    function login($username, $password){
        $con = getConnection();
        $sql = "select * from users where username='{$username}' and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);

        if($count ==1){
            return true;
        }else{
            return false;
        }
    }

    function addUser($username, $password, $email){
        $con = getConnection();
        $sql = "insert into users VALUES('', '{$username}', '{$password}', '{$email}')";
        if(mysqli_query($con, $sql)){
            return true;
        } else{
            return false;
        }
    }

    function editUser($id, $username, $email, $password)
    {
        $con=getConnection();
        $sql = "UPDATE users
            SET name = '$name', email = '$email', passwordype = '$password'
            WHERE id = '$id'";
        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUsers($id)
    {
        $con = getConnection();
        $sql = "delete from users where id={$id}";
        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    function getUser($id){
        $con=getConnection();
        $sql = "SELECT * FROM users where id={$id}";
        $result = mysqli_query($con, $sql);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

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

?>