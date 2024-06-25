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

    <title>Contact Us</title>
    <?php require('inc/links.php'); ?>
    <link rel="stylesheet" href="css/common.css">

</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">USER PROFILE</h2>
        <div class="h-line bg-dark"></div>
    </div>


    <?php
    // Check if the student_id is passed in the GET parameter
    if (isset($_GET['student_id'])) {
        $student_id = $_SESSION['student_id'];

        // Retrieve the data for the student with the specified student_id
        $sql = "SELECT * FROM student_data WHERE student_id = $student_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display the data in a form
            echo '
                    <div class="container d-flex justify-content-center">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 mb-5 px-4">
                                <div class="bg-white rounded shadow p-4">
                                    <form method="POST">
                                        <input type="hidden" name="student_id" value="' . $student_id . '">
                                        <div class="row" class="d-flex">
                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="first_name">First Name:</label>
                                                <input type="text" class="form-control shadow-none" id="first_name" name="first_name" value="' . $row['first_name'] . '">
                                            </div>

                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="last_name">Last Name:</label>
                                                <input type="text"  class="form-control shadow-none" id="last_name" name="last_name" value="' . $row['last_name'] . '">
                                            </div>
                                        </div>
                                        <div class="row" class="d-flex">
                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="sex">Sex: </label>
                                                <select name="sex" class="form-select shadow-none "  value="' . $row['sex'] . '" >
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                    <option value="O">Prefer not to say</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="birth_date">Birth Date:</label>
                                                <input type="date" class="form-control shadow-none" id="birth_date" name="birth_date" value="' . $row['birth_date'] . '">
                                            </div>
                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="age">Age:</label><br>
                                                <input type="number" class="form-control shadow-none" id="age" name="age" value="' . $row['age'] . '" min="0">
                                            </div>
                                        </div>

                                        <div class="row" class="d-flex">
                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="contact_number">Contact Number:</label>
                                                <input type="tel" class="form-control shadow-none"id="contact_number" name="contact_number" value="' . $row['contact_number'] . '" pattern="[0-9]{11}">
                                            </div>
                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="email_address">Email Address:</label>
                                                <input type="email" class="form-control shadow-none" id="email_address" name="email_address" value="' . $row['email_address'] . '">
                                            </div>
                                        </div>
                                        <div class="row" class="d-flex">
                                            <div class="col-md-12 ps-0 mb-4">
                                                <label  class="form-label" for="home_address">Home Address:</label><br>
                                                <input type="text"class="form-control shadow-none" id="home_address" name="home_address" value="' . $row['home_address'] . '">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-evenly">
                                            <button class="btn btn-md text-white btn-primary shadow-none" type="submit" name="edit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
        }
    } else {
        echo "No student_id specified";
    }
    // Check if the Edit button was clicked
    if (isset($_POST['edit'])) {
        // Get the values from the form
        $student_id = $_POST['student_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $sex = $_POST['sex'];
        $birth_date = $_POST['birth_date'];
        $age = $_POST['age'];
        $contact_number = $_POST['contact_number'];
        $email_address = $_POST['email_address'];
        $home_address = $_POST['home_address'];

        // Edit the data in the database
        $sql = "UPDATE student_data SET first_name = '$first_name', last_name = '$last_name',
                        sex = '$sex', birth_date = '$birth_date', age = '$age', contact_number = '$contact_number',
                        email_address = '$email_address', home_address = '$home_address'  WHERE student_id = $student_id";
        if (mysqli_query($conn, $sql)) {
            // Data edited successfully, redirect to the main page
            header("Location: index.php");
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }

    // Close the MySQL connection
    mysqli_close($conn);
    ?>



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