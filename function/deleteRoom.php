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

if (isset($_POST['delete'])) {
  // Get the student ID from the form
  $room_id = $_POST['room_id'];

  // Delete the row from the database
  $sql = "DELETE FROM room_data WHERE room_id = $room_id";
  mysqli_query($conn, $sql);
  $sql = "DELETE FROM student_dorm_data WHERE room_id = $room_id";
  mysqli_query($conn, $sql);
}
