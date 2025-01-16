<?php 
session_start();
require_once('../model/userModel.php');

if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        $status = deleteUser($_POST['id']);
        if ($status) {
            // Clear the session variables related to the deleted user
            if (isset($_SESSION['update_id']) && $_SESSION['update_id'] == $_POST['id']) {
                unset($_SESSION['update_id']);
            }
            if (isset($_SESSION['id']) && $_SESSION['id'] == $_POST['id']) {
                unset($_SESSION['id']);
            }

            // Redirect to a safe page
            header('Location: ../view/viewProfile.php'); // Adjust this path as needed
            exit();
        } 
        else {
            echo "An error occurred while deleting. Please try again.";
        }
    } 
    else {
        echo "No ID provided for deletion.";
    }
} 
else {
    header('Location: ../view/viewProfile.php'); // Adjust this path as needed
    exit();
}
?>
