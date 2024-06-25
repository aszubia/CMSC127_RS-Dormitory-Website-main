<?php
// connect to MySQL server
$host = "localhost";
$username = "root";
$password = "";
$database = "dormdb";
$conn = mysqli_connect($host, $username, $password, $database);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
?>

<!DOCTYPE html>
<html>
<script src="javascript.js" type="text/javascript"></script>

<head>
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

    <title>Students</title>

</head>

<body class="bg-light">


    <?php require('header.php'); ?>

    <div class="container-fluid " id="main-content">
        <div class="row ">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">STUDENT DATA INPUT FORM</h2>

                <div class="row">
                    <div class="col-md-7">
                        <form method="post" class="d-flex">
                            <input type="text" placeholder="Search students" name="search-1" class="form-control shadow-none  me-lg-3 me-2">
                            <button name="submit-1" class="btn btn-primary ml-auto  me-lg-3 me-2 w-50"> Search </button>
                            <button type="submit" name="show_all" class="btn btn-secondary w-50">Show All</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-10 ms-auto p-3 table-container">
                <table class="table table-striped table-sm" style="max-width: 100%;">
                    <?php   //show all data button
                    if (isset($_POST['show_all'])) {
                        // retrieve all rows of data from table
                        $sql = "SELECT sd.student_id, sd.first_name, sd.last_name, sd.sex, sd.birth_date, sd.age, sd.contact_number, sd.email_address, sd.home_address, sd.password, rd.room_name, dd.dorm_address, sl.last_login, sl.total_logins FROM `student_data` AS sd
                                LEFT JOIN `student_dorm_data` AS sdd ON `sd`.`student_id` = `sdd`.`student_id`
                                LEFT JOIN `student_log_data` AS sl ON `sd`.`student_id` = `sl`.`student_id`
                                LEFT JOIN `room_data` AS rd ON sdd.room_id = rd.room_id
                                LEFT JOIN `dorm_data` AS dd ON sdd.dorm_id = dd.dorm_id";

                        // check if query was successful
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo '<thead>
                                        <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Sex</th>
                                        <th>Birth Date</th>
                                        <th>Age</th>
                                        <th>Contact Number</th>
                                        <th>Email Address</th>
                                        <th>Home Address</th>
                                        <th>Room Name</th>
                                        <th>Dorm Address</th>
                                        <th>Last Login</th>
                                        <th>Total Logins</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                        </tr>
                                        </thead>
                                        ';
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tbody>
                                        <tr>
                                        <td> ' . $row['first_name'] . '</td>
                                        <td> ' . $row['last_name'] . '</td>
                                        <td> ' . $row['sex'] . '</td>
                                        <td> ' . $row['birth_date'] . '</td>
                                        <td> ' . $row['age'] . '</td>
                                        <td> ' . $row['contact_number'] . '</td>
                                        <td> ' . $row['email_address'] . '</td>
                                        <td> ' . $row['home_address'] . '</td>
                                        <td> ' . $row['room_name'] . '</td>
                                        <td> ' . $row['dorm_address'] . '</td>
                                        <td> ' . $row['last_login'] . '</td>
                                        <td> ' . $row['total_logins'] . '</td>

                                        <td>
                                            <form method="GET">
                                                <input type="hidden" name="student_id" value="' . $row['student_id'] . '">
                                                <button type="submit" name="delete_student" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>

                                        <td>
                                            <form method="GET">
                                                <input type="hidden" name="student_id" value="' . $row['student_id'] . '">
                                                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                                            </form>
                                        </td>
                                        </tr>
                                        </tbody>';
                            }
                        }
                    }
                    require('deleteStudent.php');

                    if (isset($_GET['edit'])) {
                        // store the value of the student_id in a variable
                        $student_id = $_GET['student_id'];
                        // redirect the user to the editStudent.php file and pass the student_id as a GET parameter
                        header("Location: editStudent.php?student_id=$student_id");
                        exit;
                    }



                    ?>

                </table>

                <table class="table table-striped table-sm">

                    <?php
                    //searching for specific data
                    try {

                        if (isset($_POST['submit-1'])) {
                            $search = $_POST['search-1'];

                            $sql1 = "SELECT sd.student_id, sd.first_name, sd.last_name, sd.sex, sd.birth_date, sd.age, sd.contact_number, sd.email_address, sd.home_address, sd.password, rd.room_name, dd.dorm_address, sl.last_login, sl.total_logins FROM `student_data` AS sd
                                LEFT JOIN `student_dorm_data` AS sdd ON `sd`.`student_id` = `sdd`.`student_id`
                                LEFT JOIN `student_log_data` AS sl ON `sd`.`student_id` = `sl`.`student_id`
                                LEFT JOIN `room_data` AS rd ON sdd.room_id = rd.room_id
                                LEFT JOIN `dorm_data` AS dd ON sdd.dorm_id = dd.dorm_id
                                WHERE `sd`.`first_name` LIKE '%$search%'
                                OR `sd`.`last_name` LIKE '%$search%'
                                OR `sd`.`sex` LIKE '%$search%'
                                OR `sd`.`birth_date` LIKE '$search'
                                OR `sd`.`age` LIKE '$search'
                                OR `sd`.`contact_number` LIKE '$search'
                                OR `sd`.`email_address` LIKE '$search'
                                OR `sd`.`home_address` LIKE '%$search%'";

                            $result1 = mysqli_query($conn, $sql1);

                            if ($result1) {
                                if (mysqli_num_rows($result1) > 0) {
                                    echo '<thead>
                            <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Sex</th>
                            <th>Birth Date</th>
                            <th>Age</th>
                            <th>Contact Number</th>
                            <th>Email Address</th>
                            <th>Home Address</th>
                            <th>Room Name</th>
                            <th>Dorm Address</th>
                            <th>Last Login</th>
                            <th>Total Logins</th>
                            <th>Delete</th>
                            <th>Edit</th>
                            </tr>
                            </thead>
                            ';
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo '<tbody>
                            <tr>
                            <td> ' . $row['first_name'] . '</td>
                            <td> ' . $row['last_name'] . '</td>
                            <td> ' . $row['sex'] . '</td>
                            <td> ' . $row['birth_date'] . '</td>
                            <td> ' . $row['age'] . '</td>
                            <td> ' . $row['contact_number'] . '</td>
                            <td> ' . $row['email_address'] . '</td>
                            <td> ' . $row['home_address'] . '</td>
                            <td> ' . $row['room_name'] . '</td>
                            <td> ' . $row['dorm_address'] . '</td>
                            <td> ' . $row['last_login'] . '</td>
                            <td> ' . $row['total_logins'] . '</td>

                            <td>
                                        <form method="GET">
                                            <input type="hidden" name="student_id" value="' . $row['student_id'] . '">
                                            <button type="submit" name="delete_student" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                    <td>
                                        <form method="GET" action="editStudent.php">
                                            <input type="hidden" name="student_id" value="' . $row['student_id'] . '">
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

                        require('deleteStudent.php');

                        if (isset($_GET['edit'])) {
                            // store the value of the student_id in a variable
                            $student_id = $_GET['student_id'];
                            // redirect the user to the editStudent.php file and pass the student_id as a GET parameter
                            header("Location: editStudent.php?student_id=$student_id");
                            exit;
                        }
                    } catch (Exception $e) {

                        // Handle the exception
                        echo '<h2>Data not found</h2>' . $e->getMessage();
                    }

                    mysqli_close($conn);

                    ?>
                </table>
            </div>
        </div>
    </div>

    <?php require('../admin/inc/scripts.php'); ?>



</body>

</html>