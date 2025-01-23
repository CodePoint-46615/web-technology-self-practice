<?php
    session_start();
    require_once('../model/userModel.php');

    $blogs = [];
    if (isset($_GET['search'])) {
        $query = trim($_GET['search']);
        $blogs = $query !== '' ? searchBlog($query) : getAllBlog();
    } else {
        $blogs = getAllBlog();
    }

    if (!empty($blogs)) {
        foreach ($blogs as $blog) {
            echo "<tr>
                <td align='center'>" . htmlspecialchars($blog['title']) . "</td>
                <td align='center'>" . htmlspecialchars($blog['author_name']) . "</td>
                <td align='center'>" . htmlspecialchars($blog['created_at']) . "</td>
                <td align='center'>" . htmlspecialchars($blog['summary']) . "</td>
            </tr>";
        }
    } else {
        echo "<tr>
            <td colspan='4' align='center'>No blog posts found!</td>
        </tr>";
    }
?>
