<?php
session_start();
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && isset($_SESSION['user_id'])) {
    $postId = intval($_POST['post_id']);
    $userId = $_SESSION['user_id'];

    $db = (new Database())->connect();

    // Ensure the logged-in user owns the post
    $stmt = $db->prepare("SELECT * FROM posts WHERE post_id = :post_id AND user_id = :user_id");
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        // Delete the post
        $stmt = $db->prepare("DELETE FROM posts WHERE post_id = :post_id");
        $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Optionally delete the image file
            if (file_exists($post['image_path'])) {
                unlink($post['image_path']);
            }
            header('Location: explore.php?message=Post deleted successfully');
            exit();
        } else {
            echo "Error deleting post.";
        }
    } else {
        echo "Unauthorized action.";
    }
} else {
    echo "Invalid request.";
}
