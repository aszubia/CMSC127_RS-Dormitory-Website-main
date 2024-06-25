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

session_start()

?>


<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>RS Dormitory</title>
    <?php require ('../inc/links.php'); ?>
    <link rel="stylesheet" href="../css/common.css">

    <style>
       .availability-form{
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }
    </style>

</head>

<body class="bg-light">

    <?php require ('header_student.php'); ?>

    <!-- Carousel -->
    <div class="container-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <img src="../images/carousel/Slide1.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                <img src="../images/carousel/Slide2.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                <img src="../images/carousel/Slide3.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                <img src="../images/carousel/Slide4.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                <img src="../images/carousel/Slide5.png" class="w-100 d-block">
                </div>
                <div class="swiper-slide">
                <img src="../images/carousel/Slide6.png" class="w-100 d-block">
                </div>
            </div>

        </div>

    </div>

    <!-- Featured DORMS -->

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">FEATURED DORMS</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="../images/rooms/1.png" class="card-img-top">
                    <div class="card-body">
                        <h5>Ina Mansion Condominium</h5>
                        <p class="card-text mb-4">28 Kisad Rd, Baguio, Benguet</p>
                        <h6 class="mb-3">₱4500/month</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Number of rooms: 50</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Current student population: 40</span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Reserve Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="../images/rooms/1.png" class="card-img-top">
                    <div class="card-body">
                        <h5>Ina Mansion Condominium</h5>
                        <p class="card-text mb-4">28 Kisad Rd, Baguio, Benguet</p>
                        <h6 class="mb-3">₱4500/month</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Number of rooms: 50</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Current student population: 40</span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Reserve Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="../images/rooms/1.png" class="card-img-top">
                    <div class="card-body">
                        <h5>Ina Mansion Condominium</h5>
                        <p class="card-text mb-4">28 Kisad Rd, Baguio, Benguet</p>
                        <h6 class="mb-3">₱4500/month</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Number of rooms: 50</span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">Current student population: 40</span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Reserve Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-5">
                <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Dorms >>></a>

            </div>
        </div>
    </div>


    <?php require ('../inc/footer.php'); ?>


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
