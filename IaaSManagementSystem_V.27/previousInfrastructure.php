<?php

  session_start();
  $sort = $_GET['hidden'];

  //echo $sort;
  //exit;
  $_SESSION['filter1'] = $_GET['hidden1'];
  $_SESSION['filter2'] = $_GET['hidden2'];
  $_SESSION['filter3'] = $_GET['hidden3'];
  $_SESSION['filter4'] = $_GET['hidden4'];
  $_SESSION['filter5'] = $_GET['hidden5'];
  $_SESSION['filter6'] = $_GET['hidden6'];
  $_SESSION['filter7'] = $_GET['hidden7'];
  $_SESSION['filter8'] = $_GET['hidden8'];
  $_SESSION['filter9'] = $_GET['hidden9'];
  $_SESSION['filter10'] = $_GET['hidden10'];

  $webpage = $_GET['webpage'];
  $_SESSION['sort'] = $sort;
  if ($webpage == "shared") header('Location: viewSharedInfrastructure.php');
  else header('Location: viewPreviousInfrastructure.php');

?>
