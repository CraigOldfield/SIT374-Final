<?php
  session_start();
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/css.css">
  <title>All Infrastructure</title>
  <script type = "text/javascript" src="js/jquery-2.1.3.min.js"></script>

  <style>
    body { overflow-x: hidden; background-color: white; margin: 0px;}
    td, th {  text-align: left;  padding: 8px;}
    .headingBox {background-color: #ADD8E6; width: 100%; height: 350px; z-index: -99999; }
    .whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height:100%; left: 0px;}
    .scrollBox { position: absolute; width: 92%; padding-left: 4%; overflow-y: auto; overflow-x: hidden; top: 800px; height: 99%; left: 0px; bottom:10px;margin-right: -100px; padding-right: 100px; }
    .sortBttn { width:33%; text-align: center; padding: 7px 20px; background-color: lightblue; border-color: rgba(0,0,0,0.3); text-shadow: 0 1px 0 white; color: black; }

    .check-box input[type="checkbox"] { visibility: hidden; }
    .check-box {
      width: 15px;
      height: 15px;
      cursor: pointer;
      display: inline-block;
      margin: 2px 7px 0 0;
      position: relative;
      overflow: hidden;
      box-shadow: 0 0 1px #ccc;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      background: rgb(255, 255, 255);
      background: -moz-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(47%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(237, 237, 237, 1)));
      background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
      background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
      background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
      background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(237, 237, 237, 1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed', GradientType=0);
      border: 1px solid #ccc;
    }
    .check-box i {
      background: url('http://cdn1.iconfinder.com/data/icons/mimiGlyphs/16/check_mark.png') no-repeat center center;
      position: absolute;
      left: 3px;
      bottom: -15px;
      width: 13px;
      height: 13px;
      opacity: .5;
      -webkit-transition: all 400ms ease-in-out;
      -moz-transition: all 400ms ease-in-out;
      -o-transition: all 400ms ease-in-out;
      transition: all 400ms ease-in-out;
      -webkit-transform:rotateZ(-180deg);
      -moz-transform:rotateZ(-180deg);
      -o-transform:rotateZ(-180deg);
      transform:rotateZ(-180deg);
    }
    .checkedBox {
      -moz-box-shadow: inset 0 0 5px 1px #ccc;
      -webkit-box-shadow: inset 0 0 5px 1px #ccc;
      box-shadow: inset 0 0 5px 1px #ccc;
      border-bottom-color: #fff;
    }
    .checkedBox i {
      bottom: 2px;
      -webkit-transform:rotateZ(0deg);
      -moz-transform:rotateZ(0deg);
      -o-transform:rotateZ(0deg);
      transform:rotateZ(0deg);
    }

  </style>

  <script>

  $(document).ready(function(){

    $('input[id="check-box"]').wrap('<div class="check-box"><i></i></div>');
    $.fn.toggleCheckbox = function () {
        this.attr('checked', !this.attr('checked'));
    }
    $('.check-box').on('click', function () {
        $(this).find(':checkbox').toggleCheckbox();
        $(this).toggleClass('checkedBox');
    });

  });

  //Tick previously selected check boxes and store data in text file if user clicked download button
  function documentLoad(){

    console.log("Document load");

    <?php
      $array = $_SESSION['array'];
      $strArray = '["' . implode('", "', $array) . '"]';
      $_SESSION['downloadFile'] = $strArray;
    ?>

    var strArray = <?php echo $strArray ?>;

    if (localStorage.getItem("selected") != undefined && localStorage.getItem("selected") != "undefined"){
      var index = localStorage.getItem("selected");
      var type = localStorage.getItem("type");

      var splitArray = strArray[index].split("ppp");

      if (type == "vagrant"){
        window.location = 'VagrantFile.php?splitArray=' + splitArray;
      }
      else if (type == "playbook"){
        window.location = 'AnsiblePlaybook.php?splitArray=' + splitArray;
      }
    }

    <?php if ($_SESSION['filter3'] == true){ ?>
      $('input[name=f3]').click();
    <?php } ?>
    <?php if ($_SESSION['filter4'] == true){ ?>
      $('input[name=f4]').click();
    <?php } ?>
    <?php if ($_SESSION['filter5'] == true){ ?>
      $('input[name=f5]').click();
    <?php } ?>
    <?php if ($_SESSION['filter8'] == true){ ?>
      $('input[name=f8]').click();
    <?php } ?>
    <?php if ($_SESSION['filter9'] == true){ ?>
      $('input[name=f9]').click();
    <?php } ?>
    <?php if ($_SESSION['filter10'] == true){ ?>
      $('input[name=f10]').click();
    <?php } ?>

  }

  function sort(type){

    document.getElementById('hidden').value = type;

    if($('input[name=f3]').is(':checked')){
  		document.getElementById('hidden3').value = true;
    }
    if($('input[name=f4]').is(':checked')){
  		document.getElementById('hidden4').value = true;
    }
  	if($('input[name=f5]').is(':checked')){
  		document.getElementById('hidden5').value = true;
    }
  	if($('input[name=f8]').is(':checked')){
  		document.getElementById('hidden8').value = true;
    }
  	if($('input[name=f9]').is(':checked')){
  		document.getElementById('hidden9').value = true;
    }
  	if($('input[name=f10]').is(':checked')){
  		document.getElementById('hidden10').value = true;
    }
  }

  function filter() {
    if($('input[name=f3]').is(':checked')){
  		document.getElementById('hidden3').value = true;
    }
  	if($('input[name=f4]').is(':checked')){
  		document.getElementById('hidden4').value = true;
    }
  	if($('input[name=f5]').is(':checked')){
  		document.getElementById('hidden5').value = true;
    }
  	if($('input[name=f8]').is(':checked')){
  		document.getElementById('hidden8').value = true;
    }
  	if($('input[name=f9]').is(':checked')){
  		document.getElementById('hidden9').value = true;
    }
  	if($('input[name=f10]').is(':checked')){
  		document.getElementById('hidden10').value = true;
    }
  }

  function saveToTextFile(idNumber, type){
    localStorage.setItem("selected", idNumber);
    localStorage.setItem("type", type);
    location.reload();
  }

  </script>

