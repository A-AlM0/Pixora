<?php
session_start();

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="manifest" href="/PROJECT_PIXORA_2.01/manifest.json">
        <meta name="theme-color" content="#007bff">
        
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <script defer src="js/main.js"></script>


</head>

<body>


    <!--Navbar start-->
    <div class="container">
        <nav class="navbar navbar-expand-lg fs-6 fw-semibold">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="main.html">
                <img src="images/pixora_logo.png" alt="Logo" width="150" height="150"
                    class="d-inline-block align-text-top">
            </a>
            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="main.html">Home</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="explore.html">Explore</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item mx-4">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                </ul>
                <li class="nav-item d-flex">
                    <a class="btn btn-outline-dark fw-semibold mx-2 rounded-4 border-0 border-lg" href="signUp.html"
                        role="button">
                        Sign-Up
                    </a>
                </li>
            </div>
        </nav>
    </div>
    <!--Navbar end-->

    <!--Hero start-->
    <div class="container justify-content-center align-items-center d-flex">
    <div class="row form_row rounded-5 border shadow bg-white p-5">
        <div class="col-md-6 left-box">
        <form action="upload_post.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="description" required>
    </div>
    <div class="mb-3">
        <input type="file" name="post_image" class="form-control mb-3" id="select_file" accept="image/*" required>
    </div>
    <button type="submit" class="btn px-5 btn-primary">Upload</button>
</form>        </div>
    </div>
</div>

    <!--Hero end-->


</body>

</html>