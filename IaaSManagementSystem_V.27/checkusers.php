<?php
  session_start();
  $_SESSION['loggedin'] = "";

  // gets username, email and password.
  $username = $_GET['username'];
  $email = $_GET['email'];
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

  // finds out if a user already exists with a particular username or email
  $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

  $stmt = oci_parse($connect, $sql);

  if(!$stmt)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
  }

  oci_execute($stmt);

  if (oci_fetch_array($stmt)) { // if a user already exists with a certain username or email, the user is sent back to the signup.php
    header('location: signup.php?createAccount=false');
    exit;
  }
  else { //if the user does not exist, the users details are stored in the db and sent to login.php
    $_SESSION['createUserError'] = "";
    $_SESSION['createAccount'] = true;

    // stores username in session
    $_SESSION['loggedin'] = $username;

    // inserts new users details into database table
    $sql = "INSERT INTO users (username, submit, email) VALUES ('{$username}', '{$submit}', '{$email}')";
    $stmt = oci_parse($connect, $sql);
    if(!$stmt)  {
      echo "An error occurred in parsing the sql string.\n";
      exit;
    }
    oci_execute($stmt);

    // sends user to the login.php
    header('location: login.php');

    // closes db connection
    oci_close($connect);
  }
?>
