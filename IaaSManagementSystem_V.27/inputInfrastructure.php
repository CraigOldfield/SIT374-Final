<?php

  session_start();

	// gets username, infrastructure cost, and infrastructure components
  $user = $_SESSION['loggedin'];
  $cost = $_GET['hidden'];

  $service = $_GET['service'];

  //Modifies the ram to print the size instead of the cost
  $ram = $_GET['ram'];
  if ($ram == "45"){ $ram = "8"; }
  else if ($ram == "100"){ $ram = "16"; }

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

  /*$servers = $_GET['servers'];
  if ($servers == "10"){ $servers = "2"; }
  else if ($servers == "15"){ $servers = "3"; }
  else if ($servers == "22"){ $servers = "4"; }
  else if ($servers == "30"){ $servers = "5"; }
  else if ($servers == "37"){ $servers = "6"; }*/

  if ($autoservers == "2"){ $autoservers = "10"; }
  else if ($autoservers == "3"){ $autoservers = "15"; }
  else if ($autoservers == "4"){ $autoservers = "22"; }
  else if ($autoservers == "5"){ $autoservers = "30"; }
  else if ($autoservers == "6"){ $autoservers = "37"; }

  //Modifies the vm to print the size instead of the cost
  $vm = $_GET['vm'];
  if ($vm == "2"){ $vm = "1"; }
  else if ($vm == "4"){ $vm = "2"; }
  else if ($vm == "6"){ $vm = "3"; }
  else if ($vm == "8"){ $vm = "4"; }
  else if ($vm == "10"){ $vm = "5"; }
  else if ($vm == "12"){ $vm = "6"; }

  //Modifies the cpu to print the size instead of the cost
  $cpu = $_GET['cpu'];
  if ($cpu == "67"){ $cpu = "2"; }
  else if ($cpu == "103"){ $cpu = "4"; }
  else if ($cpu == "139"){ $cpu = "6"; }

  // connects to database
  $dbuser = "dgbr";
  $dbpass = "ilovecows";
  $db = "SSID";
  $connect = oci_connect($dbuser, $dbpass, $db);

  if (!$connect) {
      echo "An error occurred connecting to the database";
      exit;
  }

	// inputs selected infrastructure into database table
  $sql = "INSERT INTO infrastructure
  (ID, COST, USERNAME, SERVICE, RAM, SSD, PACKAGEONE,
  PACKAGETWO, PACKAGETHREE, PACKAGEFOUR,
  PACKAGEFIVE, PACKAGESIX, PACKAGESEVEN, PACKAGEEIGHT,
  PACKAGENINE, PACKAGETEN, PACKAGEELEVEN, PACKAGETWELVE,
  PACKAGETHIRTEEN, PACKAGEFOURTEEN, PACKAGEFIFTEEN,
  PACKAGESIXTEEN, PACKAGESEVENTEEN,
  PACKAGEEIGHTTEEN, PACKAGENINETEEN,
  PACKAGETWENTY, PACKAGETWENTYONE, SERVERS,
  VM, CPU) VALUES
  (SEQUENCE_ID.nextval, '{$cost}', '{$user}', '{$service}',
  '{$ram}', 'null', '{$p1}', '{$p2}', '{$p3}', '{$p4}',
  '{$p5}', '{$p6}', '{$p7}', '{$p8}', '{$p9}', '{$p10}',
  '{$p11}', '{$p12}', '{$p13}', '{$p14}', '{$p15}',
  '{$p16}', '{$p17}', '{$p18}', '{$p19}', '{$p20}', '{$p21}',
  'null', '{$vm}', '{$cpu}')";

  $stmt = oci_parse($connect, $sql);
  oci_execute($stmt);

	// redirects user to monitoringPage.php
	header('location: monitoringPage.php?');

	oci_close($connect);

?>
