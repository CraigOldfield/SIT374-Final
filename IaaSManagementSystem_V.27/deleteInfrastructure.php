<?php

  session_start();

  //Connects to db
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

  $userDisplay = $_SESSION['loggedin'];

  $sqlTwo = "SELECT MAX(ID) FROM infrastructure WHERE USERNAME = '{$userDisplay}'";
  $stmtTwo = oci_parse($connect, $sqlTwo);
  oci_execute($stmtTwo);

  if(oci_fetch_array($stmtTwo)) {
    //Gets ID for current infrastructure
    $id = oci_result($stmtTwo,"MAX(ID)");

    //Removes must current infrastructure
    $sqlTwo = "DELETE FROM infrastructure WHERE ID = '{$id}'";
    $stmtTwo = oci_parse($connect, $sqlTwo);
    if(!$stmtTwo) {
      echo "An error occurred in parsing the sql string.\n";
      exit;
    }
    oci_execute($stmtTwo);
    header("Location: monitoringPage.php");
  }


?>
