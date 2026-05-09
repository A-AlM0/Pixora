<?php
session_start();

$base_url = "http://localhost/PROJECT_PIXORA_2.01/";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
    <div class="container text-white">
        <div class="row justify-content-center align-items-center gx-4 gy-4 m-3">
            <!-- Text Section -->
            <div class="col-12 col-md-4 text-dark text-center text-md-start">
                <div class="p-0 my-3">
                    <h1 class="display-1 fw-bold">Pixora</h1>
                    <h4 class="mt-3">
                        Unleash Your Creativity, One Pixel at a Time!
                    </h4>

                    <a href="explore.php"><button type="button" class="btn prpl fw-semibold text-white">Dive in</button></a>

                </div>
            </div>

            <!--Carousel Image Section -->
            <div class="col-12 col-md-8">
                <div class=" position-relative overflow-hidden rounded">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="images/1.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="images/neom-x-F7S_lqN2U-unsplash.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="images/p2.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Hero end-->

    

    <!--Sub Hero start-->
    <div class="main_content">
        <div class="container-fluid">
            <div class="row">
                <!--All the sub content in this col-->
                <div class="col sub_hero">
                    <div class="text_sub">
                        <p class="text-center text-white my-3">Explore Pixora—a platform for creatives to share,
                            discover, and be
                            inspired. Connect with a community of artists, photographers, and visual storytellers. Join
                            us and showcase your unique perspective!</p>
                    </div>

                    <div class="row justify-content-center mb-5">
                        <div class="shadow col-lg-3 col-md-12 col-sm-12 p-5 m-1 sub_card_info hidden">
                            <h4 class="fw-bold shadow">Bring Your Vision to Life!</h4>
                            <p class="fs-5">Share your photos, discover inspiring visuals, and join a community
                                that celebrates
                                creativity. Explore, create, and connect on Pixora.</p>
                        </div>
                        <div class="shadow col-lg-3 col-md-12 col-sm-12 p-5 m-1 sub_card_info hidden">
                            <h4 class="fw-bold shadow">Capture. Share. Inspire.</h4>
                            <p class="fs-5">Pixora is the place to bring your ideas to life. Share your photos, explore
                                new
                                perspectives, and fuel your creative journey alongside like-minded artists.</p>
                        </div>
                        <div class="shadow col-lg-3 col-md-12 col-sm-12 p-5 m-1 sub_card_info hidden">
                            <h4 class="fw-bold shadow">Discover Art in Every Pixel!</h4>
                            <p class="fs-5">Dive into Pixora, a vibrant space for image sharing and inspiration. Show
                                your style,
                                explore unique visuals, and connect with a community that celebrates creativity.</p>
                        </div>
                    </div>



                    <div class="row justify-content-center">
                        <div class="shadow col-lg-4 col-md-12 col-sm-12 p-0 m-5 bg-white sub_card_img_col hidden2">
                            <img class="img-fluid" src="images/or.png" alt="">
                        </div>
                        <div class="shadow col-lg-4 col-md-12 col-sm-12 p-5 m-5 text-white box1-sub">
                            <h2 class="fw-bold shadow">Westsiders.</h2>
                            <p class="text_sub_2 fs-5">We are a passionate team building a unique platform for image
                                sharing.
                                Our goal is to
                                create a space where users can explore, discover, and share captivating visuals from
                                diverse perspectives. We’re committed to developing a seamless experience that fosters
                                creativity, connects communities, and inspires everyone to see the world through a new
                                lens.</p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="shadow col-lg-4 col-md-12 col-sm-12 p-5 m-5 text-white box2-sub">
                            <h2 class="fw-bold shadow">Pixora.</h2>
                            <p class="text_sub_2 fs-5">We are a passionate team building a unique platform for image
                                sharing.
                                Our goal is to
                                create a space where users can explore, discover, and share captivating visuals from
                                diverse perspectives. We’re committed to developing a seamless experience that fosters
                                creativity, connects communities, and inspires everyone to see the world through a new
                                lens.</p>
                        </div>
                        <div class="shadow col-lg-4 col-md-12 col-sm-12 p-0 m-5 sub_card_img_col hidden3">
                            <img class="img-fluid" src="images/gabriele.jpg" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>


                <!--Footer start-->
                <div class="container-fluid mt-3">
                    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
                        <p class="col-md-4 mb-0 text-muted">&copy; 2024 YUC, Westsiders</p>



                        <ul class="nav col-md-4 justify-content-c">
                            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
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
    <!--Sub Hero end-->

    <script src="js/boxes_anim.js"></script>
  
    
    <script>

        
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



</body>

</html>