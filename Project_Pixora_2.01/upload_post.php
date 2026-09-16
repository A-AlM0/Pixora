<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'Posts.php';
require_once 'ImageHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $posts = new Posts();

    $description = trim($_POST['description'] ?? '');
    $userId = $_SESSION['user_id'];

    if (isset($_FILES['post_image'])) {
        $uploadResult = ImageHelper::processUpload(
            $_FILES['post_image'],
            'uploads/posts/',
            1920,
            1920,
            85
        );

        if ($uploadResult['success']) {
            $posts->uploadPost($userId, $description, $uploadResult['path']);
            header('Location: account.php');
            exit();
        } else {
            echo htmlspecialchars($uploadResult['error'] ?? 'Error uploading file.');
        }
    } else {
        echo "No file selected.";
    }
} else {
    echo "Invalid request.";
}
?>
