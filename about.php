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

    <title>About</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">What is RS Dormitory?</h3>
                <p>
                    RS Dormitory is a platform that allows students to rent out their
                    dorm rooms or apartments to other students, typically on a short-term
                    basis. The website serves as a middleman between the student renters
                    and the student hosts, facilitating the booking process and handling
                    payment transactions.<br><br>
                    The website may allow students to search for available rooms or
                    apartments based on location, price, and other desired amenities.
                    Hosts can list their rooms or apartments, setting their own rental
                    rates and availability. Guests can then browse through the listings
                    and book a room that meets their needs.
                </p>
            </div>
            <div class="col-lg-5 col-mb-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about.png" class="w-100">
            </div>
        </div>
    </div>

    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>

    <div class="container px-4">
        <div class="row ">
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="bg-white text-center overflow-hidden rounded">
                    <img src="images/about/1.png" class="w-100">
                    <h5 class="mt-2">Deangelo Enriquez</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="bg-white text-center overflow-hidden rounded">
                    <img src="images/about/2.png" class="w-100">
                    <h5 class="mt-2">Marwin Matic</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="bg-white text-center overflow-hidden rounded">
                    <img src="images/about/3.png" class="w-100">
                    <h5 class="mt-2">Achilles Joaquin Zubia</h5>
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