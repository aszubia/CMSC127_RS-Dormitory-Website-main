<?php
// Connect to MySQL server
$host = "localhost";
$username = "root";
$password = "";
$database = "dormdb";
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
session_start();

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RS Dormitory</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">

    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
    </style>

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <!-- Carousel -->
    <div class="container-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="images/carousel/Slide1.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/Slide2.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/Slide3.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/Slide4.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/Slide5.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                    <img src="images/carousel/Slide6.png" class="w-100 d-block">
                </div>
            </div>

        </div>

    </div>

    <!-- Featured DORMS -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR DORMS</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/2.png" class="card-img-top">
                    <div class="card-body">
                        <h4>RS Dormitory Manila</h5>
                            <p class="card-text mb-4"><small> Tondo, Manila, Metro Manila </small></p>
                            <div class="d-flex justify-content-evenly">
                                <a href="dorms1.php" class="btn btn-sm text-white custom-bg shadow-none">See Room</a>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.png" class="card-img-top">
                    <div class="card-body">
                        <h4>RS Dormitory Baguio</h4>
                        <p class="card-text mb-4"><small> Trio Haunted House, Baguio, Benguet </small></p>
                        <div class="d-flex justify-content-evenly">
                            <a href="dorms2.php" class="btn btn-sm text-white custom-bg shadow-none">See Room</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/3.png" class="card-img-top">
                    <div class="card-body">
                        <h4>RS Dormitory Quezon City</h5>
                            <p class="card-text mb-4"><small> Novaliches, Quezon City </small></p>
                            <div class="d-flex justify-content-evenly">
                                <a href="dorms3.php" class="btn btn-sm text-white custom-bg shadow-none">See Rooms</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require('inc/footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        });
    </script>

</body>

</html>