<?php 
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $username = trim($_REQUEST['name']);
        $words = explode(" ", $username);
        $email = trim($_REQUEST['email']);
        $phone = trim($_REQUEST['phone']);
        $gender = trim($_REQUEST['gender']);
        $utype = trim($_REQUEST['utype']);
        $dob = trim($_REQUEST['dob']);
        $password = trim($_REQUEST['pass']);
        $repassword = trim($_REQUEST['repass']);
        $image = $_FILES['image']['name'];
        $tmp = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        

        // Validate inputs
        if (empty($username) || empty($email) || empty($phone) || empty($gender) ||empty($utype) || empty($dob) || empty($password) || empty($repassword) || empty($image)) {
            echo '<script>alert("Null Field is not accepted.")</script>';
        } 
        else if (!ctype_alpha($username[0]) || count($words) < 2 || !preg_match('/^[a-zA-Z .-]+$/', $username)) {
            echo '<script>alert("Invalid name format.")</script>';
        } 
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid Email Format")</script>'; 
        } 
        else if (!preg_match('/^\d{11}$/', $phone)) {
            echo '<script>alert("Invalid phone number. It must be exactly 11 digits.")</script>';
        } 
        else if (strlen($password) != 5 || !ctype_digit($password) || $password != $repassword) {
            echo '<script>alert("Password does not match or invalid.")</script>';
        } 
        else if ($tmp != 'jpg' && $tmp != 'png') {
            echo '<script>alert("Error: Only JPG and PNG files are allowed.")</script>'; 
        } 
        else {
            // Handle image upload
            $src = $_FILES['image']['tmp_name'];
            $des = '../asset/' . $image;
            if (!move_uploaded_file($src, $des)) {
                echo '<script>alert("Error uploading file.")</script>';
            } 
            else {
                // Add to database
                $status = addUser($username, $email, $phone, $gender, $dob, $image, $password, $utype);
                if($status){
                    header('location: ../view/login.php');
                } 
                else {
                    echo '<script>alert("This id is already exist")</script>';
                }
            }
        }
    } 
    else {
        header('location: ../view/signup.php');
    }
?>
