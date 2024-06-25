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


    <title>Add Payment</title>
</head>


<body>

    <?php
    require('header.php');
    require('../admin/inc/links.php');
    require('../admin/inc/essentials.php');
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h2 class="fw-bold mb-4">ADD PAYMENT</h2>
                <div class="row">
                    <div class="col-md-7">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="bg-white rounded shadow p-4">
                                    <form method="POST">
                                        <input type="hidden" name="pay_id" value="">

                                        <div class="row" class="d-flex">
                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="first_name">First Name:</label>
                                                <input type="text" class="form-control shadow-none" id="first_name" name="first_name" value="">
                                            </div>

                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="last_name">Last Name:</label>
                                                <input type="text" class="form-control shadow-none" id="last_name" name="last_name" value="">
                                            </div>

                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="price">Amount:</label>
                                                <input type="text" class="form-control shadow-none" id="amount" name="amount" value="">
                                            </div>

                                            <div class="col-md-6 ps-0 mb-3">
                                                <label class="form-label" for="last_name">Date Paid:</label>
                                                <input type="date" class="form-control shadow-none" id="date_paid" name="date_paid" value="">
                                            </div>
                                        </div>

                                        <div class="row" class="d-flex">
                                            <div class="col-md-4 ps-0 mb-3">
                                                <label class="form-label" for="room">Mode of Payment: </label>

                                                <select name="modeOfPayment" class="form-select shadow-none " value="">
                                                    <option value="" selected disabled></option>
                                                    <option value="GCASH">GCASH</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Debit Card">Debit Card</option>
                                                    <option value="Cash">Cash</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-evenly">
                                            <button type="submit" name="submit_pay" class="btn btn-primary ml-auto me-lg-3 me-2 w-30">Add Payment</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    // If upload button is clicked ...
    if (isset($_POST['submit_pay'])) {

        // Collect the form data
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $date_paid = mysqli_real_escape_string($conn, $_POST['date_paid']);
        $modeOfPayment = mysqli_real_escape_string($conn, $_POST['modeOfPayment']);

        // Construct the insert query
        $sql = "INSERT INTO `payment_data` (first_name, last_name, amount, date_paid, modeOfPayment) VALUES ('$first_name', '$last_name', '$amount', '$date_paid', '$modeOfPayment')";

        // Execute the query
        mysqli_query($conn, $sql);


        alert('success', 'Payment successfully added!');
        header('Location: searchPay.php');
    }
    ?>

</body>

</html>