<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'Posts.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $posts = new Posts();

    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];

    if (isset($_FILES['post_image']) && $_FILES['post_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/posts/';
        $fileName = uniqid() . '_' . basename($_FILES['post_image']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                die("Failed to create upload directory.");
            }
        }

        if (move_uploaded_file($_FILES['post_image']['tmp_name'], $uploadFilePath)) {
            $posts->uploadPost($userId, $description, $uploadFilePath);
            header('Location: account.php');
            exit();
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "Invalid request.";
}
?>
