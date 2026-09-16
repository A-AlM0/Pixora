<?php
require_once 'Users.php'; // Include the Users class
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $hobbies = $_POST['hobbies'];

    $users = new Users();

    try {
        $result = $users->createUser(
            $username,
            $email,
            $password,
            $firstName,
            $lastName,
            $phoneNumber,
            $hobbies
        );

        if ($result) {
            $_SESSION['signup_success'] = "Registration successful! You can now log in.";
            header('Location: main.php?signup_success=1'); // Redirect to trigger login modal
            exit();
        } else {
            $_SESSION['signup_error'] = "Error: Unable to register user.";
            header('Location: main.php?signup_failed=1');
            exit();
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') { // Duplicate entry
            $_SESSION['signup_error'] = "Username or email already exists.";
        } else {
            $_SESSION['signup_error'] = "Error: " . $e->getMessage();
        }
        header('Location: main.php?signup_failed=1');
        exit();
    }
} else {
    echo "Invalid request method.";
}
?>
