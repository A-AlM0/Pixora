<?php
session_start();
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && isset($_FILES['avatar'])) {
        $avatar = $_FILES['avatar'];

        // Define upload directory
        $uploadDir = 'uploads/avatars/';
        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Generate a unique file name
        $newFileName = $uploadDir . uniqid() . '_' . basename($avatar['name']);

        // Move uploaded file
        if (move_uploaded_file($avatar['tmp_name'], $newFileName)) {
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
            echo 'File upload failed.';
        }
    } else {
        echo 'No user logged in or file uploaded.';
    }
} else {
    echo 'Invalid request.';
}
