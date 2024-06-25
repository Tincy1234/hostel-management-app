<?php
if (isset($_POST['login-submit'])) {
  // Include the database configuration file
  require 'config.inc.php';

  // Get the username and password from the form
  $username = $_POST['username'];
  $password = $_POST['pwd'];

  // Check if the username or password fields are empty
  if (empty($username) || empty($password)) {
    header("Location: ../login-hostel_manager.php?error=emptyfields");
    exit();
  } else {
    // Query the database to retrieve user information
    $sql = "SELECT * FROM admin WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
      // Compare the hashed password with the entered password
      $hashedPassword = $row['Pwd'];
      $pwdCheck = password_verify($password, $hashedPassword);

      if ($pwdCheck == false) {
        header("Location: ../login-hostel_manager.php?error=wrongpwd");
        exit();
      } else if ($pwdCheck == true) {
        // Start a session and store user information in session variables
        session_start();
        $_SESSION['hostel_man_id'] = $row['Admin_id'];
        $_SESSION['adm_fname'] = $row['Fname'];
        $_SESSION['adm_lname'] = $row['Lname'];
        $_SESSION['mob_no'] = $row['Mob_no'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['hostel_id'] = $row['Hostel_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['PSWD'] = $row['Pwd'];
        
        // Redirect to a success page after login
        header("Location: ../home_manager.php?login=success");
      } else {
        header("Location: ../login-hostel_manager.php?error=strangeerr");
        exit();
      }
    } else {
      header("Location: ../login-hostel_manager.php?error=nouser");
      exit();
    }
  }
} else {
  // Redirect to the login page if login-submit is not set
  header("Location: ../login-hostel_manager.php");
  exit();
}
?>
