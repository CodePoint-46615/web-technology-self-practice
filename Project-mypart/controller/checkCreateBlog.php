<?php
session_start();
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['blog']) ? trim($_POST['blog']) : '';

    if (empty($title) || empty($content)) {
        $_SESSION['message'] = "Title and content cannot be empty.";
        header('Location: ../view/viewCreateBlog.php');
        exit;
    } 
    
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Error: User is not logged in.";
        header('Location: ../view/viewCreateBlog.php');
        exit;
    } 

    $author_id = $_SESSION['user_id'];

    // Attempt to insert the blog
    $result = insertBlog($author_id, $title, $content);

    if ($result === true) {
        $_SESSION['message'] = "Successfully created Blog.";
        header('Location: ../view/viewCreateBlog.php');
        exit;
    } else {
        $_SESSION['message'] = "Error: " . $result;
        header('Location: ../view/viewCreateBlog.php');
        exit;
    }
}
?>
