<?php
require_once 'Posts.php';
require_once 'Users.php';

session_start();
$users = new Users(); // Initialize the Users class

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user = $users->getUserById($_SESSION['user_id']); // Fetch the logged-in user's data
    if (!$user) {
        echo "Error fetching user data.";
        exit();
    }
} else {
    $user = null; // Handle unauthenticated users
}

if (isset($_GET['post_id'])) {
    $postId = intval($_GET['post_id']); // Sanitize the input
    $posts = new Posts();
    $likesCount = $posts->getLikesCount($postId); // Get likes count for the post
    $post = $posts->getPostWithUser($postId);
    $comments = $comments = $posts->getCommentsByPostId($postId);

    if ($post) {
        $imagePath = htmlspecialchars($post['image_path']);
        $caption = htmlspecialchars($post['caption']);
        $username = isset($post['username']) ? htmlspecialchars($post['username']) : "Unknown User";
    } else {
        $imagePath = 'images/default.jpg'; // Fallback image
        $caption = "Post not found.";
        $username = "Unknown User";
    }
} else {
    $imagePath = 'images/default.jpg'; // Fallback for missing post_id
    $caption = "No post specified.";
    $username = "Unknown User";
}

$response = [];





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css?v=5.5">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="manifest" href="/PROJECT_PIXORA_2.01/manifest.json">
        <meta name="theme-color" content="#007bff">

    <script defer src="js/app.js"></script>
    <script defer src="js/bootstrap.bundle.min.js"></script>

</head>

<body>

 <!--Sign Up-->
 <div class="modal fade" id="SignUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    <!-- Error Message -->
    <?php if (isset($_SESSION['signup_error'])): ?>
        <div class="text-danger text-center mb-3" id="error-message">
            <?= htmlspecialchars($_SESSION['signup_error']); ?>
        </div>
        <?php unset($_SESSION['signup_error']); ?>
    <?php endif; ?>

    <!-- Signup Form -->
    <form action="signup.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control <?= isset($_SESSION['signup_error']) ? 'is-invalid' : ''; ?>" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control <?= isset($_SESSION['signup_error']) ? 'is-invalid' : ''; ?>" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
        </div>
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phoneNumber" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label for="hobbies" class="form-label">Hobbies</label>
            <input type="text" class="form-control" id="hobbies" name="hobbies" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= isset($_SESSION['signup_error']) ? 'is-invalid' : ''; ?>" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

            </div>
        </div>
    </div>

    <!--Login-->
    <div class="modal fade" id="LogIn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Loin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Error Message -->
                <?php if (isset($_SESSION['login_error'])): ?>
                <div class="text-danger text-center mb-3" id="error-message">
                 <?= htmlspecialchars($_SESSION['login_error']); ?>
                </div>
                <?php unset($_SESSION['login_error']); ?>
                 <?php endif; ?>

    <!-- Login Form -->
    <form action="login.php" method="POST">
        <div class="mb-3">
            <label for="email" class="col-form-label">Email</label>
            <input type="email" class="form-control <?= isset($_SESSION['login_error']) ? 'is-invalid' : ''; ?>" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control <?= isset($_SESSION['login_error']) ? 'is-invalid' : ''; ?>" id="password" name="password" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Log In</button>
        </div>
    </form>
