<?php
require('inc/essentials.php');
require('inc/db_config.php');

adminLogin();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        .custom-bg {
            background-color: var(--teal);
            border: 1px solid var(--teal);
        }

        .custom-bg:hover {
            background-color: var(--teal-hover);
            border-color: var(--teal-hover);
        }
    </style>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">DASHBOARD</h2>
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                    <img src="images/student.png" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="text-center mb-4">STUDENTS</h3>
                                        <?php
                                        $count_query =  mysqli_query($conn, "SELECT count(*) AS total FROM student_data");
                                        $row_count = mysqli_fetch_assoc($count_query);
                                        $count = $row_count['total'];
                                        ?>
                                        <h4 class="text-center mb-4">Total: <?php echo (string)$count; ?></h5>
                                            <div class="d-flex justify-content-evenly mb-1">
                                                <a href="../function/searchStudent.php" class="btn btn-s text-white custom-bg shadow-none">More Details</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                    <img src="images/room.png" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="text-center mb-4">ROOMS</h3>
                                        <?php
                                        $count_query1 =  mysqli_query($conn, "SELECT count(*) AS total1 FROM room_data");
                                        $row_count1 = mysqli_fetch_assoc($count_query1);
                                        $count1 = $row_count1['total1'];
                                        ?>
                                        <h4 class="text-center mb-4">Total: <?php echo (string)$count1; ?></h5>
                                            <div class="d-flex justify-content-evenly mb-1">
                                                <a href="../function/searchRoom.php" class="btn btn-s text-white custom-bg shadow-none">More Details</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                    <img src="images/log.png" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="text-center mb-4">LOGS</h3>
                                        <?php
                                        $count_query2 =  mysqli_query($conn, "SELECT count(*) AS total2 FROM log_data");
                                        $row_count2 = mysqli_fetch_assoc($count_query2);
                                        $count2 = $row_count2['total2'];
                                        ?>
                                        <h4 class="text-center mb-4">Total: <?php echo (string)$count2; ?></h5>
                                            <div class="d-flex justify-content-evenly mb-1">
                                                <a href="../function/searchLog.php" class="btn btn-s text-white custom-bg shadow-none">More Details</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                                    <img src="images/payment.png" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="text-center mb-4">PAYMENTS</h3>
                                        <?php
                                        $count_query3 =  mysqli_query($conn, "SELECT count(*) AS total3 FROM payment_data");
                                        $row_count3 = mysqli_fetch_assoc($count_query3);
                                        $count3 = $row_count3['total3'];
                                        ?>
                                        <h4 class="text-center mb-4">Total: <?php echo (string)$count3; ?></h5>
                                            <div class="d-flex justify-content-evenly mb-1">
                                                <a href="../function/searchPay.php" class="btn btn-s text-white custom-bg shadow-none">More Details</a>
                                            </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php require('inc/scripts.php'); ?>
</body>

</html>