<?php
  session_start();

	// gets cost, username and selected infrastructure
  $cost = $_GET['hidden'];

	$username = $_SESSION['loggedin'];

  $One = $_GET['service'];

  //Packages
  $p1 = $_GET['p1'];
  $p2 = $_GET['p2'];
  $p3 = $_GET['p3'];
  $p4 = $_GET['p4'];
  $p5 = $_GET['p5'];
  $p6 = $_GET['p6'];
  $p7 = $_GET['p7'];
  $p8 = $_GET['p8'];
  $p9 = $_GET['p9'];
  $p10 = $_GET['p10'];
  $p11 = $_GET['p11'];
  $p12 = $_GET['p12'];
  $p13 = $_GET['p13'];
  $p14 = $_GET['p14'];
  $p15 = $_GET['p15'];
  $p16 = $_GET['p16'];
  $p17 = $_GET['p17'];
  $p18 = $_GET['p18'];
  $p19 = $_GET['p19'];
  $p20 = $_GET['p20'];
  $p21 = $_GET['p21'];

  $Five = $_GET['servers'];
  if ($Five == "10"){ $Five = "2"; }
  else if ($Five == "15"){ $Five = "3"; }
  else if ($Five == "22"){ $Five = "4"; }
  else if ($Five == "30"){ $Five = "5"; }
  else if ($Five == "37"){ $Five = "6"; }

  // Changes the cost of the infrastructure components to the size
  $Two = $_GET['ram'];
  if ($Two == "45"){ $Two = "8"; }
  else if ($Two == "100"){ $Two = "16"; }

  $Six = $_GET['vm'];
  if ($Six == "2"){ $Six = "1"; }
  else if ($Six == "4"){ $Six = "2"; }
  else if ($Six == "4"){ $Six = "2"; }
  else if ($Six == "6"){ $Six = "3"; }
  else if ($Six == "8"){ $Six = "4"; }
  else if ($Six == "10"){ $Six = "5"; }
  else if ($Six == "12"){ $Six = "6"; }

  $Seven = $_GET['cpu'];
  if ($Seven == "2"){ $Seven = "2"; }
  else if ($Seven == "4"){ $Seven = "4"; }
  else if ($Seven == "6"){ $Seven = "6"; }

	// connects to database
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

	// finds most recent infrastructure of this user
  $sqlTwo = "SELECT MAX(ID) FROM infrastructure WHERE USERNAME = '{$username}'";
  $stmtTwo = oci_parse($connect, $sqlTwo);
  oci_execute($stmtTwo);

  while(oci_fetch_array($stmtTwo)) {
    $id = oci_result($stmtTwo,"MAX(ID)");
    $_SESSION['currentID'] = $id;
	}

  oci_close($connect);

////////////////////////////////////////////////////////////////////////////

  $current = $_SESSION['currentID'];

	// checks if getting ID was successful or not
  if ($current != ""){

    $connect = oci_connect($dbuser, $dbpass, $db);

    if (!$connect) {
        echo "An error occurred connecting to the database";
        exit;
    }

  	// updates the current infrastructure with new values
    $sqlTwo = "UPDATE infrastructure SET
    COST = '{$cost}',
    SERVICE = '{$One}',
    RAM = '{$Two}',
    PACKAGEONE = '{$p1}',
    PACKAGETWO = '{$p2}',
    PACKAGETHREE = '{$p3}',
    PACKAGEFOUR = '{$p4}',
    PACKAGEFIVE = '{$p5}',
    PACKAGESIX = '{$p6}',
    PACKAGESEVEN = '{$p7}',
    PACKAGEEIGHT = '{$p8}',
    PACKAGENINE = '{$p9}',
    PACKAGETEN = '{$p10}',
    PACKAGEELEVEN = '{$p11}',
    PACKAGETWELVE = '{$p12}',
    PACKAGETHIRTEEN = '{$p13}',
    PACKAGEFOURTEEN = '{$p14}',
    PACKAGEFIFTEEN = '{$p15}',
    PACKAGESIXTEEN = '{$p16}',
    PACKAGESEVENTEEN = '{$p17}',
    PACKAGEEIGHTTEEN = '{$p18}',
    PACKAGENINETEEN = '{$p19}',
    PACKAGETWENTY = '{$p20}',
    PACKAGETWENTYONE = '{$p21}',
    SERVERS = 'null',
    VM = '{$Six}',
    CPU = '{$Seven}'
    WHERE ID = '{$current}'";

    $stmtTwo = oci_parse($connect, $sqlTwo);

    if(!$stmtTwo)  {
      echo "An error occurred in parsing the sql string.\n";
      exit;
    }

    oci_execute($stmtTwo);

  	// directs user to monitoring page
    header('location: monitoringPage.php?');
}
else {
  header('location: monitoringPage.php?');
}
oci_close($connect);

?>
