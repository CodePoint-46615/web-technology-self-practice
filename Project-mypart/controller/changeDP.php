<?php
session_start();
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file is uploaded and session has the user ID
    if (isset($_FILES['profile-picture']) && isset($_SESSION['update_id'])) {
        $id = $_SESSION['update_id'];
        $image = $_FILES['profile-picture']['name'];
        $src = $_FILES['profile-picture']['tmp_name'];
        $des = '../asset/' . basename($image);

        // Validate image type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profile-picture']['type'], $allowedTypes)) {
            echo '<script>alert("Invalid file type. Only JPG, PNG, and GIF are allowed.")</script>';
            exit;
        }
        if ($_FILES['profile-picture']['size'] > 2000000) { // Limit to 2MB
            echo '<script>alert("File size exceeds limit (2MB).")</script>';
            exit;
        }

        // Move file to destination
        if (!move_uploaded_file($src, $des)) {
            echo '<script>alert("Error uploading file.")</script>';
        } else {
            // Update in database
            if (updateImage($id, $image)) {
                echo '<script>alert("Image uploaded successfully!"); window.location.href = "../view/viewChangeDP.php?id=' . $id . '";</script>';
            } else {
                echo '<script>alert("Failed to update the image in the database.")</script>';
            }
        }
    } else {
        echo '<script>alert("Invalid form submission.")</script>';
    }
} else {
    header('location: ../view/viewChangeDP.php');
    exit;
}
?>
