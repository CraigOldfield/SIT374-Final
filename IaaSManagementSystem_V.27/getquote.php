<?php
  session_start();
  $userError = $_SESSION['userError'];
  $userDisplay = $_SESSION['loggedin'];

  $_SESSION['sharedInfra'] = true;

  include 'autofilldropdown.php';

  //Checks if user is logged in. If not, they're redirected to login page
  if ($userDisplay == "") {
    header("Location: login.php");
    $_SESSION['illegalAccess'] = true;
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <script type = "text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
    <title>Create An Infrastructure</title>

    <style>
      body {
        background-color: #ADD8E6; margin: 0; overflow: auto;
      }
      createAccountBox {background-color: #DAF0F8;	position: absolute;	width: 100%;	top: 1035px;	height: 50px;	left: 0px;}
      formBox {position: absolute; left: 15%; width: 70%; top: 30px; height: 300px; z-index: 999999;}
      whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 1190px;	left: 0px; z-index: 9999; margin: 0; padding: 0;}
      input[type=number]{ width: 100%;}

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

      .check-box input[type="checkbox"] {
          visibility: hidden;
      }
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

    function checkpackages(){

      var value = document.getElementsByName("service")[0].value;

      if (value == "Software Developer"){

        if(!$('input[name=p2]').is(':checked')){ //python
          $('input[name=p2]').click();
        }
        if(!$('input[name=p4]').is(':checked')){ //git
          $('input[name=p4]').click();
        }
        if(!$('input[name=p5]').is(':checked')){ //php
          $('input[name=p5]').click();
        }
        if(!$('input[name=p14]').is(':checked')){ //ruby
          $('input[name=p14]').click();
        }
        if(!$('input[name=p15]').is(':checked')){ //.net
          $('input[name=p15]').click();
        }
        if(!$('input[name=p16]').is(':checked')){ //iOS
          $('input[name=p16]').click();
        }

        if($('input[name=p1]').is(':checked')){ //r
          $('input[name=p1]').click();
        }
        if($('input[name=p3]').is(':checked')){ //sql server
          $('input[name=p3]').click();
        }
        if($('input[name=p6]').is(':checked')){ //okta
          $('input[name=p6]').click();
        }
        if($('input[name=p7]').is(':checked')){ //Zscaler
          $('input[name=p7]').click();
        }
        if($('input[name=p8]').is(':checked')){ //ClipherCloud
          $('input[name=p8]').click();
        }
        if($('input[name=p9]').is(':checked')){ //iOK SDK
          $('input[name=p9]').click();
        }
        if($('input[name=p10]').is(':checked')){ //Android SDK
          $('input[name=p10]').click();
        }
        if($('input[name=p11]').is(':checked')){ //Xamarin
          $('input[name=p11]').click();
        }
        if($('input[name=p12]').is(':checked')){ //Weka
          $('input[name=p12]').click();
        }
        if($('input[name=p13]').is(':checked')){ //apache drill
          $('input[name=p13]').click();
        }
        if($('input[name=p17]').is(':checked')){ //DocTrackr
          $('input[name=p17]').click();
        }
        if($('input[name=p18]').is(':checked')){ //Centrify
          $('input[name=p18]').click();
        }
        if($('input[name=p19]').is(':checked')){ //Vaultive
          $('input[name=p19]').click();
        }
        if($('input[name=p20]').is(':checked')){ //React Native
          $('input[name=p20]').click();
        }
        if($('input[name=p21]').is(':checked')){ //Unity
          $('input[name=p21]').click();
        }
      }
      else if (value == "Data Science"){

        if(!$('input[name=p1]').is(':checked')){ //r
          $('input[name=p1]').click();
        }
        if(!$('input[name=p2]').is(':checked')){ //python
          $('input[name=p2]').click();
        }
        if(!$('input[name=p3]').is(':checked')){ //sql server
          $('input[name=p3]').click();
        }
        if(!$('input[name=p12]').is(':checked')){ //Weka
          $('input[name=p12]').click();
        }
        if(!$('input[name=p13]').is(':checked')){ //apache drill
          $('input[name=p13]').click();
        }


        if($('input[name=p4]').is(':checked')){ //git
          $('input[name=p4]').click();
        }
        if($('input[name=p5]').is(':checked')){ //php
          $('input[name=p5]').click();
        }
        if($('input[name=p6]').is(':checked')){ //okta
          $('input[name=p6]').click();
        }
        if($('input[name=p7]').is(':checked')){ //Zscaler
          $('input[name=p7]').click();
        }
        if($('input[name=p8]').is(':checked')){ //ClipherCloud
          $('input[name=p8]').click();
        }
        if($('input[name=p9]').is(':checked')){ //iOK SDK
          $('input[name=p9]').click();
        }
        if($('input[name=p10]').is(':checked')){ //Android SDK
          $('input[name=p10]').click();
        }
        if($('input[name=p11]').is(':checked')){ //Xamarin
          $('input[name=p11]').click();
        }
        if($('input[name=p14]').is(':checked')){ //ruby
          $('input[name=p14]').click();
        }
        if($('input[name=p15]').is(':checked')){ //.net
          $('input[name=p15]').click();
        }
        if($('input[name=p16]').is(':checked')){ //iOS
          $('input[name=p16]').click();
        }
        if($('input[name=p17]').is(':checked')){ //DocTrackr
          $('input[name=p17]').click();
        }
        if($('input[name=p18]').is(':checked')){ //Centrify
          $('input[name=p18]').click();
        }
        if($('input[name=p19]').is(':checked')){ //Vaultive
          $('input[name=p1]').click();
        }
        if($('input[name=p20]').is(':checked')){ //React Native
          $('input[name=p20]').click();
        }
        if($('input[name=p21]').is(':checked')){ //Unity
          $('input[name=p21]').click();
        }

      }
      else if (value == "IT Security"){

        if(!$('input[name=p1]').is(':checked')){ //r
          $('input[name=p1]').click();
        }
        if(!$('input[name=p6]').is(':checked')){ //okta
          $('input[name=p6]').click();
        }
        if(!$('input[name=p7]').is(':checked')){ //Zscaler
          $('input[name=p7]').click();
        }
        if(!$('input[name=p8]').is(':checked')){ //ClipherCloud
          $('input[name=p8]').click();
        }
        if(!$('input[name=p17]').is(':checked')){ //DocTrackr
          $('input[name=p17]').click();
        }
        if(!$('input[name=p18]').is(':checked')){ //Centrify
          $('input[name=p18]').click();
        }
        if(!$('input[name=p19]').is(':checked')){ //Vaultive
          $('input[name=p19]').click();
        }


        if($('input[name=p2]').is(':checked')){ //python
          $('input[name=p2]').click();
        }
        if($('input[name=p3]').is(':checked')){ //sql server
          $('input[name=p3]').click();
        }
        if($('input[name=p4]').is(':checked')){ //git
          $('input[name=p4]').click();
        }
        if($('input[name=p5]').is(':checked')){ //php
          $('input[name=p5]').click();
        }
        if($('input[name=p9]').is(':checked')){ //iOK SDK
          $('input[name=p9]').click();
        }
        if($('input[name=p10]').is(':checked')){ //Android SDK
          $('input[name=p10]').click();
        }
        if($('input[name=p11]').is(':checked')){ //Xamarin
          $('input[name=p11]').click();
        }
        if($('input[name=p12]').is(':checked')){ //Weka
          $('input[name=p12]').click();
        }
        if($('input[name=p13]').is(':checked')){ //apache drill
          $('input[name=p13]').click();
        }
        if($('input[name=p14]').is(':checked')){ //ruby
          $('input[name=p14]').click();
        }
        if($('input[name=p15]').is(':checked')){ //.net
          $('input[name=p15]').click();
        }
        if($('input[name=p16]').is(':checked')){ //iOS
          $('input[name=p16]').click();
        }
        if($('input[name=p20]').is(':checked')){ //React Native
          $('input[name=p20]').click();
        }
        if($('input[name=p21]').is(':checked')){ //Unity
          $('input[name=p21]').click();
        }
      }
      else if (value == "Mobile App Developer"){

        if(!$('input[name=p4]').is(':checked')){ //git
          $('input[name=p4]').click();
        }
        if(!$('input[name=p9]').is(':checked')){ //iOK SDK
          $('input[name=p9]').click();
        }
        if(!$('input[name=p10]').is(':checked')){ //Android SDK
          $('input[name=p10]').click();
        }
        if(!$('input[name=p11]').is(':checked')){ //Xamarin
          $('input[name=p11]').click();
        }
        if(!$('input[name=p20]').is(':checked')){ //React Native
          $('input[name=p20]').click();
        }
        if(!$('input[name=p21]').is(':checked')){ //Unity
          $('input[name=p21]').click();
        }

        if($('input[name=p1]').is(':checked')){ //r
          $('input[name=p1]').click();
        }
        if($('input[name=p2]').is(':checked')){ //python
          $('input[name=p2]').click();
        }
        if($('input[name=p3]').is(':checked')){ //sql server
          $('input[name=p3]').click();
        }
        if($('input[name=p5]').is(':checked')){ //php
          $('input[name=p5]').click();
        }
        if($('input[name=p6]').is(':checked')){ //okta
          $('input[name=p6]').click();
        }
        if($('input[name=p7]').is(':checked')){ //Zscaler
          $('input[name=p7]').click();
        }
        if($('input[name=p8]').is(':checked')){ //ClipherCloud
          $('input[name=p8]').click();
        }
        if($('input[name=p12]').is(':checked')){ //Weka
          $('input[name=p12]').click();
        }
        if($('input[name=p13]').is(':checked')){ //apache drill
          $('input[name=p13]').click();
        }
        if($('input[name=p14]').is(':checked')){ //ruby
          $('input[name=p14]').click();
        }
        if($('input[name=p15]').is(':checked')){ //.net
          $('input[name=p15]').click();
        }
        if($('input[name=p16]').is(':checked')){ //iOS
          $('input[name=p16]').click();
        }
        if($('input[name=p17]').is(':checked')){ //DocTrackr
          $('input[name=p17]').click();
        }
        if($('input[name=p18]').is(':checked')){ //Centrify
          $('input[name=p18]').click();
        }
        if($('input[name=p19]').is(':checked')){ //Vaultive
          $('input[name=p19]').click();
        }
      }

    }

      function checkForm() {

        // Fetching values from all input fields and storing them in variables.
        var service = document.getElementById("service").value;
        var ram = document.getElementById("ram").value;
        var vm = document.getElementById("vm").value;
        var cpu = document.getElementById("cpu").value;

        // calculate the cost of the infrastructure inputted
        var cost = 0;

        cost += Number(ram);
        cost += Number(vm);
        cost += Number(cpu);

        //package costs
        if ($('input[name="p1"]').is(':checked'))
          cost += 1;
        if ($('input[name="p2"]').is(':checked'))
          cost += 1;
        if ($('input[name="p3"]').is(':checked'))
          cost += 1;
        if ($('input[name="p4"]').is(':checked'))
          cost += 1;
        if ($('input[name="p5"]').is(':checked'))
          cost += 1;
        if ($('input[name="p6"]').is(':checked'))
          cost += 1;
        if ($('input[name="p7"]').is(':checked'))
          cost += 1;
        if ($('input[name="p8"]').is(':checked'))
          cost += 1;
        if ($('input[name="p9"]').is(':checked'))
          cost += 1;
        if ($('input[name="p10"]').is(':checked'))
          cost += 1;
        if ($('input[name="p11"]').is(':checked'))
          cost += 1;
        if ($('input[name="p12"]').is(':checked'))
          cost += 1;
        if ($('input[name="p13"]').is(':checked'))
          cost += 1;
        if ($('input[name="p14"]').is(':checked'))
          cost += 1;
        if ($('input[name="p15"]').is(':checked'))
          cost += 1;
        if ($('input[name="p16"]').is(':checked'))
          cost += 1;
        if ($('input[name="p17"]').is(':checked'))
          cost += 1;
        if ($('input[name="p18"]').is(':checked'))
          cost += 1;
        if ($('input[name="p19"]').is(':checked'))
          cost += 1;
         ($('input[name="p20"]').is(':checked'))
          cost += 1;
        if ($('input[name="p21"]').is(':checked'))
          cost += 1;

        // Pop up window to ask user if they want to accept
        if (confirm("This Infrastructure will cost $" + cost + ".\nWould you like to create this infrastructure?") == true) {
            document.getElementById("hidden").value = cost;
            return true;
        } else {
            return false;
        }
      }

      $(document).ready(function(){

        $("#bttnTen").click(function(){

          <?php
            $ids = getInfrastructureIDs();
          ?>

          //Gets selected infrastructure to autofill form with
          var selectedInfra = document.getElementsByName("autofilldropdown")[0].value;

          <?php foreach($ids as $key) { ?>
            var key = '<?php echo $key; ?>';
            if (selectedInfra == key) {

              <?php

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
              $sqlTwo = "SELECT * FROM infrastructure WHERE ID = '{$key}'";

              $stmtTwo = oci_parse($connect, $sqlTwo);

              if(!$stmtTwo)  {
                echo "An error occurred in parsing the sql string.\n";
                exit;
              }

              oci_execute($stmtTwo);

              if(oci_fetch_array($stmtTwo))
              {
                $autoService = oci_result($stmtTwo,"SERVICE");

                $autoRAM = oci_result($stmtTwo,"RAM");
                if ($autoRAM == "8"){ $autoRAM = "45"; }
                else if ($autoRAM == "16"){ $autoRAM = "100"; }

                $autoP1 = oci_result($stmtTwo,"PACKAGEONE");
                $autoP2 = oci_result($stmtTwo,"PACKAGETWO");;
                $autoP3 = oci_result($stmtTwo,"PACKAGETHREE");
                $autoP4 = oci_result($stmtTwo,"PACKAGEFOUR");
                $autoP5 = oci_result($stmtTwo,"PACKAGEFIVE");
                $autoP6 = oci_result($stmtTwo,"PACKAGESIX");
                $autoP7 = oci_result($stmtTwo,"PACKAGESEVEN");
                $autoP8 = oci_result($stmtTwo,"PACKAGEEIGHT");
                $autoP9 = oci_result($stmtTwo,"PACKAGENINE");
                $autoP10 = oci_result($stmtTwo,"PACKAGETEN");
                $autoP11 = oci_result($stmtTwo,"PACKAGEELEVEN");
                $autoP12 = oci_result($stmtTwo,"PACKAGETWELVE");
                $autoP13 = oci_result($stmtTwo,"PACKAGETHIRTEEN");
                $autoP14 = oci_result($stmtTwo,"PACKAGEFOURTEEN");
                $autoP15 = oci_result($stmtTwo,"PACKAGEFIFTEEN");
                $autoP16 = oci_result($stmtTwo,"PACKAGESIXTEEN");
                $autoP17 = oci_result($stmtTwo,"PACKAGESEVENTEEN");
                $autoP18 = oci_result($stmtTwo,"PACKAGEEIGHTTEEN");
                $autoP19 = oci_result($stmtTwo,"PACKAGENINETEEN");
                $autoP20 = oci_result($stmtTwo,"PACKAGETWENTY");
                $autoP21 = oci_result($stmtTwo,"PACKAGETWENTYONE");

                $autoVM = oci_result($stmtTwo,"VM");
                if ($autoVM == "2"){ $autoVM = "4"; }
                else if ($autoVM == "3"){ $autoVM = "6"; }
                else if ($autoVM == "4"){ $autoVM = "8"; }
                else if ($autoVM == "5"){ $autoVM = "10"; }
                else if ($autoVM == "6"){ $autoVM = "6"; }

                $autoCPU = oci_result($stmtTwo,"CPU");
                if ($autoCPU == "2"){ $autoCPU = "67"; }
                else if ($autoCPU == "4"){ $autoCPU = "103"; }
                else if ($autoCPU == "6"){ $autoCPU = "139"; }

              }
              ?>

              document.getElementById("service").value = '<?php echo $autoService; ?>';
              document.getElementById("ram").value = '<?php echo $autoRAM; ?>';
              document.getElementById("vm").value = '<?php echo $autoVM; ?>';
              document.getElementById("cpu").value = '<?php echo $autoCPU; ?>';

              checkpackages();

            }
          <?php } ?>

          return false;

        });

        $('input[id="check-box"]').wrap('<div class="check-box"><i></i></div>');
        $.fn.toggleCheckbox = function () {
            this.attr('checked', !this.attr('checked'));
        }
        $('.check-box').on('click', function () {
            $(this).find(':checkbox').toggleCheckbox();
            $(this).toggleClass('checkedBox');
        });

      });

    </script>

</head>
<body>

  <!-- Menu -->
    <div class="dropdown" style="margin:8px;">
      <div class="dropbtn" style="font-family: 'Times New Roman', Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Logout</a>
        <a href="monitoringPage.php">Monitoring Page</a>
        <a href="viewPreviousInfrastructure.php">All Infrastructure</a>
        <a href="viewSharedInfrastructure.php">Shared Infrastructure</a>
      </div>
    </div>

  <heading>Infrastructure As A Service Management Tool</heading>
  <welcome>Welcome <?= $userDisplay ?></welcome>

  <whiteBox>

    <formBox>

      <div style="font-size: 35px; padding-top: 20px;">Create An Infrastructure</div>

      <?php
        $ids = getInfrastructureIDs();

        if ($autoService != null) {
          echo '
          <form method="get" style="padding-top: 15px;">
            <input type="text" hidden="true" id="autofillHidden" name="autofillHidden">
              <br>Auto fill form using previous infrastructure:<br><br>
              <select name="autofilldropdown" id="autofill" class="inputFormAppearance" style="width:280px; padding-left:5px;">';
                foreach ($ids as $i) {
                  echo '<option value="'.$i.'">ID: '.$i.'</option>';
                }
                echo '
              </select>
            <input type="submit" class="submitBttn" value="Submit" id="bttnTen" style="width:99px; height:25px; padding:0px 20px;">
          </form>';
        }

      ?>

      <form method='get' name="config" id="config" action="inputInfrastructure.php">
        <table>
          <tr>
            <td>
              <p>Select Service Type:</p>
              <select name="service" id="service" style="padding-left:5px;">
                <option value="No Service Selected">No Service Selected</option>
                <option value="Data Science">Data Science</option>
                <option value="Software Developer">Software Developer</option>
                <option value="IT Security">IT Security</option>
                <option value="Mobile App Developer">Mobile App Developer</option>
              </select><br><br>
              <input type="button" class="submitBttn" value='Submit' onclick="checkpackages()">
            </td>
          </tr>
          <tr>
              <td>
                <p>Adjust amount of Allocated RAM:<p>
                <select name="ram" id="ram" style="padding-left:5px;">
                  <option value="45">8GB</option>
                  <option value="100" selected>16GB</option>
                </select>
              </td>
          </tr>
          <tr>
            <td>
              <table>
                <input type="text" id="hidden" name="hidden" hidden="true">
                <p>Select Software Packages</p>
                <tr>

                  <td>
                    <input type="checkbox" id="check-box" name="p1" value="R" ><label>R</label><br>
                    <input type="checkbox" id="check-box" name="p2" value="Python" ><label>Python</label><br>
                    <input type="checkbox" id="check-box" name="p3" value="SQL Server" ><label>SQL Server</label><br>
                    <input type="checkbox" id="check-box" name="p4" value="git" ><label>git</label><br>
                    <input type="checkbox" id="check-box" name="p5" value="PHP" ><label>PHP</label><br>
                    <input type="checkbox" id="check-box" name="p6" value="Okta"><label>Okta</label><br>
                    <input type="checkbox" id="check-box" name="p7" value="Zscaler"><label>Zscaler</label><br>
                    <input type="checkbox" id="check-box" name="p8" value="ClipherCloud"><label>ClipherCloud</label><br>
                    <input type="checkbox" id="check-box" name="p9" value="IOS SDK"><label>IOS SDK</label><br>
                    <input type="checkbox" id="check-box" name="p10" value="Android SDK"><label>Android SDK</label><br>
                    <input type="checkbox" id="check-box" name="p11" value="Xamarin"><label>Xamarin</label><br>
                  </td>
                  <td>
                    <input type="checkbox" id="check-box" name="p12" value="Weka"><label>Weka</label><br>
                    <input type="checkbox" id="check-box" name="p13" value="Apache Drill"><label>Apache Drill</label><br>
                    <input type="checkbox" id="check-box" name="p14" value="Ruby"><label>Ruby</label><br>
                    <input type="checkbox" id="check-box" name="p15" value=".NET"><label>.NET</label><br>
                    <input type="checkbox" id="check-box" name="p16" value="IOS"><label>IOS</label><br>
                    <input type="checkbox" id="check-box" name="p17" value="DocTrackr"><label>DocTrackr</label><br>
                    <input type="checkbox" id="check-box" name="p18" value="Centrify"><label>Centrify</label><br>
                    <input type="checkbox" id="check-box" name="p19" value="Vaultive"><label>Vaultive</label><br>
                    <input type="checkbox" id="check-box" name="p20" value="React Native"><label>React Native</label><br>
                    <input type="checkbox" id="check-box" name="p21" value="Unity"><label>Unity</label><br>
                <br></td>

              </tr>

        </table>
      </td>
          </tr>
          <tr>
              <td>
                <p>Adjust No of Virtual Machines:<p>
                <select name="vm" id="vm" style="padding-left:5px;">
				  <option value="2" selected>1</option>
                  <option value="4" selected>2</option>
                  <option value="6">3</option>
                  <option value="8">4</option>
                  <option value="10">5</option>
                  <option value="12">6</option>
                </select>
              </td>
          </tr>
          <tr>
              <td>
                <p>CPU:<p>
                <select name="cpu" id="cpu" style="padding-left:5px;">
                  <option value="67">2</option>
                  <option value="103" selected>4</option>
                  <option value="139">6</option>
                </select>
              </td>
          </tr>
        </table>
        <input id="submitIt" class="submitBttn" type="submit" value='Submit' onclick="return checkForm();">
      </form>

    </formBox>

  </whiteBox>

  <createAccountBox></createAccountBox>

<script>
</script>
</body>
</html>
