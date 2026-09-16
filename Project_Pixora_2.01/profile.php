<?php
require_once 'Users.php';
require_once 'Profiles.php';
require_once 'Posts.php';

session_start();

// Initialize Classes
$users = new Users();
$profiles = new Profiles();
$posts = new Posts();

// PHP code to fetch user profile
if (isset($_GET['username'])) {
    $username = htmlspecialchars(trim($_GET['username']));
    $user = $profiles->getUserByUsername($username);  // Fetch user data

    if ($user) {
        // Fetch user posts
        $userPosts = $posts->getPostsByUserId($user['user_id']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css?v=5.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="manifest" href="manifest.json">
        <meta name="theme-color" content="#007bff">
        
    <script defer src="js/app.js"></script>
    <script defer src="js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!--Upload Post-->
    <div class="modal fade" id="UploadPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="upload_post.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="description" required>
                    </div>
                    <div class="mb-3">
                        <input type="file" name="post_image" class="form-control" id="select_file" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <div class="container-fluid mx-4">
        <div class="row sm-upload d-md-none">
            <div class="col justify-content-center align-items-center d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="#UploadPost"><i
                        class="fa-solid fs-4 fa-upload"></i></a>
            </div>
        </div>
    </div>

    <!--Sign Up-->
    <div class="modal fade" id="SignUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">First Name</label>
                            <input class="form-control" id="exampleInputFname" aria-describedby="firstnameHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Last Name</label>
                            <input class="form-control" id="exampleInputLname" aria-describedby="lastnameHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputphoneNumber" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="exampleInputphoneNumber"
                                aria-describedby="phonenumberHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputphoneNumber" class="form-label">Hobbie</label>
                            <input class="form-control" id="exampleInputhobbie" aria-describedby="hobbieHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!--Login-->
    <div class="modal fade" id="LogIn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!--Navbar start-->
    <div class="container d-md-none">
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
            <div class="col-lg-2 col-md-2 d-none d-sm-none d-md-block text-dark p-5 side-nav">
                <div class="row">
                    <div class="col-12 side-nav-container">
                        <nav class="nav flex-column align-items-start d-none d-sm-none d-md-block position-fixed my-5">
                            <a class="nav-link disabled" aria-current="page" href="main.php"><img
                                    class="img-fluid pixora_logo" src="images/logo_pix_small.png" alt="">
                                <p class="d-md-none d-sm-none d-lg-inline-block">Pixora</p>
                            </a>
                            <a class="nav-link active" aria-current="page" href="main.php"> <i
                                    class="mx-2 fa-solid fa-house"></i>
                                <p class="d-md-none d-sm-none d-lg-inline-block">Home</p>
                            </a>
                            <a class="nav-link" href="explore.php"> <i class="mx-2 fa-solid fa-image"></i>
                                <p class="d-md-none d-sm-none d-lg-inline-block">Explore</p>
                            </a>
                            <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['username'])): ?>
                            <a class="nav-link" href="account.php"> <i class="mx-2 fa-solid fa-user"></i>
                                <p class="d-md-none d-sm-none d-lg-inline-block">Account</p>
                            </a>
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#UploadPost"> <i
                                    class="mx-2 fa-solid fa-upload"></i>
                                <p class="d-md-none d-sm-none d-lg-inline-block fs-6">Upload Post</p>
                            </a>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <!-- <div class="col-12 nav-sub-side">
                    <a class="upload-link btn" href="gallery.html">
                        <h6 class="d-md-none d-sm-none d-lg-inline-block upload-css">Upload Pixle</h6>
                    </a>
                </div> -->
                </div>
            </div>

            <div class="col-lg-10 col-md-10 offset-1 p-5">
    <div class="container">
        <div class="row justify-content-center align-items-center d-flex">
            <div class="col-5 col-sm-4 col-lg-3">
                <div class="acc_avatar border mb-5 position-relative">
                    <!-- Profile Picture -->
                    <img class="img-fluid" src="<?= htmlspecialchars($user['avatar'] ?? 'uploads/avatars/acc.png'); ?>" alt="Avatar"
                     id="profilePicture" style="cursor: pointer;">
                </div>
            </div>
            <div class="col-7 col-sm-8 col-lg-9">
                <p class="fs-5"><?= htmlspecialchars($user['username']); ?></p>
            </div>
        </div>
    </div>


               <div class="row text-white text-start g-1 acc_top">

    
                 <?php if (!empty($userPosts)): ?>
                <?php foreach ($userPosts as $post): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mt-1">
                <div class="img_container">
                <a href="post.php?post_id=<?= htmlspecialchars($post['post_id']); ?>" class="text-decoration-none">

                <img class="img-fluid" src="<?= htmlspecialchars($post['image_path']); ?>" alt="Post Image">
                </a>
                    </div>
                 </div>
                  <?php endforeach; ?>
                 <?php else: ?>
                 <p class="text-center text-secondary">No posts to show.</p>
                   <?php endif; ?>
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
    </div>
    <!--Hero end-->

</body>

</html>