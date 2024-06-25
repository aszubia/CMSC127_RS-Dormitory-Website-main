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


?>


<!DOCTYPE html>
<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('../admin/inc/links.php'); ?>

    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        table {
            max-width: 100%;
        }
    </style>

    <title>Rooms</title>
</head>

<body class="bg-light">

    <?php require('header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">ROOM DATA INPUT FORM</h2>

                <div class="row ">
                    <div class="col-md-7">
                        <form method="POST" class="d-flex">
                            <input type="text" placeholder="Search rooms" name="search-2" class="form-control shadow-none  me-lg-3 me-2">
                            <button name="submit-2" class="btn btn-primary ml-auto  me-lg-3 me-2 w-50"> Search </button>
                            <button type="submit" name="show_all" class="btn btn-success ml-auto me-lg-3 me-2 w-50">Show All</button>
                            <a href="addRooms.php" class="btn btn-secondary ml-auto me-lg-3 me-2 w-50">Add Room</a>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-10 ms-auto p-3 table-container">
                <table class="table table-striped" style="max-width:100%">
                    <?php   //show all data button
                    if (isset($_POST['show_all'])) {
                        // retrieve all rows of data from table
                        $sql = "SELECT `rd`.`room_id`, `rd`.`room_name`, `rd`.`available_beds`,
                            `rd`.`price`, `rd`.`status`, `rd`.`room_occupants`, `dd`.`dorm_id`,
                            `dd`.`dorm_address`, `dd`.`dorm_name`
                            FROM `room_data` AS rd
                            LEFT OUTER JOIN `dorm_data` AS dd ON `rd`.`dorm_id` = `dd`.`dorm_id`";


                        // check if query was successful
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo '<thead>
                    <tr>
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Price</th>
                    <th>Available Beds</th>
                    <th>Room Occupants</th>
                    <th>Dorm Address</th>
                    <th>Dorm Name</th>
                    <th>Status</th>
                    <th>Delete</th>
                    <th>Edit</th>
                    </tr>
                    </thead>
                    ';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tbody>
                    <tr>
                    <td> ' . $row['room_id'] . '</td>
                    <td> ' . $row['room_name'] . '</td>
                    <td> ' . $row['price'] . '</td>
                    <td> ' . $row['available_beds'] . '</td>
                    <td> ' . $row['room_occupants'] . '</td>
                    <td> ' . $row['dorm_address'] . '</td>
                    <td> ' . $row['dorm_name'] . '</td>
                    <td> ' . $row['status'] . '</td>
                    <td>
                    <form method="post">
                        <input type="hidden" name="room_id" value="' . $row['room_id'] . '">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                    </td>

                    <td>
                        <form method="GET">
                            <input type="hidden" name="room_id" value="' . $row['room_id'] . '">
                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                            </form>
                    </td>
                    </tr>
                    </tbody>';
                            }
                        }
                    }

                    require('deleteRoom.php');

                    if (isset($_GET['edit'])) {
                        // store the value of the room_id in a variable
                        $room_id = $_GET['room_id'];
                        // redirect the user to the editRoom.php file and pass the room_id as a GET parameter
                        header("Location: editRoom.php");
                    }


                    ?>

                    <table class="table table-striped" style="width:100%">

                        <?php

                            if (isset($_POST['submit-2'])) {
                                $search = $_POST['search-2'];

                                $sql2 = "SELECT `rd`.`room_id`, `rd`.`room_name`, `rd`.`available_beds`,
                                        `rd`.`price`, `rd`.`status`, `rd`.`room_occupants`, `dd`.`dorm_id`,
                                        `dd`.`dorm_address`, `dd`.`dorm_name`
                                        FROM `room_data` AS rd
                                        LEFT OUTER JOIN `dorm_data` AS dd ON `rd`.`dorm_id` = `dd`.`dorm_id`
                                            WHERE `rd`.`room_id` LIKE '%$search%'
                                            OR `rd`.`room_name` LIKE '%$search%'
                                            OR `rd`.`status` LIKE '%$search%'";


$sql = "SELECT `rd`.`room_id`, `rd`.`room_name`, `rd`.`available_beds`,
                            `rd`.`price`, `rd`.`status`, `rd`.`room_occupants`, `dd`.`dorm_id`,
                            `dd`.`dorm_address`, `dd`.`dorm_name`
                            FROM `room_data` AS rd
                            LEFT OUTER JOIN `dorm_data` AS dd ON `rd`.`dorm_id` = `dd`.`dorm_id`";




                                $result2 = mysqli_query($conn, $sql2);

                                if ($result2) {
                                    if (mysqli_num_rows($result2) > 0) {
                                        echo '<thead>
                                                <tr>
                                                <th>Room ID</th>
                                                <th>Room Name</th>
                                                <th>Price</th>
                                                <th>Available Beds</th>
                                                <th>Room Occupants</th>
                                                <th>Dorm ID</th>
                                                <th>Status</th>
                                                <th>Delete</th>
                                                <th>Edit</th>
                                                </tr>
                                                </thead>
                                                ';
                                        while ($row = mysqli_fetch_assoc($result2)) {
                                            echo '<tbody>
                                                        <tr>
                                                        <td> ' . $row['room_id'] . '</td>
                                                        <td> ' . $row['room_name'] . '</td>
                                                        <td> ' . $row['price'] . '</td>
                                                        <td> ' . $row['available_beds'] . '</td>
                                                        <td> ' . $row['room_occupants'] . '</td>
                                                        <td> ' . $row['dorm_id'] . '</td>
                                                        <td> ' . $row['status'] . '</td>
                                                        <td>
                                                        <form method="post">
                                                            <input type="hidden" name="room_id" value="' . $row['room_id'] . '">
                                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        </td>

                                                        <td>
                                                        <form method="GET">
                                                            <input type="hidden" name="room_id" value="' . $row['room_id'] . '">
                                                            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                                        </form>
                                                        </td>

                                                        </tr>
                                                        </tbody>

                                                        ';
                                        }
                                    }
                                }
                            }

                            require('deleteRoom.php');

                            if (isset($_GET['edit'])) {
                                // store the value of the room_id in a variable
                                $room_id = $_GET['room_id'];
                                // redirect the user to the editRoom.php file and pass the room_id as a GET parameter
                                header("Location: editRoom.php?room_id=$room_id");
                                exit;
                            }

                        mysqli_close($conn);

                        ?>
                    </table>
            </div>
        </div>
    </div>




    <?php require('../admin/inc/scripts.php'); ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>




</body>

</html>