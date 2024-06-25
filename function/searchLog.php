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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="javascript.js" type="text/javascript"></script>

    <?php require('../admin/inc/links.php'); ?>

    <title>Logs</title>
</head>

<body class="bg-light">

    <?php require('header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">LOG DATA INPUT FORM</h2>

                <div class="row">
                    <div class="col-md-7">
                        <form method="post" class="d-flex">
                            <input type="text" placeholder="Search logs" name="search-3" class="form-control shadow-none  me-lg-3 me-2">
                            <button name="submit-3" class="btn btn-primary ml-auto  me-lg-3 me-2 w-50"> Search </button>
                            <button type="submit" name="show_all" class="btn btn-secondary w-50">Show All</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-10 ms-auto p-4 overflow-hidden">

        <table class="table table-striped">
            <?php                                           //show all data button
            if (isset($_POST['show_all'])) {                // retrieve all rows of data from table                                        
                $sql = "SELECT DISTINCT *
                    FROM `log_data` AS ld
                    JOIN `student_data` AS sd ON `ld`.`student_id` = `sd`.`student_id`";

                $result = mysqli_query($conn, $sql);        // check if query was successful
                if (mysqli_num_rows($result) > 0) {
                    echo '<thead>
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Log Status</th>
            <th>Time</th>
            <th>Delete</th>
            </tr>
            </thead>
            ';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tbody>
            <tr>
            <td> ' . $row['first_name'] . '</td>
            <td> ' . $row['last_name'] . '</td>
            <td> ' . $row['log_status'] . '</td>
            <td> ' . $row['time'] . '</td>
            <td>
                <form method="post">
                    <input type="hidden" name="log_id" value="' . $row['log_id'] . '">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            </tbody>';
                    }
                }
            }

            require('deleteLog.php');

            ?>
        </table>


        <table class="table table-striped">
            <?php
            try {

                if (isset($_POST['submit-3'])) {
                    $search = $_POST['search-3'];

                    $sql3 = "SELECT DISTINCT *
                FROM `log_data` AS ld
                JOIN `student_data` AS sd ON `ld`.`student_id` = `sd`.`student_id`
                WHERE `ld`.`log_id` LIKE '$search'
                OR `sd`.`first_name` LIKE '%$search%'
                OR `sd`.`last_name` LIKE '%$search%'
                OR `ld`.`log_status` LIKE '$search'";

                    $result3 = mysqli_query($conn, $sql3);

                    if ($result3) {
                        if (mysqli_num_rows($result3) > 0) {
                            echo '<thead>
                <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Log Status</th>
                <th>Time</th>
                <th>Delete</th>
                </tr>
                </thead>';
                            while ($row = mysqli_fetch_assoc($result3)) {
                                echo '<tbody>
                <tr>
                <td> ' . $row['first_name'] . '</td>
                <td> ' . $row['last_name'] . '</td>
                <td> ' . $row['log_status'] . '</td>
                <td> ' . $row['time'] . '</td>
                <td>
                <form method="post">
                    <input type="hidden" name="log_id" value="' . $row['log_id'] . '">
                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                </form>
                </td>
                </tr>
                </tbody>';
                            }
                        }
                    }
                }

                require('deleteLog.php');
            } catch (Exception $e) {
                echo '<h2>Data bro not found</h2>' . $e->getMessage(); // handle the exception  
            }

            mysqli_close($conn);

            ?>
        </table>
    </div>
    <?php require('../admin/inc/scripts.php'); ?>

</body>

</html>