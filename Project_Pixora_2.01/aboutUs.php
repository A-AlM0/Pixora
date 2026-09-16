<?php
session_start();

$base_url = "http://localhost/PROJECT_PIXORA_1.01/";

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
    <div class="container-fluid text-white">

        <div class="row">
            <div class="col-12 col-lg-6 col-md-12 p-5 aboutUs-bg align-items-center justify-content-center d-flex border">
                <img class="img-fluid rounded" src="images/abth.png" alt="">
            </div>
            <div class="col-12 col-lg-6 col-md-12 p-5 aboutUs-bg align-items-center justify-content-center d-flex border">
                <div class="row text-center border-bottom">
                    <div class="col-12"><h1 class="fw-bold display-1 text-center text-dark">Westsiders</h1></div>
                    <div class="col-12"><p class="lead  text-center text-dark">We are a small team of 4 members who developed a project, social app to share your good memories</p></div>
                    
            <div class="col-12"><p class="lead text-dark border-bottom">Developers</p></div>
                    <div class="col-12"><p class="lead text-dark">Mohammed Ghazi</p></div>
                    <div class="col-12"><p class="lead text-dark">Abdulrahman Alasmari</p></div>
                    <div class="col-12"><p class="lead text-dark">Abdulrahman Barnawi</p></div>
                    <div class="col-12"><p class="lead text-dark">Ali Almalki</p></div>

                    <div class="col bouts m-3"disable>
                    <img class="img-fluid mx-2" src="images/Sample_User_Icon.png" alt="">
                    <img class="img-fluid mx-2" src="images/Sample_User_Icon.png" alt="">
                    <img class="img-fluid mx-2" src="images/Sample_User_Icon.png" alt="">
                    <img class="img-fluid mx-2" src="images/Sample_User_Icon.png" alt="">

                </div>
            </div>
                </div>
                <div class="col mb-5">
                    <p></p>
                </div>
            </div>


    </div>
    <!--Hero end-->
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


</script></body>

</html>