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
  $pay_id = $_POST['pay_id'];

  // Delete the row from the database
  $sql = "DELETE FROM payment_data WHERE pay_id = $pay_id";
  mysqli_query($conn, $sql);
}