</head>

<body onload="documentLoad()">

  <?php

  if ($_SESSION['sharedInfra'] != true)
  {
    echo '
    <div class="dropdown" style="margin-left:8px; margin-top:8px;">
      <div class="dropbtn" style="font-family: "Times New Roman", Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Login</a>
      </div>
    </div>';
  }
  else
  {
    echo '
    <div class="dropdown" style="margin-left:8px; margin-top:8px;">
      <div class="dropbtn" style="font-family: "Times New Roman", Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Logout</a>
        <a href="monitoringPage.php">Monitoring Page</a>
        <a href="viewPreviousInfrastructure.php">All Infrastructure</a>
      </div>
    </div>';
  }

  ?>

  <div class="headingBox"></div>

  <heading>Infrastructure As A Service Management Tool</heading>

  <div class="whiteBox">

    <div style="padding-left: 4%; padding-right:4%;">
      <p>Sort By:</p>
      <form action="previousInfrastructure.php" method="get">
        <input type="submit" class="sortBttn" onclick="sort('service');" value="Service" style="width:25%; padding-left:0px; padding-right:0px;"><input type="submit" class="sortBttn" onclick="sort('ram');" value="Ram" style="width:25%; padding-left:0px; padding-right:0px;"><input type="submit" class="sortBttn" onclick="sort('vm');" value="VM" style="width:25%; padding-left:0px; padding-right:0px;"><input type="submit" class="sortBttn" onclick="sort('cpu');" value="CPU" style="width:25%; padding-left:0px; padding-right:0px;">
        <input type="hidden" id="hidden" name="hidden" value="">
        <input type="hidden" id="webpage" name="webpage" value="shared">
        <p>Select Fields to View:</p>
        <table>
          <tr>
            <td><input type="checkbox" id="check-box" name="f3" value="Username"><label>Username</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="check-box" name="f4" value="Service"><label>Service</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="check-box" name="f5" value="RAM"><label>RAM</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="check-box" name="f8" value="VM"><label>VM</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="check-box" name="f9" value="CPU"><label>CPU</label></td>
          </tr>
          <tr>
            <td><input type="checkbox" id="check-box" name="f10" value="Packages"><label>Packages</label></td>
          </tr>
          <tr>
            <td><input type="submit" class="submitBttn" onclick="filter()" style="width:25%; text-align:center; padding-left:0px; padding-right:0px;" value="Filter"></td>
          </tr>
        </table>
        <input type="hidden" id="hidden1" name="hidden1" value="">
        <input type="hidden" id="hidden2" name="hidden2" value="">
        <input type="hidden" id="hidden3" name="hidden3" value="">
        <input type="hidden" id="hidden4" name="hidden4" value="">
        <input type="hidden" id="hidden5" name="hidden5" value="">
        <input type="hidden" id="hidden6" name="hidden6" value="">
        <input type="hidden" id="hidden8" name="hidden8" value="">
        <input type="hidden" id="hidden9" name="hidden9" value="">
        <input type="hidden" id="hidden10" name="hidden10" value="">
      </form>
    </div>
  </div>

  <div class="scrollBox">

    <?php

      $dbuser = "dgbr";
      $dbpass = "ilovecows";
      $dbname = "SSID";
      $connect = oci_connect($dbuser, $dbpass, $dbname);

      if (!$connect)
      {
          echo "An error occurred connecting to the database";
          exit;
      }

      $sortValue = $_SESSION['sort'];
      echo $sortValue;

      if ($sortValue == 'service'){
        $sqlTwo = "SELECT * FROM shareinfrastructure ORDER BY SERVICE";
      }
      else if ($sortValue == 'ram'){
        $sqlTwo = "SELECT * FROM shareinfrastructure ORDER BY RAM";
      }
      else if ($sortValue == 'vm'){
        $sqlTwo = "SELECT * FROM shareinfrastructure ORDER BY VM";
      }
      else if ($sortValue == 'cpu'){
        $sqlTwo = "SELECT * FROM shareinfrastructure ORDER BY CPU";
      }
      else {
        $sqlTwo = "SELECT * FROM shareinfrastructure";
      }

      $stmtTwo = oci_parse($connect, $sqlTwo);
      if(!$stmtTwo)
      {
        echo "An error occurred in parsing the sql string.\n";
        exit;
      }
      oci_execute($stmtTwo);

      $idCounter = 0;
      $array = array();

      while(oci_fetch_array($stmtTwo))
      {
        $username = oci_result($stmtTwo,"USERNAME");
        $service = oci_result($stmtTwo,"SERVICE");
        $ram = oci_result($stmtTwo,"RAM");
        $p1 = oci_result($stmtTwo,"PACKAGEONE");
        $p2 = oci_result($stmtTwo,"PACKAGETWO");
        $p3 = oci_result($stmtTwo,"PACKAGETHREE");
        $p4 = oci_result($stmtTwo,"PACKAGEFOUR");
        $p5 = oci_result($stmtTwo,"PACKAGEFIVE");
        $p6 = oci_result($stmtTwo,"PACKAGESIX");
        $p7 = oci_result($stmtTwo,"PACKAGESEVEN");
        $p8 = oci_result($stmtTwo,"PACKAGEEIGHT");
        $p9 = oci_result($stmtTwo,"PACKAGENINE");
        $p10 = oci_result($stmtTwo,"PACKAGETEN");
        $p11 = oci_result($stmtTwo,"PACKAGEELEVEN");
        $p12 = oci_result($stmtTwo,"PACKAGETWELVE");
        $p13 = oci_result($stmtTwo,"PACKAGETHIRTEEN");
        $p14 = oci_result($stmtTwo,"PACKAGEFOURTEEN");
        $p15 = oci_result($stmtTwo,"PACKAGEFIFTEEN");
        $p16 = oci_result($stmtTwo,"PACKAGESIXTEEN");
        $p17 = oci_result($stmtTwo,"PACKAGESEVENTEEN");
        $p18 = oci_result($stmtTwo,"PACKAGEEIGHTTEEN");
        $p19 = oci_result($stmtTwo,"PACKAGENINETEEN");
        $p20 = oci_result($stmtTwo,"PACKAGETWENTY");
        $p21 = oci_result($stmtTwo,"PACKAGETWENTYONE");

        $vm = oci_result($stmtTwo,"VM");
        $cpu = oci_result($stmtTwo,"CPU");

        $packages = array();
        if ($p1 != null){ array_push($packages, $p1.', ');}
        if ($p2 != null){ array_push($packages, $p2.', ');}
        if ($p3 != null){ array_push($packages, $p3.', ');}
        if ($p4 != null){ array_push($packages, $p4.', ');;}
        if ($p5 != null){ array_push($packages, $p5.', ');;}
        if ($p6 != null){ array_push($packages, $p6.', ');;}
        if ($p7 != null){ array_push($packages, $p7.', ');;}
        if ($p8 != null){ array_push($packages, $p8.', ');;}
        if ($p9 != null){ array_push($packages, $p9.', ');;}
        if ($p10 != null){ array_push($packages, $p10.', ');;}
        if ($p11 != null){ array_push($packages, $p11.', ');;}
        if ($p12 != null){ array_push($packages, $p12.', ');;}
        if ($p13 != null){ array_push($packages, $p13.', ');;}
        if ($p14 != null){ array_push($packages, $p14.', ');;}
        if ($p15 != null){ array_push($packages, $p15.', ');;}
        if ($p16 != null){ array_push($packages, $p16.', ');;}
        if ($p17 != null){ array_push($packages, $p17.', ');;}
        if ($p18 != null){ array_push($packages, $p18.', ');;}
        if ($p19 != null){ array_push($packages, $p19.', ');;}
        if ($p20 != null){ array_push($packages, $p20.', ');}
        if ($p21 != null){ array_push($packages, $p21.', ');}

        $printPackages = "";
        foreach ($packages as $i) {
          $printPackages = $printPackages.$i;
        }
        $printPackages = substr(trim($printPackages), 0, -1);

        $tempStr = 'share'.'ppp'.$username.'ppp'.$service.'ppp'.$ram.'pppnullppp'.$vm.'ppp'.$cpu.'ppp'.$printPackages;
        array_push($array, $tempStr);
        $selectedItem = $array[$idCounter];

        $output[] = '<form name="form'.$idCounter.'" method="get">';
        $output[] = '<table style="border-collapse: collapse;">';

        if($_SESSION['filter3'] != ""){
          $output[] = '
          <tr>
            <th style="width:15%;">Username</th>
            <td style="">'.$username.'</td>
          </tr>';
        }
        if($_SESSION['filter4'] != ""){
          $output[] = '
          <tr>
            <th style="width:15%;background-color: #ebf6f9;">Service</th>
            <td style="background-color: #ebf6f9;">'.$service.'</td>
          </tr>';
        }
        if($_SESSION['filter5'] != ""){
          $output[] = '
          <tr>
            <th style="width:15%;">RAM</th>
            <td style="">'.$ram.'GB</td>
          </tr>';
        }
        if($_SESSION['filter8'] != ""){
          $output[] = '
          <tr>
            <th style="width:15%;background-color: #ebf6f9;">VM</th>
            <td style="background-color: #ebf6f9;">'.$vm.'</td>
          </tr>';
        }
        if($_SESSION['filter9'] != ""){
          $output[] = '
          <tr>
            <th style="width:15%;">CPU</th>
            <td style="">'.$cpu.'</td>
          </tr>';
        }
        if($_SESSION['filter10'] != ""){
          if ($printPackages != ""){
            $output[] = '
            <tr>
              <th style="width:15%;background-color: #ebf6f9;">Packages</th>
              <td style="background-color: #ebf6f9;">'.$printPackages.'</td>
            </tr>';
          }
        }

        if ($_SESSION['filter3'] != "" || $_SESSION['filter4'] != "" || $_SESSION['filter5'] != "" || $_SESSION['filter8'] != "" || $_SESSION['filter9'] != "" || $_SESSION['filter10'] != ""){
          $output[] = '
          <tr>
            <td style="width:15%;"></td>
            <td style="text-align: right;">
              Step 1: Vagrant File:<input type="submit" style="text-align:center; width:150px; margin-bottom:5px; margin-left:5px;" class="submitBttn" value="Download" name="download" onclick="saveToTextFile(\''.$idCounter.'\',\''.'vagrant'.'\')"><br>
              Step 2: Ansible:<input type="submit" style="text-align:center; width:150px; margin-bottom:5px; margin-left:5px;" class="submitBttn" value="Download" name="download" onclick="saveToTextFile(\''.$idCounter.'\',\''.'playbook'.'\')"><br>
            </td>
          </tr>
          </table></form><br><hr><br>';
        }
        $idCounter++;

      $_SESSION['array'] = $array;

      if ($output == null){
        return '<p><div style="padding-left:8px; padding-top: 5px; padding-bottom: 5px; font-size: 20px; text-align:center;">You have not created any infrastructure.</div></p>';
      }
      else
      {
        echo join('',$output);
      }

    }
      ?>

  </div>


</body>

</html>
