<?php
  session_start();

  include 'autofilldropdown.php';

  $userError = $_SESSION['userError'];
  $userDisplay = $_SESSION['loggedin'];
  $errorNewPassword = $_SESSION['errorNewPassword'];

  $_SESSION['sharedInfra'] = true;

  if ($userDisplay == "") {
    header("Location: login.php");
    $_SESSION['illegalAccess'] = true;
  }

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
  $sqlTwo = "SELECT MAX(ID) FROM infrastructure WHERE USERNAME = '{$userDisplay}'";
  $stmtTwo = oci_parse($connect, $sqlTwo);
  oci_execute($stmtTwo);

  if(oci_fetch_array($stmtTwo)) {
	  $id = oci_result($stmtTwo,"MAX(ID)");
    if ($id != null){
      $current = $id;
    }
    else {
      $current = "";
    }
	}

  $sqlTwo = "SELECT * FROM infrastructure WHERE ID = '{$current}' AND USERNAME = '{$userDisplay}'";
  $stmtThree = oci_parse($connect, $sqlTwo);
  oci_execute($stmtThree);

  if(oci_fetch_array($stmtThree)) {
    //Gets the infrastructure components of the most recent users infrastructure
      $id = oci_result($stmtThree,"ID");
      $cost = oci_result($stmtThree,"COST");
      if ($cost == "") $cost = 0;
      $service = oci_result($stmtThree,"SERVICE");
      $ram = oci_result($stmtThree,"RAM");
      $p1 = oci_result($stmtThree,"PACKAGEONE");
      $p2 = oci_result($stmtThree,"PACKAGETWO");;
      $p3 = oci_result($stmtThree,"PACKAGETHREE");
      $p4 = oci_result($stmtThree,"PACKAGEFOUR");
      $p5 = oci_result($stmtThree,"PACKAGEFIVE");
      $p6 = oci_result($stmtThree,"PACKAGESIX");
      $p7 = oci_result($stmtThree,"PACKAGESEVEN");
      $p8 = oci_result($stmtThree,"PACKAGEEIGHT");
      $p9 = oci_result($stmtThree,"PACKAGENINE");
      $p10 = oci_result($stmtThree,"PACKAGETEN");
      $p11 = oci_result($stmtThree,"PACKAGEELEVEN");
      $p12 = oci_result($stmtThree,"PACKAGETWELVE");
      $p13 = oci_result($stmtThree,"PACKAGETHIRTEEN");
      $p14 = oci_result($stmtThree,"PACKAGEFOURTEEN");
      $p15 = oci_result($stmtThree,"PACKAGEFIFTEEN");
      $p16 = oci_result($stmtThree,"PACKAGESIXTEEN");
      $p17 = oci_result($stmtThree,"PACKAGESEVENTEEN");
      $p18 = oci_result($stmtThree,"PACKAGEEIGHTTEEN");
      $p19 = oci_result($stmtThree,"PACKAGENINETEEN");
      $p20 = oci_result($stmtThree,"PACKAGETWENTY");
      $p21 = oci_result($stmtThree,"PACKAGETWENTYONE");
      //$servers = oci_result($stmtThree,"SERVERS");
      $vm = oci_result($stmtThree,"VM");
      $cpu = oci_result($stmtThree,"CPU");
    }

    //Stores packages in array
    $array = array($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p11, $p12, $p13, $p14, $p15, $p16, $p17, $p18, $p19, $p20, $p21);

    //Removes null packages from array
    foreach($array as $i => $item){
      if ($item === NULL){
        unset($array[$i]);
      }
    }

    //Puts array in one string, separated by a comma
    $output = join(', ', $array);

  oci_close($connect);

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
      var service = document.getElementsByName("service")[0].value;
      var ram = document.getElementsByName("ram")[0].value;
      //var servers = document.getElementsByName("servers")[0].value;
      var vm = document.getElementsByName("vm")[0].value;
      var cpu = document.getElementsByName("cpu")[0].value;
      var p1 = document.getElementsByName("p1")[0].value;
      var p2 = document.getElementsByName("p2")[0].value;
      var p3 = document.getElementsByName("p3")[0].value;
      var p4 = document.getElementsByName("p4")[0].value;
      var p5 = document.getElementsByName("p5")[0].value;
      var p6 = document.getElementsByName("p6")[0].value;
      var p7 = document.getElementsByName("p7")[0].value;
      var p8 = document.getElementsByName("p8")[0].value;
      var p9 = document.getElementsByName("p9")[0].value;
      var p10 = document.getElementsByName("p10")[0].value;
      var p11 = document.getElementsByName("p11")[0].value;
      var p12 = document.getElementsByName("p12")[0].value;
      var p13 = document.getElementsByName("p13")[0].value;
      var p14 = document.getElementsByName("p14")[0].value;
      var p15 = document.getElementsByName("p15")[0].value;
      var p16 = document.getElementsByName("p16")[0].value;
      var p17 = document.getElementsByName("p17")[0].value;
      var p18 = document.getElementsByName("p18")[0].value;
      var p19 = document.getElementsByName("p19")[0].value;
      var p20 = document.getElementsByName("p20")[0].value;
      var p21 = document.getElementsByName("p21")[0].value;

      // calculate the cost of the infrastructure inputted
      var cost = 0;

      cost += Number(ram);
      //cost += Number(servers);
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
      if ($('input[name="p20"]').is(':checked'))
        cost += 1;
      if ($('input[name="p21"]').is(':checked'))
        cost += 1;

      if (confirm("This Infrastructure will cost $" + cost + ".\nAre you sure you would like to update this infrastructure?") == true) {
          document.getElementById("hidden").value = cost;
          return true;
      } else {
          return false;
      }
  }

