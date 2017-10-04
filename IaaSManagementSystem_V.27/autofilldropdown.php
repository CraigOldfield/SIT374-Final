<?php

function getInfrastructureIDs(){

  session_start();
  $username = $_SESSION['loggedin'];

  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $dbname = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $dbname);

  if (!$connect){
      echo "An error occurred connecting to the database";
      exit;
  }

  $sqlTwo = "SELECT ID FROM infrastructure WHERE USERNAME = '{$username}'";

  $stmtTwo = oci_parse($connect, $sqlTwo);

  if(!$stmtTwo){
    echo "An error occurred in parsing the sql string.\n";
    exit;
  }
  oci_execute($stmtTwo);

  $ids = array();

  while(oci_fetch_array($stmtTwo))
  {
    $id = oci_result($stmtTwo,"ID");
    array_push($ids, $id);
  }
  return $ids;

}

function storeVarsInSessions(&$submit){

  session_start();

  // connects to db
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
    echo "An error occurred connecting to the database";
    exit;
  }

  // Selects the most recent ID from infrastructure for the current user
  $sqlTwo = "SELECT * FROM infrastructure WHERE ID = '{$submit}'";

  $stmtTwo = oci_parse($connect, $sqlTwo);

  if(!$stmtTwo)  {
    echo "An error occurred in parsing the sql string.\n";
    exit;
  }

  oci_execute($stmtTwo);

  if(oci_fetch_array($stmtTwo))
  {
    $_SESSION['id'] = oci_result($stmtTwo,"ID");
    $_SESSION['cost'] = oci_result($stmtTwo,"COST");
    $_SESSION['service'] = oci_result($stmtTwo,"SERVICE");
    $_SESSION['ram'] = oci_result($stmtTwo,"RAM");
    $_SESSION['p1'] = oci_result($stmtTwo,"PACKAGEONE");
    $_SESSION['p2'] = oci_result($stmtTwo,"PACKAGETWO");;
    $_SESSION['p3'] = oci_result($stmtTwo,"PACKAGETHREE");
    $_SESSION['p4'] = oci_result($stmtTwo,"PACKAGEFOUR");
    $_SESSION['p5'] = oci_result($stmtTwo,"PACKAGEFIVE");
    $_SESSION['p6'] = oci_result($stmtTwo,"PACKAGESIX");
    $_SESSION['p7'] = oci_result($stmtTwo,"PACKAGESEVEN");
    $_SESSION['p8'] = oci_result($stmtTwo,"PACKAGEEIGHT");
    $_SESSION['p9'] = oci_result($stmtTwo,"PACKAGENINE");
    $_SESSION['p10'] = oci_result($stmtTwo,"PACKAGETEN");
    $_SESSION['p11'] = oci_result($stmtTwo,"PACKAGEELEVEN");
    $_SESSION['p12'] = oci_result($stmtTwo,"PACKAGETWELVE");
    $_SESSION['p13'] = oci_result($stmtTwo,"PACKAGETHIRTEEN");
    $_SESSION['p14'] = oci_result($stmtTwo,"PACKAGEFOURTEEN");
    $_SESSION['p15'] = oci_result($stmtTwo,"PACKAGEFIFTEEN");
    $_SESSION['p16'] = oci_result($stmtTwo,"PACKAGESIXTEEN");
    $_SESSION['p17'] = oci_result($stmtTwo,"PACKAGESEVENTEEN");
    $_SESSION['p18'] = oci_result($stmtTwo,"PACKAGEEIGHTTEEN");
    $_SESSION['p19'] = oci_result($stmtTwo,"PACKAGENINETEEN");
    $_SESSION['p20'] = oci_result($stmtTwo,"PACKAGETWENTY");
    $_SESSION['p21'] = oci_result($stmtTwo,"PACKAGETWENTYONE");
    $_SESSION['servers'] = oci_result($stmtTwo,"SERVERS");
    $_SESSION['vm'] = oci_result($stmtTwo,"VM");
    $_SESSION['cpu'] = oci_result($stmtTwo,"CPU");

    return $_SESSION['service'];
  }

}

 ?>
