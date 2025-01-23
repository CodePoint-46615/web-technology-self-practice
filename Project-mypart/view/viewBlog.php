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
    $blogs = getAllBlog();
    if (isset($_GET['search'])) {
        $query = trim($_GET['search']);
        if ($query !== '') {
            $users = searchBlog($query); // Search within authors
        } else {
            $users = getAllBlog(); // Fetch all authors if query is empty
        }
    } else {
        $users = getAllBlog(); // Default: Fetch all authors
    }

    $_SESSION['update_id'] = $userId;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Blog</title>
    <link rel="stylesheet" href="../asset/CSS/viewBlog.css">
</head>

<body>
    <h1 id="main-title" align="center">Agriculture Blog</h1>    
    <main id="main-content">
        <div id="search-section">
            <h2 id="search-title" align="center">Search Blog Posts</h2>
            <form id="search-form" method="post" action="../controller/checkviewBlog.php" enctype="" align="center">
                <input id="search-bar" type="text" placeholder="Search by title..." onkeyup="searchBlog()" />
            </form>
        </div>

        <div id="home-section">
            <h2 id="latest-blog-title" align="center">Latest Blog</h2>
            <table id="blog-table" border="1" align="center" width="400" height="100" cellpadding="5" cellspacing="0">
                <tr id="blog-table-header">
                    <th id="column-title">Title</th>
                    <th id="column-author">Author</th>
                    <th id="column-date">Date</th>
                    <th id="column-summary">Summary</th>
                </tr>

                <!-- Dynamically populate blog rows -->
                <?php foreach ($blogs as $blog): ?>
                <tr id="dynamic-blog-entry">
                    <td id="blog-title-dynamic"><?= htmlspecialchars($blog['title']) ?></td>
                    <td id="blog-author-dynamic"><?= htmlspecialchars($blog['author_name']) ?></td>
                    <td id="blog-date-dynamic"><?= htmlspecialchars($blog['created_at']) ?></td>
                    <td id="blog-summary-dynamic"><?= htmlspecialchars($blog['summary']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table><br>

                <!-- Advisor-specific section -->
            <table id="write-blog-table" border="1" align="center" width="400" height="100" cellpadding="5" cellspacing="0">
                <?php if ($user['utype'] === 'Advisor'): ?>
                <tr id="create-blog-row">
                    <td id="create-blog-cell" colspan="4" align='center'>
                        <h2 id="create-blog-title">Create a New Blog</h2>
                        <p id="advisor-note">This button will appear for Advisor only.</p>
                        <button id="create-blog-button">
                            <a align="center" href="viewCreateBlog.php?id=<?= $user['id'] ?>">Create New Post</a>
                        </button>
                    </td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" align="center">
                        <a href="viewProfile.php" align="center" >Go to profile</a>
                    </td>
                </tr>
               
            </table>
            
        </div>
    </main>
    <script src="../asset/JS/blog.js"></script>
</body>
</html>