</script>

  <script type="text/javascript">

    $(document).ready(function(){

    /*
      Custom checkbox and radio button - Jun 18, 2013
      (c) 2013 @ElmahdiMahmoud
      license: https://www.opensource.org/licenses/mit-license.php
    */

    $('input[id="check-box"]').wrap('<div class="check-box"><i></i></div>');
    $.fn.toggleCheckbox = function () {
        this.attr('checked', !this.attr('checked'));
    }
    $('.check-box').on('click', function () {
        $(this).find(':checkbox').toggleCheckbox();
        $(this).toggleClass('checkedBox');
    });

      // Called when 'Change Password' button is pressed
      $("#bttnTwo").click(function(){
        var form = '<form method="get" action="checkNewPassword.php"><changePassword style="padding-top:50px;" id="change"><div style="margin-left:50px;font-size: 20px; padding-top:15px; width:100%;">Change Password</div><br><input type="text" id="user" name="user" value="<?php echo $userDisplay; ?>" hidden="true"><input style="margin-left:50px; width: 300px;" type="password" id="old" name="old" placeholder="Enter old password"><input style="margin-left:50px; width: 300px; margin-top:10px;" type="password" id="new" name="new" placeholder="Enter your new password"><input style="margin-left:50px;width:calc(100% - 100px); margin-top:10px;" type="password" id="newTwo" name="newTwo" placeholder="Re-enter your new password"><input style="margin-top:20px;margin-left:50px;width:calc(100% - 100px);" type="submit" class="submitBttnTwo" value="Submit" id="bttnThree">';
        form += '<input type="button" class="submitBttnThree" value="Exit" id="bttnFour" style="margin-left:50px;width:calc(100% - 100px); margin-top:10px;"><br><br><br></changePassword></form>';
        $("body").append(form);

        // Called when 'Submit' button is pressed
        $("#bttnThree").click(function(){
          var old = document.getElementById("old").value;
          var newOne = document.getElementById("new").value;
          var newTwo = document.getElementById("newTwo").value;
          var user = document.getElementById("user").value;

          if (old == "" || newOne == "" || newTwo == "") {
            alert("All forms must be filled in");
            return false;
          }
          else if (newOne != newTwo) {
            alert("Your new password must match");
            return false;
          }
        });

        // Called when 'Exit' button is pressed
        $("#bttnFour").click(function(){
          $("#change").remove();
        });
      });

      $("#bttnSeven").click(function(){
        $("body").append('<form method="get" action="deleteUser.php"><changePassword style="padding-top:50px;" id="change"><div style="padding-left:50px;padding-right:50px;font-size:20px;padding-top:15px;">Are you sure you would like to delete your account?</div><br><div style="padding-left:50px; padding-right:50px;">Once you delete it, you cannot retrieve your inputted infrastructure.</div><br><input type="text" id="user" name="user" value="<?php echo $userDisplay; ?>" hidden="true"><input style="margin-left:50px; width:calc(100% - 105px);" type="password" id="submit" name="submit" placeholder="Enter your password"><input style="margin-left:50px;width:calc(100% - 100px);margin-top:20px;" type="submit" class="submitBttnTwo" value="Submit" id="bttnEight" style="margin-left:50px;margin-right:50px;width:100%;"><input type="button" class="submitBttnThree" value="Exit" id="bttnNine" style="margin-left:50px;width:calc(100% - 100px);margin-top:10px;"><br><br><br></changePassword></form>');

        // Called when 'Submit' button is pressed
        $("#bttnEight").click(function(){
          var submit = document.getElementById("submit").value;
          var user = document.getElementById("user").value;

          if (submit == "") {
            alert("Your password must be entered to delete your account.");
            return false;
          }

        });

        // Called when 'Exit' button is pressed
        $("#bttnNine").click(function(){
          $("#change").remove();
        });
      });

      // Called when 'Delete Current infrastructure' is pressed
      $("#bttnFive").click(function(){
        if (confirm("Are you sure you would like to delete\nthe current infrastructure?") == true) {
            $("body").load('deleteInfrastructure.php');
        }
        //else -> not deleted
      });

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
              if ($autoCPU == "2"){ $autoCPU = "2"; }
              else if ($autoCPU == "4"){ $autoCPU = "4"; }
              else if ($autoCPU == "6"){ $autoCPU = "6"; }
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

    });

  </script>

