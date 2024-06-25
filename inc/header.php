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

require('inc/essentials.php'); ?>
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid px-lg-4 mt-1">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">RS Dormitory</a>

        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link me-2" href="about.php">About</a>
                </li>

            </ul>

            <div class="d-flex">

                <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                    // Display a welcome message with the user's name
                    echo '
                                <form method="POST" class="d-flex" style="justify-content: center;">
                                    <button type="submit" name="profile" class="btn btn-dark me-lg-3 me-2">Profile</button>
                                    <button type="submit" name="logout" class="btn btn-primary ">Logout</button>
                                </form>
                          ';
                } else {
                    echo '
                                <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2 " data-bs-toggle="modal" data-bs-target="#loginModal">
                                        Login
                                </button>
                                <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                                        Register
                                </button>
                                ';
                }

                if (isset($_POST['profile'])) {
                    // Escape user inputs for security
                    $sql = "SELECT * FROM `student_data` 
                                        WHERE student_id = '" . $_SESSION['student_id'] . "'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Retrieve the user's name from the database
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        $student_id = $row['student_id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $sex = $row['sex'];
                        $birth_date = $row['birth_date'];
                        $age = $row['age'];
                        $contact_number = $row['contact_number'];
                        $email_address = $row['email_address'];
                        $home_address = $row['home_address'];

                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['last_name'] = $last_name;
                        $_SESSION['sex'] = $sex;
                        $_SESSION['birth_date'] = $birth_date;
                        $_SESSION['age'] = $age;
                        $_SESSION['contact_number'] = $contact_number;
                        $_SESSION['email_address'] = $email_address;
                        $_SESSION['home_address'] = $home_address;
                        $_SESSION['student_id'] = $row['student_id'];

                        // Redirect the user to the profile page and pass the student_id as a query string parameter
                        header("Location: profile.php?student_id=" . $_SESSION['student_id']);
                        exit;
                    }
                }


                if (isset($_POST['logout'])) {
                    // Log the user out
                    $_SESSION['logged_in'] = false;

                    // Retrieve the student ID from the session
                    $student_id = $_SESSION['student_id'];

                    // Insert a new row into the log_data table to record the logout
                    $sql = "INSERT INTO log_data (student_id, log_status, time) VALUES ('$student_id', 'out' , NOW())";
                    mysqli_query($conn, $sql);

                    session_destroy();
                    // Redirect the user to the home page
                    header('Location: index.php');
                }

                ?>

            </div>

        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">

                    <h5 class="modal-title d-flex align-items-center ">
                        <i class="bi bi-person-circle fs-3 me-2"></i> User Login
                    </h5>

                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email_address" class="form-control shadow-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control shadow-none" required>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" name="submit-1" class="btn btn-dark shadow-none">LOGIN</button>
                        <a href="admin/index.php" class="text-secondary text-decoration-none">Log-In as Admin</a>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>
<?php

if (isset($_GET['submit-1'])) {

    // Escape user inputs for security
    $email_address = mysqli_real_escape_string($conn, $_GET['email_address']);
    $password = mysqli_real_escape_string($conn, $_GET['password']);

    // Attempt insert query execution
    $sql = "SELECT * FROM `student_data` WHERE email_address = '$email_address' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Log the user in
        $_SESSION['logged_in'] = true;

        // Retrieve the user's name from the database
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $student_id = $row['student_id'];

        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['student_id'] = $student_id;

        // Insert a new row into the log_data table to record the login
        $sql = "INSERT INTO `log_data` (student_id, log_status, `time`) VALUES ($student_id, 'in', NOW())";
        mysqli_query($conn, $sql);

        // Update the student_log_data table to record the latest login and total logins
        $sql = "INSERT INTO student_log_data (student_id, last_login, total_logins)
                        VALUES ('$student_id', NOW(), 1)
                        ON DUPLICATE KEY UPDATE last_login = NOW(), total_logins = total_logins + 1";
        mysqli_query($conn, $sql);

        // Redirect the user to the home page
        header('Location: index.php');
    } else {
        // Display an error message indicating that the email and password combination is incorrect
        alert('error', 'Login failed - Invalid Credentials!');
    }
}

?>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">

                    <h5 class="modal-title d-flex align-items-center ">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> User Registration
                    </h5>

                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (Student ID, National ID, Passport, etc.)
                        that will be required during check-in.
                    </span>

                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control shadow-none" name="first_name" required>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control shadow-none" name="last_name" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Sex</label>
                                <select class="form-select" name="sex" required>
                                    <option value="none" selected disabled hidden></option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Prefer not to say</option>
                                </select>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" min="0" name="age" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control shadow-none" name="birth_date" required>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="tel" placeholder="Enter an 11-digit phone number" pattern="[0-9]{11}" class="form-control shadow-none" name="contact_number" required>
                            </div>

                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label">Home Address</label>
                                <textarea class="form-control shadow-none" rows="1" name="home_address" required></textarea>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control shadow-none" name="email_address" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control shadow-none" name="password" required>
                            </div>

                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="submit" class="btn btn-dark shadow-none" name="submit-2">REGISTER</button>
                    </div>

                </div>

            </form>


        </div>
    </div>
</div>
<?php
if (isset($_POST['submit-2'])) {
    // Escape user inputs for security
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $home_address = mysqli_real_escape_string($conn, $_POST['home_address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Attempt insert query execution
    $sql = "INSERT INTO `student_data` (`first_name`, `last_name`, `sex`, `age`, `birth_date`, `contact_number`, `email_address`, `home_address`, `password`)
                            VALUES ('$first_name', '$last_name', '$sex', '$age', '$birth_date', '$contact_number', '$email_address', '$home_address', '$password')";
    $result = mysqli_query($conn, $sql);

    // Get the student_id of the inserted data
    $student_id = mysqli_insert_id($conn);

    $sql = "INSERT INTO `student_dorm_data` (`student_id`, `room_id`, `dorm_id`)
                            VALUES ('$student_id' ,'0', '0')";
    $result = mysqli_query($conn, $sql);

    $sql = "INSERT INTO `student_stay_data` (`student_id`, `start_date`, `end_date`)
                            VALUES ('$student_id', CURRENT_DATE, CURRENT_DATE)";
    $result = mysqli_query($conn, $sql);

    $_SESSION['logged_in'] = true;
    $_SESSION['first_name'] = $first_name;

    // Redirect the user to the home page
    alert('success', 'You have successfully registered!');
}


?>