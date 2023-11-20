<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/home-page.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="homepage_login.php"><i class="fa-solid fa-house"></i>
                            Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-people-group"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-calendar-plus"></i> Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-star"></i> Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-file-contract"></i> Contact</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-circle-user"></i> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- content -->
    <div class="container-fluid">
        <div class="title mt-5 text-center">
            About Us!
        </div>
        <div class="slider mt-4">
            <div class="list">
                <div class="item">
                    <img src="img/1.jpg" alt="">
                </div>
                <div class="item">
                    <img src="img/2.jpg" alt="">
                </div>
                <div class="item">
                    <img src="img/3.jpg" alt="">
                </div>
                <div class="item">
                    <img src="img/4.jpg" alt="">
                </div>
                <div class="item">
                    <img src="img/5.jpg" alt="">
                </div>
            </div>
            <div class="buttons">
                <button id="prev">
                    < </button>
                        <button id="next">></button>
            </div>
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <div class="row d-flex justify-content-center mt-4 mb-4">
            <div class="col-auto d-flex justify-content-center align-items-center mt-4">
                <div>
                    <div class="col-lg-4 col-md-12 mb-4 img-btn"><img class="img" src="img/1.jpg" alt=""></div>
                    <div class="col-lg-4 col-md-12 mb-3 text-center text-place ">Siam Paragon</div>
                    <div class="col-lg-4 col-md-12 mb-5 d-flex justify-content-center" style="width: 100%;">
                        <button class="view-btn ">view</button>
                    </div>
                </div>
            </div>
            <div class="col-auto d-flex justify-content-center align-items-center mt-4">
                <div>
                    <div class="col-lg-4 col-md-12 mb-4 img-btn"><img class="img" src="img/1.jpg" alt=""></div>
                    <div class="col-lg-4 col-md-12 mb-3 text-center text-place ">Siam Paragon</div>
                    <div class="col-lg-4 col-md-12 mb-5 d-flex justify-content-center" style="width: 100%;">
                        <button class="view-btn ">view</button>
                    </div>
                </div>
            </div>
            <div class="col-auto d-flex justify-content-center align-items-center mt-4">
                <div>
                    <div class="col-lg-4 col-md-12 mb-4 img-btn"><img class="img" src="img/1.jpg" alt=""></div>
                    <div class="col-lg-4 col-md-12 mb-3 text-center text-place ">Siam Paragon</div>
                    <div class="col-lg-4 col-md-12 mb-5 d-flex justify-content-center" style="width: 100%;">
                        <button class="view-btn ">view</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="location-content mb-5 pb-5">
            <div class="text-location mb-3">
                Your Location
            </div>
            <div class="location-box">
                <img src="img/map.png" style="width: 100%; border-radius: 10px;">
            </div>
        </div>

        <script src="js/homepage.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</body>

</html>