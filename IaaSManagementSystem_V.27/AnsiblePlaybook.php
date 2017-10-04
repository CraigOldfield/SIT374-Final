<?php
  session_start();
  $data = $_GET['splitArray'];
  $_SESSION['downloadFile'] = $data;
  $data2 = $_SESSION['downloadFile'];
  $data2 = explode(",", $data2);
  $_SESSION['buttonClicked'] = "AnsiblePlaybook";
?>
<!DOCTYPE html>
<html>
<head>

  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/css.css">

  <script type = "text/javascript" src="js/jquery-2.1.3.min.js"></script>

  <title>Monitoring Page</title>

  <style>

    tableContainer {background-color: white; height: 1145px; left: 50%; width: 900px; margin-left: -450px; padding-top: 15px; overflow-x: auto;}
    tablesContainer {position: absolute; left:50%; width: 900px; margin-left: -450px; }

    whiteBox {
      background-color: white;
      position: absolute;
      width: 100%;
      top: 350px;
      height: 1160px;
      left: 0px;
      z-index: 999999;
      margin: 0;
      padding: 0;
    }
    input[type=number]{
      width: 375px;
    }
    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      -moz-border-radius: 3px;
      -webkit-border-radius: 3px;
      background-position: right center;
      background-color: white;
      color: #000000;
      height:25px !important;
      width: 380px;
      cursor: pointer;
      background: url("http://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/br_down.png") no-repeat;
      right: 0;
      top: 0;
      bottom: 0;
      background-position: 97% 60%;
      background-size: 13px;
    }
    exitButton {
      position: fixed;
      background-color: lightblue;
      z-index: 9999999999999;
      width: 10px;
      height: 10px;
      top:5px;
      right:5px;
    }
    changePassword {
      position: fixed;
      background-color: white;
      left: 50%;
      margin-left:-200px;
      width: 400px;
      top: 50%;
      height: auto;
      margin-top: -200px;
      z-index: 999999999999;
       box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }

  </style>

  <script type="text/javascript">

    setTimeout( function() {
      if (localStorage.getItem("selected") != undefined && localStorage.getItem("selected") != "undefined"){
        localStorage.setItem("selected", undefined);
        window.location = "downloadFile.php"
      }
    }, 2000);

  </script>

</head>

<body onload="saveFile()">

  <input type="text" hidden="true" id="oldHidden" name="oldHidden">
  <input type="text"  hidden="true" id="newHidden" name="newHidden">

  <?php

  $userDisplay = $_SESSION['loggedin'];
  if ($userDisplay == "") {
    echo '
    <div class="dropdown">
      <div class="dropbtn" style="font-family: "Times New Roman", Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Login</a>
      </div>
    </div>';
  }
  else {
    echo '
    <div class="dropdown">
      <div class="dropbtn" style="font-family: "Times New Roman", Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Logout</a>
	    <a style="cursor: pointer;" type="button" id="bttnTwo">Change Password</a>
        <a style="cursor: pointer;" type="button" id="bttnSeven">Delete Account</a>
		<a href="monitoringPage.php">Monitoring</a>
        <a href="viewPreviousInfrastructure.php">All Infrastructure</a>
        <a href="viewSharedInfrastructure.php">Shared Infrastructure</a>
      </div>
    </div>';
  }
  ?>

  <!-- Section One -->
  <heading>Infrastructure As A Service Management Tool</heading>

  <!-- Section Three -->
  <whiteBox>

    <div style="margin-left:15%; margin-right:15%; font-size:20px; padding-top:20px;"><b>Ansible Setup Process:</b></div>
    <div style="margin-left:15%; margin-right:15%; font-size:16px; padding-top:20px;">
		<b>Step 1:</b> Connect to the virtual machine created using Vagrant.<br>
		<br>
		<b>Step 2:</b> Run the command 'sudo apt-add-repository ppa:ansible/ansible'.<br>
		<br>
		<b>Step 3:</b> Run the command 'sudo apt-get update'.<br>
		<br>
		<b>Step 4:</b> Run the command 'sudo apt-get install ansible'.<br> 
		<br>
		<b>Step 5:</b> If the browser has added '.txt' extension to the downloaded file please remove it, the file should be called: 'Playbook.yml'. Move this file onto the virtual machine.<br>
		<br>
		<b>Step 6:</b> Change to the directory where you placed the 'Playbook.yml'.<br>
		<br>
		<b>Step 7:</b> Run the command... <br><i>ansible-playbook -i "localhost," -c local Playbook.yml --tags "<?php $count = 9; 
			if (sizeof($data2) <= 10)
			{
			  print "";
			}
			else
			{
			  while ($count < sizeof($data2)){
				print $data2[$count];
				$count++;
				if ($count != sizeof($data2))
				  print ", ";
			  }
			} 
		?>"</i><br>
	</div>
  </whiteBox>

  <script>

  </script>

</body>
</html>
