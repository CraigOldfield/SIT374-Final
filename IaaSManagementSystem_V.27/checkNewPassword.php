<?php

    session_start();

    $result = true;

    // Gets username, old password and new password
    $submit = $_GET['old'];
    $new = $_GET['new'];
    $username = $_GET['user'];

    // encrypts old password to check if it's correct
    $salt = "A7fds7f6sd6d6fd77fd";
    $submit = $submit.$salt;
    $submit = hash("sha256",$submit);

    //encrypts new password
    $new = $new.$salt;
    $new = hash("sha256",$new);

    //connects to database
    $dbuser = "dgbr";
    $dbpass = "ilovecows";
    $db = "SSID";
    $connect = oci_connect($dbuser, $dbpass, $db);

    if (!$connect) {
        echo "An error occurred connecting to the database";
        exit;
    }

    //finds out if a user exists with a certain username and password
    $sql = "SELECT submit FROM users WHERE username ='$username' AND submit = '$submit'";

    $stmt = oci_parse($connect, $sql);

	  if(!$stmt)  {
		  echo "An error occurred in parsing the sql string.\n";
		  exit;
    }

	   oci_execute($stmt);

	  if (oci_fetch_array($stmt)) $result = true; //user does exist
    else $result = false; //user doesn't exist

    if ($result == true){ // user does exist and password is correct
      // Replaces old password with new password
      $sql = "UPDATE users SET submit = '$new' WHERE username = '$username'";
      $stmt = oci_parse($connect, $sql);
      oci_execute($stmt);
      
      // clears error message displayed on monitoringPage
      $_SESSION['errorNewPassword'] = "";
      // directs user to monitoringPage
      header('location: monitoringPage.php');

    }
    else {
      // sets error message displayed on monitoringPage
      $_SESSION['errorNewPassword'] = "Password was incorrect";
      // directs user to monitoringPage
      header('location: monitoringPage.php');
    }

    oci_close($connect);

?>
