<?php
require_once 'posts.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];
$postId = $_POST['post_id'] ?? null;
$action = $_POST['action'] ?? null; // "like" or "unlike"

if (!$postId || !$action) {
    echo json_encode(['error' => 'Invalid request']);
    exit();
}

$posts = new Posts();

if ($action === 'like') {
    $posts->likePost($userId, $postId);
} elseif ($action === 'unlike') {
    $posts->unlikePost($userId, $postId);
}

$likesCount = $posts->getLikesCount($postId);
echo json_encode(['likesCount' => $likesCount]);
?>
