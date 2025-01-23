<?php
    session_start();
    require_once('../model/userModel.php');

    $users = [];

    // Check if a search query is provided via GET
    if (isset($_GET['search'])) {
        $query = trim($_GET['search']);
        if ($query !== '') {
            $users = searchUsers($query); // Search users only within authors
        } else {
            $users = fetchAllUser(); // Fetch all user when query is empty
        }
    } else {
        $users = fetchAllUser(); // Default: Fetch all user
    }

    // Generate table rows dynamically
    foreach ($users as $user) {
        echo "<tr>
            <td align='center'>" . htmlspecialchars($user['utype']) . "</td>
            <td align='center'>" . htmlspecialchars($user['username']) . "</td>
            <td align='center'>" . htmlspecialchars($user['email']) . "</td>
            <td align='center'>
                <a href='../view/searchProfile.php?id=" . htmlspecialchars($user['id']) . "'>View Information</a>
            </td>
        </tr>";
    }

    // If no users are found, display a message
    if (empty($users)) {
        echo "<tr>
            <td colspan='4' align='center'>No authors found!</td>
        </tr>";
    }
?>
