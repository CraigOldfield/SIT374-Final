<?php
  session_start();

	// gets cost, username and selected infrastructure
  $username = $_SESSION['username'];
  $submit = $_SESSION['submit'];
  $submitTwo = $_GET['submitOne'];

  // Encrypt password
  $salt = "A7fds7f6sd6d6fd77fd";
  $submitTwo = $submitTwo.$salt;
  $submitTwo = hash("sha256",$submitTwo);

	// connects to database
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

	// updates the current infrastructure
  $sql = "SELECT * FROM users WHERE submit='{$submit}'";
  $stmt = oci_parse($connect, $sql);
  oci_execute($stmt);

  if(oci_fetch_array($stmt)) {
    // updates the current infrastructure
    $sqlTwo = "UPDATE users SET SUBMIT='{$submitTwo}' WHERE USERNAME = '{$username}'";
    $stmtTwo = oci_parse($connect, $sqlTwo);
    oci_execute($stmtTwo);
    
    session_destroy();
    header('location: login.php');
  }
  else {
    echo "failure";
  }

  oci_close($connect);

?>
