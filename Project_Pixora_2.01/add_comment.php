<?php
session_start();
require_once 'posts.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('You must be logged in to post a comment.');
        window.location.href = 'login.php'; // Redirect to login page
    </script>";
    exit;
}

// Validate input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['comment'])) {
    $postId = intval($_POST['post_id']);
    $userId = $_SESSION['user_id'];
    $comment = trim($_POST['comment']);

    if (empty($comment)) {
        die('Comment cannot be empty.');
    }

    // Add the comment using the Posts class
    $posts = new Posts();
    if ($posts->addComment($postId, $userId, $comment)) {
        header("Location: post.php?post_id=$postId");
        exit();
    } else {
        die('Failed to add comment. Please try again.');
    }
} else {
    die('Invalid request.');
}
