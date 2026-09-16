<?php

require_once 'Database.php';

class Posts
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function createPost($userId, $image, $caption)
    {
        $sql = "INSERT INTO Posts (user_id, image, caption) VALUES (:user_id, :image, :caption)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        $stmt->bindParam(':caption', $caption);

        return $stmt->execute();
    }

    public function getPost($postId)
    {
        $sql = "SELECT * FROM Posts WHERE post_id = :post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM Posts";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePost($postId)
    {
        $sql = "DELETE FROM Posts WHERE post_id = :post_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':post_id', $postId);

        return $stmt->execute();
    }

    public function getPostsByUserId($userId)
{
    $sql = "SELECT * FROM Posts WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function uploadPost($userId, $caption, $imagePath)
{
    $sql = "INSERT INTO Posts (user_id, caption, image_path, created_at) VALUES (:user_id, :caption, :image_path, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':caption', $caption);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->execute();
}

public function getCommentsByPostId($postId)
{
    $sql = "SELECT c.comment_id, c.comment, c.commented_at, u.username, u.profile_picture
            FROM comments c
            INNER JOIN users u ON c.user_id = u.user_id
            WHERE c.post_id = :post_id
            ORDER BY c.commented_at ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function likePost($userId, $postId)
{
    $sql = "INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id) 
            ON DUPLICATE KEY UPDATE user_id = user_id"; // Prevent duplicates
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
}
public function getLikesCount($postId)
{
    $sql = "SELECT COUNT(*) FROM likes WHERE post_id = :post_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}
public function getPostWithUser($postId)
{
    $sql = "SELECT 
                posts.*,
                users.username,
                users.avatar
            FROM posts
            JOIN users ON posts.user_id = users.user_id
            WHERE posts.post_id = :post_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function addComment($postId, $userId, $comment)
{
    $sql = "INSERT INTO comments (post_id, user_id, comment, commented_at) VALUES (:post_id, :user_id, :comment, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

    return $stmt->execute();
}

public function unlikePost($userId, $postId)
{
    $sql = "DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
}

public function hasLikedPost($userId, $postId)
{
    $sql = "SELECT 1 FROM likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn() ? true : false;
}

public function getLikedPostsByUserId($userId)
{
    $sql = "SELECT p.post_id, p.image_path, p.caption, p.created_at, u.username, u.avatar
            FROM likes l
            INNER JOIN posts p ON l.post_id = p.post_id
            INNER JOIN users u ON p.user_id = u.user_id
            WHERE l.user_id = :user_id
            ORDER BY l.created_at DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
