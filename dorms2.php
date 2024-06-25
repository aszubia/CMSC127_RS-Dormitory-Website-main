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

  <title>Dorms</title>
  <?php require('inc/links.php'); ?>
  <link rel="stylesheet" href="css/common.css">

  <style>
    img {
      max-width: 100%;
      max-height: 100%;
    }

    #notAvailable {
      background-color: red;
      color: white;
    }
  </style>



</head>

<body class="bg-light">

  <?php require('inc/header.php'); ?>
  <?php

  if (isset($_POST['submit-prf'])) {

    // Escape user inputs for security
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $student_id = $_SESSION['student_id'];

    // Get room_id and dorm_id from form submission
    $room_id = mysqli_real_escape_string($conn, $_POST['room_id']);

    // Get dorm_id for the room
    $sql = "SELECT dorm_id FROM room_data WHERE room_id = '$room_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $dorm_id = $row['dorm_id'];

    $sql = "SELECT * FROM student_dorm_data WHERE student_id = '$student_id' AND room_id = '$room_id'";
    $resultSd = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultSd) > 0) {
      // Student has already made a reservation for the current room
      alert('error', 'You have already made a reservation for this room. Please choose a different room.');
    } else {
      // Student has not made a reservation for the current room
      // Update room_data table to reflect the new reservation

      $sql = "SELECT available_beds FROM room_data WHERE room_id = '$room_id' AND dorm_id = '$dorm_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $available_beds = $row['available_beds'];

      if ($available_beds > 1) {
        $sql = "UPDATE room_data SET room_occupants = room_occupants + 1, available_beds = available_beds - 1 WHERE room_id = '$room_id'";
        mysqli_query($conn, $sql);

        // Insert new row into student_dorm_data table
        $sql = "INSERT INTO `student_dorm_data` (student_id, room_id, dorm_id) VALUES ('$student_id', '$room_id', '$dorm_id')
      ON DUPLICATE KEY UPDATE room_id = '$room_id', dorm_id = '$dorm_id'";
        mysqli_query($conn, $sql);

        // Insert new row into student_stay_data table
        $sql = "INSERT INTO `student_stay_data` (`student_id`, `start_date`, `end_date`)
      VALUES ('$student_id', '$start_date', '$end_date')
      ON DUPLICATE KEY UPDATE start_date = '$start_date', end_date = '$end_date'";
        mysqli_query($conn, $sql);

        // Redirect the user to the home page
        alert('success', 'You have successfully reserved!');
      } elseif ($available_beds == 1) {
        $sql = "UPDATE room_data SET room_occupants = room_occupants + 1, available_beds = available_beds - 1 WHERE room_id = '$room_id'";
        mysqli_query($conn, $sql);

        $sql = "UPDATE room_data SET status = 'N/A' WHERE room_id = '$room_id'";
        mysqli_query($conn, $sql);

        // Insert new row into student_dorm_data table
        $sql = "INSERT INTO `student_dorm_data` (student_id, room_id, dorm_id) VALUES ('$student_id', '$room_id', '$dorm_id')
      ON DUPLICATE KEY UPDATE room_id = '$room_id', dorm_id = '$dorm_id'";
        mysqli_query($conn, $sql);

        // Insert new row into student_stay_data table
        $sql = "INSERT INTO `student_stay_data` (`student_id`, `start_date`, `end_date`)
      VALUES ('$student_id', '$start_date', '$end_date')
      ON DUPLICATE KEY UPDATE start_date = '$start_date', end_date = '$end_date'";
        mysqli_query($conn, $sql);

        // Redirect the user to the home page
        alert('success', 'You have successfully reserved!');
      } else {
        alert('error', 'This room is already full. Please choose a different room.');
      }
    }
  }


  ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">RS Dormitory Baguio</h2>
    <div class="h-line bg-dark"></div>
  </div>

  <div class="container d-flex justify-content-center ">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-11 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-4 align-items-center ">
            <?php
            $sql = "SELECT * FROM room_data WHERE dorm_id = 2";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                  <img src="images/rooms/<?php echo $row['image']; ?>" class="img-responsive rounded-start mb-4" width="440" height="247.5" alt="...">
                </div>
                <div class="col-md-4 px-lg-4 px-md-3 px-0">
                  <h2 class="mb-3"><?php echo $row['room_name']; ?></h5>
                    <h6 class="mb-3">Price: ₱<?php echo $row['price']; ?>/month</h6>
                    <h6 class="mb-4">Status: <?php echo $row['status']; ?></h6>
                    <div class="features mb-3">
                      <h6 class="mb-1">Features:</h6>
                      <span class="badge rounded-pill bg-light text-dark text-wrap">Available Beds: <?php echo $row['available_beds']; ?></span>
                      <span class="badge rounded-pill bg-light text-dark text-wrap mb-3">Room Occupants: <?php echo $row['room_occupants']; ?></span><br>
                      <button type="reset" class="btn btn-sm w-30 text-white custom-bg shadow-none mb-2 disabled-button" data-bs-toggle="modal" data-bs-target="#reserveModal" <?php
                                                                                                                                                                                // Check if the status of the room is "N/A"
                                                                                                                                                                                if ($row['status'] == 'N/A') {
                                                                                                                                                                                  echo 'id = "notAvailable" disabled';
                                                                                                                                                                                }
                                                                                                                                                                                ?>>
                        <?php
                        // Output the appropriate text based on the value of the status field
                        if ($row['status'] == 'N/A') {
                          echo 'Unavailable';
                        } else {
                          echo 'Reserve Now';
                        }
                        ?>
                      </button>
                    </div>
                </div>
                <div class="col-md-3">
                  <h6 class="mb-3">Description:</h6>
                  <p class="mb-1"><small><?php echo $row['description']; ?></small></p>
                </div>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Reserve Modal -->
  <div class="modal fade" id="reserveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <form method="POST">
          <div class="modal-header">
            <h5 class="modal-title d-flex align-items-center ">
              <i class="bi bi-bookmark-plus-fill fs-3 me-2"></i> Reserve Now
            </h5>
            <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 ps-0 mb-3">
                  <label class="form-label">Start Date</label>
                  <input type="date" class="form-control shadow-none" name="start_date" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">End Date</label>
                  <input type="date" class="form-control shadow-none" name="end_date" required>
                </div>
                <div class="col-md-6 p-0 mb-3">
                  <label class="form-label">Room Name</label>
                  <select class="form-control shadow-none" name="room_id" required>
                    <?php
                    // Select all room names with dorm_id = 1
                    $sql = "SELECT room_id, room_name FROM room_data WHERE dorm_id = 2";
                    $result = mysqli_query($conn, $sql);

                    // Loop through each row and create an option element for each room
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="' . $row['room_id'] . '">' . $row['room_name'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="d-flex align-items-center justify-content-center mb-2">
                <button type="submit" name="submit-prf" class="btn btn-dark shadow-none" <?php
                                                                                          // Check if the status of the room is "N/A"
                                                                                          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                                                                            echo 'id = "Available"';
                                                                                          } else {
                                                                                            echo 'id = "notAvailable" disabled';
                                                                                          }
                                                                                          ?>>
                  <?php
                  // Output the appropriate text based on the value of the status field
                  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                    echo 'Reserve Now';
                  } else {
                    echo 'Login to Reserve';
                  }
                  ?>
                </button>
              </div>
            </div>
          </div>
        </form>


      </div>
    </div>
  </div>

  <?php require('inc/footer.php'); ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

</body>

</html>