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

if (isset($_GET['delete_student'])) {
  // Get the student ID from the form
  $student_id = $_GET['student_id'];

  // Get the room ID and dorm ID for the student
  $sql = "SELECT room_id, dorm_id FROM student_dorm_data WHERE student_id = '$student_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if ($row != null) {
    $room_id = $row['room_id'];
    $dorm_id = $row['dorm_id'];
    
    // Update the room_data table to reflect the deleted reservation
    $sql = "UPDATE room_data SET room_occupants = room_occupants - 1, available_beds = available_beds + 1, status = 'Available' WHERE room_id = '$room_id' AND dorm_id = '$dorm_id'";
    mysqli_query($conn, $sql);
  }

  // Delete the row from the database
  $sql = "DELETE FROM `student_data` WHERE student_id = '$student_id'";
  mysqli_query($conn, $sql);
  $sql = "DELETE FROM student_dorm_data WHERE student_id = '$student_id'";
  mysqli_query($conn, $sql);
  $sql = "DELETE FROM student_log_data WHERE student_id = '$student_id'";
  mysqli_query($conn, $sql);
  $sql = "DELETE FROM student_stay_data WHERE student_id = '$student_id'";
  mysqli_query($conn, $sql);
  $sql = "DELETE FROM log_data WHERE student_id = '$student_id'";
  mysqli_query($conn, $sql);


  exit();
}
