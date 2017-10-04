<?php

  $data = $_GET['splitArray'];
  $data = explode(",", $data);

  $username = $data[3]; //username
  $service = $data[4]; //service
  $ram = $data[5]; //ram
  //$servers = $data[7]; //servers
  $vm = $data[7]; //vm
  $cpu = $data[8]; //cpu
  $packages = $data[8]; //packages

  $packages = "";

  $count = 9;
  while ($count < sizeof($data))
  {
    $data[$count] = trim($data[$count], " ");

    if ($data[$count] == 'R'){
      $p1 = $data[$count];
    }
    else if ($data[$count] == 'Python'){
      $p2 = $data[$count];
    }
    else if ($data[$count] == 'SQL Server'){
      $p3 = $data[$count];
    }
    else if ($data[$count] == 'git'){
      $p4 = $data[$count];
    }
    else if ($data[$count] == 'PHP'){
      $p5 = $data[$count];
    }
    else if ($data[$count] == 'Okta'){
      $p6 = $data[$count];
    }
    else if ($data[$count] == 'Zscaler'){
      $p7 = $data[$count];
    }
    else if ($data[$count] == 'ClipherCloud'){
      $p8 = $data[$count];
    }
    else if ($data[$count] == 'IOS SDK'){
      $p9 = $data[$count];
    }
    else if ($data[$count] == 'Android SDK'){
      $p10 = $data[$count];
    }
    else if ($data[$count] == 'Xamarin'){
      $p11 = $data[$count];
    }
    else if ($data[$count] == 'Weka'){
      $p12 = $data[$count];
    }
    else if ($data[$count] == 'Apache Drill'){
      $p13 = $data[$count];
    }
    else if ($data[$count] == 'Ruby'){
      $p14 = $data[$count];
    }
    else if ($data[$count] == '.NET'){
      $p15 = $data[$count];
    }
    else if ($data[$count] == 'IOS'){
      $p16 = $data[$count];
    }
    else if ($data[$count] == 'DocTrackr'){
      $p17 = $data[$count];
    }
    else if ($data[$count] == 'Centrify'){
      $p18 = $data[$count];
    }
    else if ($data[$count] == 'Vaultive'){
      $p19 = $data[$count];
    }
    else if ($data[$count] == 'React Native'){
      $p20 = $data[$count];
    }
    else if ($data[$count] == 'Unity'){
      $p21 = $data[$count];
    }
    $count++;
  }

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
  $sql = "INSERT INTO shareinfrastructure
  (USERNAME, SERVICE, RAM, SSD, PACKAGEONE,
  PACKAGETWO, PACKAGETHREE, PACKAGEFOUR,
  PACKAGEFIVE, PACKAGESIX, PACKAGESEVEN, PACKAGEEIGHT,
  PACKAGENINE, PACKAGETEN, PACKAGEELEVEN, PACKAGETWELVE,
  PACKAGETHIRTEEN, PACKAGEFOURTEEN, PACKAGEFIFTEEN,
  PACKAGESIXTEEN, PACKAGESEVENTEEN,
  PACKAGEEIGHTTEEN, PACKAGENINETEEN,
  PACKAGETWENTY, PACKAGETWENTYONE, SERVERS,
  VM, CPU) VALUES
  ('{$username}', '{$service}',
  '{$ram}', 'null', '{$p1}', '{$p2}', '{$p3}', '{$p4}',
  '{$p5}', '{$p6}', '{$p7}', '{$p8}', '{$p9}', '{$p10}',
  '{$p11}', '{$p12}', '{$p13}', '{$p14}', '{$p15}',
  '{$p16}', '{$p17}', '{$p18}', '{$p19}', '{$p20}', '{$p21}',
  '{$servers}', '{$vm}', '{$cpu}')";

  $stmt = oci_parse($connect, $sql);
  oci_execute($stmt);

	// redirects user to monitoringPage.php
	header('location: viewSharedInfrastructure.php');

	oci_close($connect);

?>
