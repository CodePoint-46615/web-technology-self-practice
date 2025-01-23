<?php
require_once 'userModel.php'; // Include your userModel file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    
    // Assuming versifyPassword takes a password string and returns validation info
    $userModel = new UserModel(); // Instantiate the class containing the function
    $result = $userModel->verifyPassword($id, $oldpass);

    // Return the result as JSON
    echo json_encode(['valid' => $result]);
    exit;
}
?>
