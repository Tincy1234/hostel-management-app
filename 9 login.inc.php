<?php
if (isset($_POST['login-submit'])) {
  // Include the database configuration file
  require 'config.inc.php';

  // Get the student's roll number and password from the form
  $roll = $_POST['student_roll_no'];
  $password = $_POST['pwd'];

  // Check if the roll number or password fields are empty
  if (empty($roll) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  } else {
    // Query the database to retrieve student information
    $sql = "SELECT * FROM Student WHERE Student_id = '$roll'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
      // Compare the hashed password with the entered password
      $pwdCheck = password_verify($password, $row['Pwd']);

      if ($pwdCheck == false) {
        header("Location: ../index.php?error=wrongpwd");
        exit();
      } else if ($pwdCheck == true) {
        // Start a session and store student information in session variables
        session_start();
        $_SESSION['roll'] = $row['Student_id'];
        $_SESSION['fname'] = $row['Fname'];
        $_SESSION['lname'] = $row['Lname'];
        $_SESSION['mob_no'] = $row['Mob_no'];
        $_SESSION['department'] = $row['Dept'];
        $_SESSION['year_of_study'] = $row['Year_of_study'];
        $_SESSION['hostel_id'] = $row['Hostel_id'];
        $_SESSION['room_id'] = $row['Room_id'];
        
        // Redirect to a success page after login
        header("Location: ../home.php?login=success");
      } else {
        header("Location: ../index.php?error=strangeerr");
        exit();
      }
    } else {
      header("Location: ../index.php?error=nouser");
      exit();
    }
  }
} else {
  // Redirect to the login page if login-submit is not set
  header("Location: ../index.php");
  exit();
}
?>
