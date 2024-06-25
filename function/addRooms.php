<?php
// Connect to MySQL server
$host = "localhost";
$username = "root";
$password = "";
$database = "dormdb";
$connect = mysqli_connect($host, $username, $password, $database);

require('../admin/inc/links.php');
require('../admin/inc/essentials.php');

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <script src="javascript.js" type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Rooms</title>
</head>

<body>

    <?php require('header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">ADD ROOM</h2>
                <div class="row">
                    <div class="col-md-7">
                        <?php
                        // If upload button is clicked ...
                        if (isset($_POST['upload']) && isset($_FILES['uploadfile'])) {

                            $filename = $_FILES["uploadfile"]["name"];
                            $tempname = $_FILES["uploadfile"]["tmp_name"];

                            $img_name = $_FILES['uploadfile']['name'];
                            $img_size = $_FILES['uploadfile']['size'];
                            $tmp_name = $_FILES['uploadfile']['tmp_name'];
                            $error = $_FILES['uploadfile']['error'];

                            $room_name = mysqli_real_escape_string($connect, $_POST['room_name']);
                            $price = mysqli_real_escape_string($connect, $_POST['price']);
                            $available_beds = mysqli_real_escape_string($connect, $_POST['available_beds']);
                            $room_occupants = mysqli_real_escape_string($connect, $_POST['room_occupants']);

                            //filter dorm name
                            $dorm_name = filter_input(INPUT_POST, 'dorm_name');

                            $dorm_sql = "SELECT * FROM dorm_data WHERE dorm_name = '$dorm_name'";
                            //string $dorm_sql
                            $dorm_result = mysqli_query($connect, $dorm_sql);
                            $dorm_row = mysqli_fetch_assoc($dorm_result);
                            $dorm_id = $dorm_row['dorm_id'];

                            $description = mysqli_real_escape_string($connect, $_POST['description']);
                            $status = mysqli_real_escape_string($connect, $_POST['status']);

                            //image upload
                            if ($error === 0) {
                                if ($img_size > 10485760) {
                                    alert('error', 'Sorry, your file is too large.');
                                } else {
                                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                                    $img_ex_lc = strtolower($img_ex);

                                    $allowed_exs = array("jpg", "jpeg", "png");

                                    if (in_array($img_ex_lc, $allowed_exs)) {
                                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                                        $img_upload_path = '../images/rooms/' . $new_img_name;
                                        move_uploaded_file($tmp_name, $img_upload_path);

                                        // Insert into Database
                                        $sql = "INSERT INTO room_data(room_name, price, available_beds, room_occupants, description, status, image, dorm_id) 
                                            VALUES('$room_name', '$price', '$available_beds', '$room_occupants', '$description', '$status', '$new_img_name', '$dorm_id')";
                                        mysqli_query($connect, $sql);

                                        alert('success', 'Room successfully added!');
                                    } else {
                                        alert('error', 'You can\'t upload files of this type');
                                    }
                                }
                            } else {
                                alert('error', 'Unknown error occurred!');
                            }
                        }

                        ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="bg-white rounded shadow p-4">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="room_id" value="">
                                        <div class="row" class="d-flex">
                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="room_name">Room Name:</label>
                                                <input type="text" class="form-control shadow-none" id="room_name" name="room_name" value="">
                                            </div>

                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="price">Price:</label>
                                                <input type="number" class="form-control shadow-none" id="price" name="price" value="" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" required>
                                            </div>
                                        </div>

                                        <div class="row" class="d-flex">
                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="room_name">Available Beds:</label>
                                                <input type="number" class="form-control shadow-none" id="room_name" name="available_beds" value="" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" required>
                                            </div>

                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="price">Room Occupants:</label>
                                                <input type="number" class="form-control shadow-none" id="price" name="room_occupants" value="" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" required>
                                            </div>

                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="room">Dorm: </label>
                                                <select name="dorm_name" class="form-select shadow-none " value="">
                                                    <option value="0">Select Dorm</option>
                                                    <?php
                                                    $sql = "SELECT * FROM dorm_data";
                                                    $result = mysqli_query($connect, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='" . $row['dorm_name'] . "'>" . $row['dorm_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                        </div>

                                        <div class="row" class="d-flex">


                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="status">Status: </label>
                                                <select name="status" class="form-select shadow-none " value="">
                                                    <option value="Available">Available</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>

                                            <div class="col-md-8 ps-0 mb-3">
                                                <label for="image" class="form-label">Image:</label>
                                                <input class="form-control" type="file" id="image" name="uploadfile" value="">
                                            </div>
                                        </div>
                                        <div class="row" class="d-flex">
                                            <div class="col-md-12 ps-0 mb-4">
                                                <label class="form-label" for="description">Description:</label><br>
                                                <input type="text" class="form-control shadow-none" id="description" name="description" value="">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" name="upload" class="btn btn-primary ml-auto me-lg-3 me-2 w-30">Add Room</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>