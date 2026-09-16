<?php
require_once 'Users.php'; // Include the Users class
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login via POST
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = new Users();
    try {
        $user = $users->login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

              // Debug
  // echo '<pre>';
    //var_dump($_SESSION);
    //echo '</pre>';
    //exit(); 
    
            header('Location: main.php'); // Redirect to the main page
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password.";
            header('Location: main.php?login_failed=1');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Redirect to main.html where the login form exists
    header('Location: main.php?signup_success=1'); // Optionally pass a flag to indicate successful signup
    exit();
} else {
    echo "Invalid request method.";
}
?>
