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
?>

<!DOCTYPE html>
<html>
<script src="javascript.js" type="text/javascript"></script>

<head>
    <script src="javascript.js" type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('../admin/inc/links.php'); ?>

    <title>Payment</title>
</head>

<body class="bg-light">

    <?php require('header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">PAYMENT DATA INPUT FORM</h2>
                <div class="row">
                    <div class="col-md-8">
                        <form method="post" class="d-flex">
                            <input type="text" placeholder="Search payment" name="search-4" class="form-control shadow-none  me-lg-3 me-2">
                            <button name="submit-4" class="btn btn-primary ml-auto  me-lg-3 me-2 w-50"> Search </button>
                            <button type="submit" name="show_all" class="btn btn-success ml-auto me-lg-3 me-2 w-50">Show All</button>
                            <a href="addPayment.php" class="btn btn-secondary ml-auto me-lg-3 me-2 w-50">Add Payment</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <table class="table table-striped">
                <?php   //show all data button
                if (isset($_POST['show_all'])) {
                    // retrieve all rows of data from table
                    $sql = "SELECT * FROM `payment_data`";

                    // check if query was successful
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<thead>
                    <tr>
                    <th>Payment ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Mode of Payment</th>
                    <th>Delete</th>
                    </tr>
                    </thead>
                    ';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tbody>
                    <tr>
                    <td> ' . $row['pay_id'] . '</td>
                    <td> ' . $row['first_name'] . '</td>
                    <td> ' . $row['last_name'] . '</td>
                    <td> ' . $row['amount'] . '</td>
                    <td> ' . $row['date_paid'] . '</td>
                    <td> ' . $row['modeOfPayment'] . '</td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="pay_id" value="' . $row['pay_id'] . '">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    </tr>
                    </tbody>';
                        }
                    }
                }

                require('deletePay.php');

                ?>
            </table>
            <table class="table table-striped">

                <?php

                try {

                    if (isset($_POST['submit-4'])) {
                        $search = $_POST['search-4'];

                        $sql4 = "SELECT *
                                FROM `payment_data` AS pd
                                WHERE `pd`.`pay_id` LIKE '$search'
                                OR first_name LIKE '%$search%'
                                OR last_name LIKE '%$search%'
                                OR amount LIKE '$search'
                                OR date_paid LIKE '$search'";

                        $result4 = mysqli_query($conn, $sql4);

                        if ($result4) {
                            if (mysqli_num_rows($result4) > 0) {
                                echo '<thead>
                                        <th>Payment ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Amount</th>
                                        <th>Date Paid</th>
                                        <th>Mode of Payment</th>
                                        <th>Delete</th>
                                        </tr>
                                        </thead>
                                        ';
                                while ($row = mysqli_fetch_assoc($result4)) {
                                    echo '<tbody>
                                        <tr>
                                        <td> ' . $row['pay_id'] . '</td>
                                        <td> ' . $row['first_name'] . '</td>
                                        <td> ' . $row['last_name'] . '</td>
                                        <td> ' . $row['amount'] . '</td>
                                        <td> ' . $row['date_paid'] . '</td>
                                        <td> ' . $row['modeOfPayment'] . '</td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="pay_id" value="' . $row['pay_id'] . '">
                                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        </tr>
                                        </tbody>';
                                }
                            }
                        }
                    }

                    require('deletePay.php');
                } catch (Exception $e) {

                    // Handle the exception
                    echo '<h2>Data bro not found</h2>' . $e->getMessage();
                }

                mysqli_close($conn);

                ?>
            </table>
            <?php require('../admin/inc/scripts.php'); ?>


        </div>


    </div>





</body>

</html>