</head>

<body>

  <input type="text" hidden="true" id="oldHidden" name="oldHidden">
  <input type="text"  hidden="true" id="newHidden" name="newHidden">

  <!-- Menu -->
    <div class="dropdown">
      <div class="dropbtn" style="font-family: 'Times New Roman', Times, serif; font-size:19px;">Menu</div>
      <div class="dropdown-content">
        <a href="login.php">Logout</a>
	    <a style="cursor: pointer;" type="button" id="bttnTwo">Change Password</a>
        <a style="cursor: pointer;" type="button" id="bttnSeven">Delete Account</a>
        <a href="viewPreviousInfrastructure.php">All Infrastructure</a>
        <a href="viewSharedInfrastructure.php">Shared Infrastructure</a>
      </div>
    </div>

  <!-- Section One -->
  <heading>Infrastructure As A Service Management Tool</heading>
  <welcome>Welcome <?= $userDisplay ?></welcome>

  <!-- Section Three -->
  <whiteBox>

    <tableContainer>

      <tablesContainer>

      <tableContainerOne>

        <?php

        $ids = getInfrastructureIDs();

        if($service != "")
        {
          echo '
          <div style="padding-left:10px; font-size: 20px; padding-top:15px;">Update IaaS Configuration</div>
          <divider style="margin-right:20px; margin-top: 10px; width: 380px;"></divider>

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

        if($service != "")
        {
          // Displays update infrastructure if an infrastructure exists
          echo '
          <form method="get" action="updateInfrastructure.php">
            <table>
              <tr>
                <td>
                  <br>Select Service Type:<br><br>
                  <select name="service" id="service" class="inputFormAppearance" style="width:280px; padding-left:5px;">
                    <option value="No Service Selected">No Service Selected</option>
                    <option value="Data Science">Data Science</option>
                    <option value="Software Developer">Software Developer</option>
                    <option value="IT Security">IT Security</option>
                    <option value="Mobile App Developer">Mobile App Developer</option>
                  </select>
                  <button type="button" class="submitBttn" onclick="checkpackages()" style="width:99px; height:25px; padding:0px 20px;">Submit</button>
                </td>
              </tr>
              <tr>
                  <td>
                    <p style="padding-top:8px;">Adjust amount of Allocated RAM:<p>
                    <select name="ram" id="ram" class="inputFormAppearance" style="padding-left:5px;">
                      <option value="45">8GB</option>
                      <option value="100" selected>16GB</option>
                    </select></div>
                  </td>
              </tr>
              <tr>
                <td>
                  <table>
                    <p >Select Software Packages:</p>
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
                    </td>
                </tr>
            </table>
          </td>
          </tr>
              <tr>
                  <td>
                    <p>Adjust No of Virtual Machines:<p>
                    <select name="vm" id="vm" class="inputFormAppearance" style="padding-left:5px;">
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
                    <select name="cpu" id="cpu" class="inputFormAppearance" style="padding-left:5px;">
                      <option value="2">2</option>
                      <option value="4" selected>4</option>
                      <option value="6">6</option>
                    </select>
                  </td>
              </tr>
            </table>

            <input id="submitIt" class="submitBttn" type="submit" value="Submit" onclick="return checkForm();">';
          }

          ?>

          <input type="text" id="hidden" name="hidden" hidden="true">
        </form>

      </tableContainerOne>

      <tableContainerTwo>

      <!-- General ------------------------------------------------------------------------------------------>

      <div style="padding-left:30px; font-size: 20px;  padding-top:15px;">Current IaaS Configuration</div>

      <divider style="margin-left:20px; margin-top: 10px; width: 380px;"></divider>

      <table style="margin-left:20px; padding-top:5px;" width="380px;">

        <?php

          if($service != ""  && $id != "")
          {
            // Displays current infrastructure if an infrastructure exists
            echo '
            <!--<tr style="background-color: #ebf6f9;">
              <td><div style="padding-left:5px; padding-top:10px;">Owner: </div></td>
              <td><div style="padding-top:10px; text-align: right; width: 150px;">'.$userDisplay.'</div></td>
            </tr>-->
            <tr>
              <td><div style="padding-left:5px; padding-top:10px;">ID: </div></td>
              <td><div style="padding-top:10px; text-align: right; width: 150px;">'.$id.'</div></td>
            </tr>
            <tr style="background-color: #ebf6f9;">
              <td><div style="padding-left:5px; padding-top:10px;">Service Type: </div></td>
              <td><div style="padding-top:10px; padding-right: 5px; text-align: right;  width: 150px;">'.$service.'</div></td>
            </tr>
            <tr>
              <td><div style="padding-left:5px; padding-top:10px;">Cost of infrastructure: </div></td>
              <td><div style="padding-top:10px; padding-right: 5px; text-align: right;  width: 150px;">$'.$cost.' </div></td>
            </tr>
            <tr style="background-color: #ebf6f9;">
              <td><div style="padding-left:5px; padding-top: 10px;">Allocated RAM:</div></td>
              <td><div style="padding-top:10px; padding-right: 5px; text-align: right;  width: 150px;">'.$ram.'GB</div></td>
            </tr>
            <tr>
              <td><div style="padding-left:5px; padding-top: 10px;">No of Virtual Machines:</div></td>
              <td><div style="padding-top:10px; padding-right: 5px; text-align: right;  width: 150px;">'.$vm.' </div></td>
            </tr>
            <tr style="background-color: #ebf6f9;">
              <td><div style="padding-left:5px; padding-top: 10px;">CPU:</div></td>
              <td><div style="padding-top:10px; padding-right: 5px; text-align: right;  width: 150px;">'.$cpu.'</div></td>
            </tr>
            <tr>
              <td><div style="padding-left:5px; padding-top: 10px;">Software Packages:</div></td><br>
              <td></td>
            </tr>
          </table>
          <div id="four" style="margin-left:20px; width:380px;"><div style="padding-left:5px; padding-right:5px; padding-top:5px; padding-bottom: 5px;">'.$output.'</div></div></td><br>
          <input style="margin-left:20px;" type="button" class="submitBttn" value="Delete Current Infrastructure" id="bttnFive"><br><br>
          ';
        }
        else
        {
          // Displays 'No Infrastructure has been created' if an infrastructure doesn't exist
          echo '
          <tr>
            <td><div style="padding-left:30px; padding-top:30px;">No Infrastructure has been created</div></td>
          </tr>
          </table>

          <br>';
        }

        ?>

        <a href="getquote.php"><button style="margin-left:20px;" class="submitBttn" type="submit">Create New Infrastructure</button></a><br><br>

        <br><div style="margin-left:20px;"><?= $errorNewPassword ?><br></div>
        <br>

      <tableContainerTwo>

      <tablesContainer>

    </tableContainer>

  </whiteBox>

  <script>

  </script>

</body>
</html>
