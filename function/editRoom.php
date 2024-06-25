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

<head>
    <script src="javascript.js" type="text/javascript"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('../admin/inc/links.php'); ?>

    <title>Edit Room Data</title>
</head>


<body>

    <?php require('header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">EDIT ROOM DATA</h2>
                <div class="row">
                    <div class="col-md-7">

                        <?php
                        // Check if the room_id is passed in the GET parameter
                        if (isset($_GET['room_id'])) {
                            $room_id = $_GET['room_id'];

                            // Retrieve the data for the room with the specified room_id
                            $sql = "SELECT * FROM `room_data` WHERE room_id = $room_id";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                // Display the data in a form
                                echo '
                                <div class="container-fluid">
                                    <div class="row">
                                            <div class="bg-white rounded shadow p-4">
                                                <form method="POST">
                                                    <input type="hidden" name="room_id" value="">
                                                    <div class="row" class="d-flex">
                                                        <div class="col-md-6 ps-0 mb-3">
                                                            <label class="form-label" for="room_name">Room Name:</label>
                                                            <input type="text" class="form-control shadow-none" id="room_name" name="room_name" value="' . $row['room_name'] . '">
                                                        </div>

                                                        <div class="col-md-6 ps-0 mb-3">
                                                            <label class="form-label" for="price">Price:</label>
                                                            <input type="number"  class="form-control shadow-none" id="price" name="price" value="' . $row['price'] . '">
                                                        </div>

                                                        <div class="col-md-6 ps-0 mb-3">
                                                            <label class="form-label" for="available_beds">Available Beds:</label>
                                                            <input type="text"  class="form-control shadow-none" id="available_beds" name="available_beds" value="' . $row['available_beds'] . '">
                                                        </div>

                                                        <div class="col-md-4 ps-0 mb-3">
                                                            <label class="form-label" for="status">Status: </label>
                                                            <select name="status" class="form-select shadow-none "  value="' . $row['status'] . '" >
                                                                <option value="Available">Available</option>
                                                                <option value="N/A">N/A/option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 ps-0 mb-3">
                                                            <label class="form-label" for="description">Description:</label>
                                                            <input type="text"  class="form-control shadow-none" id="description" name="description" value="' . $row['description'] . '">
                                                        </div>

                                                        <div class="col-md-6 ps-0 mb-3">
                                                            <label class="form-label" for="image">Image:</label>
                                                            <input type="text"  class="form-control shadow-none" id="image" name="image" value="' . $row['image'] . '">
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-evenly">
                                                    <button type="submit" name="submit" class="btn btn-md text-white btn-primary shadow-none">Update Room</button>
                                                    </div>
                                                 </form> 
                                        </div> 
                                    </div>
                                </div>';
                            }
                        }

                        // Check if the Edit button was clicked
                        if (isset($_POST['submit'])) {
                            // Get the values from the form
                            $room_name = $_POST['room_name'];
                            $available_beds = $_POST['available_beds'];

                            // Check if any of the form fields are empty
                            if (empty($room_name) || empty($available_beds)) {
                                // Display an error message
                                echo '<div class="alert alert-danger">All fields are required!</div>';
                            } else {
                                // Edit the data in the database
                                $sql = "UPDATE room_data SET room_name = '$room_name', available_beds = '$available_beds' WHERE room_id = $room_id";
                                if (mysqli_query($conn, $sql)) {
                                    // Data edited successfully, redirect to the main page
                                    header("Location: searchRoom.php");
                                } else {
                                    echo "Error updating data: " . mysqli_error($conn);
                                }
                            }
                        }





                        // Close the MySQL connection
                        mysqli_close($conn);
                        ?>


                    </div>
                </div>
            </div>
        </div>


</body>

</html>