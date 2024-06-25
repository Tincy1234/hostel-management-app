<?php
  // Start a new session or resume the existing session
  session_start();

  // Database connection parameters
  $servername = "localhost"; // database server name
  $dBUsername = "root";      // Database username
  $dBPassword = "";          // Database password
  $dBName = "hostel";        // Database name

  // Create a connection to the MySQL database
  $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

  // Check if the database connection was successful
  if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
  }
?>