</div>
            </div>
        </div>
    </div>

    <!--Navbar start-->
    <div class="container">
        <nav class="navbar navbar-expand-lg fs-6 fw-semibold">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="main.php">
                <img src="images/pixora_logo.png" alt="Logo" width="150" height="150"
                    class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="main.php">Home</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="explore.php">Explore</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="aboutUs.php">About Us</a>
                    </li>

                    <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['username'])): ?>
                    <li class="nav-item mx-4">
                        <a href="account.php" class="nav-link">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </li>
                <?php else: ?>
                    <li>
                        <button type="button" class="btn btn-primary mx-4 my-1" data-bs-toggle="modal"
                            data-bs-target="#SignUp">
                            Sign Up
                        </button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary mx-4 my-1" data-bs-toggle="modal"
                            data-bs-target="#LogIn">
                            Login
                        </button>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
    <!--Navbar end-->


    <!--Hero start-->
    <div class="container overflow-x-hidden">
        <div class="row my-2 justify-content-center">
            <div class="row">
                <div class="d-lg-none">
                    <div class="row justify-content-start align-items-center d-flex">
                        <div class="col-4 col-sm-4 col-lg-3 d-inline-block">
                            <div class="acc_avatar_post mb-5">
                            <img class="img-fluid" src="<?= htmlspecialchars($post['avatar'] ?? 'uploads/avatars/acc.png'); ?>" alt="Avatar">
                          
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-lg-5">
                        <a href="profile.php?username=<?= urlencode($post['username'] ?? 'Unknown User'); ?>" class="mb-4 nav-link">
                            <?= htmlspecialchars($post['username'] ?? 'Unknown User'); ?>
                            </a>


                        </div>
                        <div class="col pb-4 offset-2">
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id']): ?>
                            <form action="delete_post.php" method="POST" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']); ?>">
                        <button class="btn bg-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Post Column -->
                <div class="col-12 col-lg-6 col-md-12 col-sm-12 p-0">
                  <div class="img_container_2">
                  <img class="img-fluid" src="<?= htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                  </div>
                </div>

                <!-- Text Column -->
                <div
                    class="col-12 col-lg-6 col-md-12 col-sm-12 d-flex flex-column justify-content-between bg-light p-4">
                    <div class="container d-none d-lg-block">
                        <div class="row justify-content-start align-items-center d-flex">
                            <div class="col-5 col-sm-4 col-lg-3 d-inline-block">
                                <div class="acc_avatar_post mb-3">
                                <img class="img-fluid" src="<?= htmlspecialchars($post['avatar'] ?? 'uploads/avatars/acc.png'); ?>" alt="Avatar">
                                </div>
                            </div>
                            <div class="col-7 col-sm-8 col-lg-5">
                                <a href="profile.php?username=<?= urlencode($post['username'] ?? 'Unknown User'); ?>" class="nav-link">
                                <?= htmlspecialchars($post['username'] ?? 'Unknown User'); ?>
                                </a>
                            </div>
                            <div class="col pb-4 offset-2">
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id']): ?>
                    <form action="delete_post.php" method="POST" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']); ?>">
                        <button class="btn bg-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                <?php endif; ?>
            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 comment-section">
                        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="user-comments mt-4">
                    <div class="user-name">
                        <strong><?= htmlspecialchars($comment['username']); ?></strong>
                        <small class="text-muted">(<?= date('Y-m-d', strtotime($comment['commented_at'])); ?>)</small>
                        </div>
                    <div class="comment"><?= htmlspecialchars($comment['comment']); ?></div>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        <?php endif; ?>

                           

                        </div>

                    </div>
                    <div class="col-12 mt-auto">
                    <button class="like-button btn <?= $posts->hasLikedPost($user['user_id'], $post['post_id']) ? 'liked' : ''; ?>" 
            data-post-id="<?= $post['post_id']; ?>">
        <i class="fa-solid fa-heart"></i>
    </button>
                    </div>



                    <div class="col-12 pt-2">
                    <span class="likes-count"><?= $posts->getLikesCount($post['post_id']); ?> Likes</span>
                    </div>
                    <div class="col-12">
    <form action="add_comment.php" method="POST">
        <input type="hidden" name="post_id" value="<?= $postId; ?>">
        <div class="input-group">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- User not logged in -->
            <input 
                type="text" 
                class="form-control" 
                name="comment" 
                placeholder="log in to like and comment..." 
                disabled 
                required 
            />
        <?php else: ?>
            <!-- User logged in -->
            <input 
                type="text" 
                class="form-control" 
                name="comment" 
                placeholder="Add a comment..." 
                required 
            />
        <?php endif; ?>
        <button class="btn btn-outline-secondary" type="submit" <?= !isset($_SESSION['user_id']) ? 'disabled' : ''; ?>>Post</button>
        </div>
    </form>
</div>

                </div>
            </div>

                <!--Footer start-->
                <div class="container-fluid mt-3">
                    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
                        <p class="col-md-4 mb-0 text-muted">&copy; 2024 YUC, Westsiders</p>



                        <ul class="nav col-md-4 justify-content-c">
                            <li class="nav-item"><a href="main.php" class="nav-link px-2 text-muted">Home</a></li>
                            <li class="nav-item"><a href="explore.php" class="nav-link px-2 text-muted">Explore</a></li>
                            <li class="nav-item"><a href="aboutUs.php" class="nav-link px-2 text-muted">About Us</a></li>
                            <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['username'])): ?>
                    <li class="nav-item">
                            <a href="account.php" class="nav-link"><?= htmlspecialchars($_SESSION['username']); ?>!</a>
                    </li>
                <?php endif; ?>                        </ul>
                    </footer>
                </div>
                <!--Footer end-->
        </div>
    </div>
</body>
<script> 
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const action = this.classList.contains('liked') ? 'unlike' : 'like';

            fetch('like_post.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `post_id=${postId}&action=${action}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        this.classList.toggle('liked');
                        this.nextElementSibling.textContent = `${data.likesCount} Likes`;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});

        //script to make login pop up after signup
        document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('signup_success')) {
            const loginModalElement = document.getElementById('LogIn');
            
            if (loginModalElement) {
                const loginModal = new bootstrap.Modal(loginModalElement);
                loginModal.show();

                // Clean the URL
                history.replaceState({}, document.title, window.location.pathname);
            } else {
                console.error("Login modal element not found.");
            }
        }
    });
      // script to show modal with the error message if login fails
    document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('login_failed')) {
        const loginModalElement = document.getElementById('LogIn');
        if (loginModalElement) {
            const loginModal = new bootstrap.Modal(loginModalElement);
            loginModal.show();
            history.replaceState({}, document.title, window.location.pathname); // Clean URL
        } else {
            console.error("Login modal element not found.");
        }
    }
});

// script to show modal with the error message if signup fails
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('signup_failed')) {
        const signupModalElement = document.getElementById('SignUp');
        if (signupModalElement) {
            const signupModal = new bootstrap.Modal(signupModalElement);
            signupModal.show();
            history.replaceState({}, document.title, window.location.pathname); // Clean URL
        } else {
            console.error("Signup modal element not found.");
        }
    }
});





</script>
</html>