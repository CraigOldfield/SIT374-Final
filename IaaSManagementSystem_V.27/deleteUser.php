<?php

  session_start();

  // gets username and password.
  $username = $_GET['user'];
  $submit = $_GET['submit'];

  // encrypts password using salt and sha256
  $salt = "A7fds7f6sd6d6fd77fd";
  $submit = $submit.$salt;
  $submit = hash("sha256",$submit);

  // connects to database (replace $dbuser and $dbpass with your own database username and password)
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

   // checks if user with a certain username and password exist
  $sql = "SELECT * FROM users WHERE username = '$username' AND submit = '$submit'";
  $stmt = oci_parse($connect, $sql);
  oci_execute($stmt);

   // User is successfully removed
  if (oci_fetch_array($stmt)) {
    $sqlTwo = "DELETE FROM users WHERE username = '$username'";
    $stmtTwo = oci_parse($connect, $sqlTwo);
    oci_execute($stmtTwo);
    $_SESSION['errorNewPassword'] = "";
    $_SESSION['loggedin'] = "";
    $_SESSION['illegalAccess'] = false;
    header('location: login.php');
  }
  else {
     // if login is unsuccessful, the user is sent back to the login page
    $_SESSION['errorNewPassword'] = "Password was incorrect";
    header('location: monitoringPage.php');
  }

  oci_close($connect);

?>
