<?php
    session_start();
    require_once('../model/userModel.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $gender = trim($_POST['gender']);
        $dob = trim($_POST['dob']);
        $id = $_SESSION['update_id'];

        $response = [];

        if (empty($username) || empty($email) || empty($phone) || empty($gender) || empty($dob)) {
            $response['status'] = 'error';
            $response['message'] = 'All fields are required.';
        } elseif (!ctype_alpha($username[0]) || str_word_count($username) < 2 || !preg_match('/^[a-zA-Z .-]+$/', $username)) {
            $response['status'] = 'error';
            $response['message'] = 'Invalid name format.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['status'] = 'error';
            $response['message'] = 'Invalid email format.';
        } elseif (!preg_match('/^\d{11}$/', $phone)) {
            $response['status'] = 'error';
            $response['message'] = 'Phone number must be exactly 11 digits.';
        } else {
            $status = editProfile($id, $username, $email, $phone, $gender, $dob);
            if ($status) {
                $response['status'] = 'success';
                $response['message'] = 'Profile updated successfully.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to update profile.';
            }
        }

        echo json_encode($response);
        exit;
    }
?>
