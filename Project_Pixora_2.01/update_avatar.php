<?php
session_start();
require_once 'Database.php';
require_once 'ImageHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && isset($_FILES['avatar'])) {
        $uploadResult = ImageHelper::processUpload(
            $_FILES['avatar'],
            'uploads/avatars/',
            400,
            400,
            85
        );

        if ($uploadResult['success']) {
            $newFileName = $uploadResult['path'];

            // Connect to the database
            $db = (new Database())->connect();
            $stmt = $db->prepare('UPDATE users SET avatar = :avatar WHERE user_id = :user_id');
            $stmt->bindParam(':avatar', $newFileName);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $_SESSION['avatar'] = $newFileName; // Update session with new avatar
                header('Location: account.php'); // Redirect to profile page
                exit();
            } else {
                echo 'Database update failed.';
            }
        } else {
            echo htmlspecialchars($uploadResult['error'] ?? 'Avatar upload failed.');
        }
    } else {
        echo 'No user logged in or file uploaded.';
    }
} else {
    echo 'Invalid request.';
}
