<?php
    session_start();
    require_once('../model/userModel.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    // Use 'id' from request or session
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $userId = $_REQUEST['id'];
    } elseif (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];
    } else {
        echo "Error: User ID is missing!";
        exit;
    }

    // Retrieve the user details
    $user = getUser($userId);
    if (!$user) {
        echo "Error: User not found!";
        exit;
    }

    // Fetch all blogs from the database
    $blogs = getAllSurvey();

    $_SESSION['update_id'] = $userId;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Feedback</title>
    <link rel="stylesheet" href="../asset/CSS/viewSurvey.css">
</head>

<body>
    <h1 id="main-title" align="center">Survey Feedback</h1>     
    <main id="main-content">

        <div id="home-section">
            <h2 id="latest-blog-title" align="center">Latest Survey List</h2>
            <table id="blog-table" border="1" align="center" width="400" height="100" cellpadding="5" cellspacing="0">
                <tr id="blog-table-header">
                    <th id="column-title">Satisfaction</th>
                    <th id="column-author">Recommend</th>
                    <th id="column-date">improvements</th>
                    <th id="column-summary">Rating</th>
                    <th id="column-summary">Rating</th>
                </tr>

                <!-- Dynamically populate blog rows -->
                <?php foreach ($blogs as $blog): ?>
                <tr id="dynamic-blog-entry">
                    <td id="blog-title-dynamic"><?= htmlspecialchars($blog['satisfaction']) ?></td>
                    <td id="blog-author-dynamic"><?= htmlspecialchars($blog['recommend']) ?></td>
                    <td id="blog-date-dynamic"><?= htmlspecialchars($blog['improvements']) ?></td>
                    <td id="blog-summary-dynamic"><?= htmlspecialchars($blog['rating']) ?></td>
                    <td id="blog-summary-dynamic"><?= htmlspecialchars($blog['submitted_at']) ?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <td colspan="5" align="center">
                        <a href="viewProfile.php" align="center" >Go to profile</a>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
