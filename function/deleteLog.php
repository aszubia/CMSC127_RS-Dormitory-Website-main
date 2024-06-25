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
  $log_id = $_POST['log_id'];

  // Delete the row from the database
  $sql = "DELETE FROM log_data WHERE log_id = $log_id";
  mysqli_query($conn, $sql);
}
