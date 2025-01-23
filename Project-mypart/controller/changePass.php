<?php
    session_start();
    require_once('../model/userModel.php');

    if(isset($_REQUEST['submit'])){
        $oldpass= trim($_REQUEST['current-password']);
        $newpass= trim($_REQUEST['new-password']);
        $confirmpass= trim($_REQUEST['confirm-password']);
        $id = $_SESSION['update_id'];

        $response = []; 

        if(empty($oldpass)||empty($newpass)||empty($confirmpass)){
            $response['status'] = 'error'; 
            $response['message'] = 'Null Field is not acceptable';
            exit;
        }
        else if (strlen($newpass) != 5 || !ctype_digit($newpass) || $newpass != $confirmpass) {
            $response['status'] = 'error'; 
            $response['message'] = 'Password does not match or invalid';
            exit; 
        } 
        else if(verifyPassword($id, $oldpass)== true){
            $status=editPassword($id, $newpass);
            if($status){
                $response['status'] = 'Success';
                $response['message'] = 'Password Changed Successfully.'; 
                exit;
            }
            else{
                $response['status'] = 'Error';
                $response['message'] = 'Failed to update password';
                exit; 
            }
        }
        echo json_encode($response);
        exit; 
    }
?>