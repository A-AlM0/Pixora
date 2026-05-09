<?php

require_once 'Database.php';

class Explore
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getTrendingPosts()
    {
        $sql = "SELECT * FROM Posts ORDER BY created_at DESC LIMIT 10";
        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchPosts($keyword)
    {
        $sql = "SELECT * FROM Posts WHERE caption LIKE :keyword";
        $stmt = $this->db->prepare($sql);

        $searchKeyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $searchKeyword);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostsByCategory($category)
    {
        $sql = "SELECT * FROM Explore INNER JOIN Posts ON Explore.post_id = Posts.post_id WHERE Explore.tag = :category";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrendingPostsByLikes($limit = 100)
{
    $sql = "SELECT posts.post_id, posts.image_path, posts.caption, COUNT(likes.like_id) AS like_count
            FROM posts
            LEFT JOIN likes ON posts.post_id = likes.post_id
            GROUP BY posts.post_id
            ORDER BY like_count DESC, posts.created_at DESC
            LIMIT :limit";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
