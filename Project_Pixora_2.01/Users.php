<?php

require_once 'Database.php';

class Users
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function createUser($username, $email, $password, $firstName, $lastName, $phoneNumber, $hobbies)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
        $sql = "INSERT INTO Users (username, email, password_hash, first_name, last_name, phone_number, hobbies) 
                VALUES (:username, :email, :password, :first_name, :last_name, :phone_number, :hobbies)";
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':phone_number', $phoneNumber);
        $stmt->bindParam(':hobbies', $hobbies);
    
        return $stmt->execute();
    }

    public function getUser($userId)
    {
        $sql = "SELECT * FROM Users WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfilePicture($userId, $image)
    {
        $sql = "UPDATE Users SET profile_picture = :image WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
        $stmt->bindParam(':user_id', $userId);

        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return false;
    }

    public function bio($userId, $bio)
    {
        $sql = "UPDATE Users SET bio = :bio WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    public function getUserById($userId)
{
    $sql = "SELECT * FROM Users WHERE user_id = :user_id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
