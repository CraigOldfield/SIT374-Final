<?php
// makes error message if user already exists
  $userError = $_GET['createAccount'];

  if ($userError == true) $userError = "User already exists";
  else $userError = "";

?>

<html>
<head>
<!--adds external css and jQuery files to this php file-->
  <script src="js/jquery-2.1.4.min.js"></script>
  <script type = "text/javascript" src="js/jquery-2.1.3.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="smoothness/jquery-ui.min.css">-
  <link rel="stylesheet" type="text/css" href="css/css.css">

  <title>Create An Account</title>
  <style>

    td, th {  text-align: left;  padding: 8px; /*border-bottom: 1px solid lightblue;*/ }
    tr:nth-child(even) { /*border-bottom: 1px solid lightblue;*/}

    a { color: #576C73; text-decoration:none; }

    whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 586px;	left: 0px; z-index: 9999;}
    formBox { border: 1px solid lightgrey; position: absolute; left: 50%; width: 512px; margin-left: -240px; top: 370px; height: 538px; z-index: 99999999; }
    formBoxError { color: red; position: absolute; left: 50%; width: 200px; margin-left: 35px; top: 421px; height: 30px; z-index: 99999999; text-align: right;}
    formBoxTitle { border: 2px solid #ADD8E6; background-color: #ADD8E6; position: absolute; width: 480px;height: 70px; z-index: 99999999; padding-left: 15px; padding-right:15px;}

    /* question button */
    button { background-color: white; padding: 0px 5px; position: absolute; top: 394px; left: 50%; margin-left: 235px;  width:30px; text-align: right; z-index: 9999999999999; }

    input[type=submit]{
      width: 50%;
      padding: 12px 15px;
      margin: 8px 0;
      white-space: normal;
      display: inline-block;
      border-right: 0px solid white;
      border-left: 1px solid white;
      border-top: 1px solid white;
      border-bottom: 0px solid white;
      box-sizing: border-box;
      right:0px;
      background-color: #ADD8E6;
    }

    input[type=reset]{
      width: 50%;
      padding: 12px 15px;
      white-space: normal;
      margin: 8px 0px;
      display: inline-block;
      border-right: 1px solid white;
      border-left: 0px solid white;
      border-top: 1px solid white;
      border-bottom: 0px solid white;
      box-sizing: border-box;
      background-color: #ADD8E6;
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


  <script>

  $(document).ready(function(){

    // Information pop up box on create an account page
    $("#bttnTwo").click(function(){
      // Creates pop up box
      $("body").append('<form method="get" action="checkNewPassword.php" action="checkNewPassword.php"><changePassword style="padding-top:10px;" id="change"><div style="margin-left:30px;font-size: 20px; padding-top:15px; width:300px;">Change Password</div><br><div style="margin-left:30px;font-size: 15px; padding-top:5px; width:340px;">Your username must contain more than 3 characters.<br> Your password must contain an at least one upper case letter, one lower case letter, one number and no white space e.g. JohnSmith1 and Smith8John<br>Your re-typed password must match your password.<br>Your email must be in the correct format e.g. JohnSmith@outlook.com</div><br><input type="button" style="margin-left:30px;margin-bottom:30px;" class="submitBttnThree" value="Exit" id="bttnFour"></changePassword></form>');

      // Close button - removes pop up box
      $("#bttnFour").click(function(){
        $("#change").remove();
      });
    });
  });

  </script>

  <script>

      function checkForm() {
          // Fetching values from all input fields and storing them in variables.

          // Fetching values from all input fields and storing them in variables.
          var username = document.getElementById("userInput").value;
          var submit = document.getElementById("passInput").value;
          var resubmit = document.getElementById("passReInput").value;
          var email = document.getElementById("emailInput").value;
          var neddih = document.getElementById("neddih").value;

	        // compare to email to check if email is in the correct format
          var emailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	        // compare to username or password to check if it contains whitespace
          var whiteSpace = /\s/;

          //Check if input Fields are blank.
          if (username == '' || submit == '' || resubmit == ''|| email == '') {
              alert("Fill All Fields");
              return false;
          }
          else if (neddih != '') { // checks if hidden input form has been filled in
              alert("Error");
              return false;
          }
          else {
            if (whiteSpace.test(username) || whiteSpace.test(submit) || whiteSpace.test(email) ){ // checks if username or password contain white space
                alert("There must not be any spaces in your input e.g.\nCorrect: JohnSmith\nIncorrect: John Smith");
                return false;
            }
            else if (username.length < 3){ //checks if username is longer than 3 chars
                alert("Username must be more than 3 characters e.g.\nCorrect: JohnSmith\nIncorrect: JS");
                return false;
            }
            else if (submit.length < 7){ // checks if password is less than 7 chars
                alert("submit must be more than 7 characters e.g.\nCorrect: JohnSmith11\nIncorrect: JohnSmith");
                return false;
            }
            else if(!submit.match(/[a-z]/g))  { // checks if password doesn’t contain a lower case letter
                alert("Password must include a lower case letter and a upper case letter e.g.\nCorrect: JohnSmith11\nIncorrect: JOHNSMITH11");
                return false;
            }
            else if(!submit.match(/[A-Z]/g))  { // checks if password doesn’t include a upper case letter
                alert("Password must include a lower case letter and a upper case letter e.g.\nCorrect: JohnSmith11\nIncorrect: JOHNSMITH11");
                return false;
            }
            else if (submit != resubmit) { // checks if both passwords are the same
              alert("Passwords must be the same e.g.\nIf your password = SmithJohn, \nyour retyped password = SmithJohn");
              return false;
            }
            else if (!emailFormat.test(email)){ // checks if email format is correct
              alert("Email input is incorrect");
              return false;
            }
            else {
                return true;
            }
          }
        }

      </script>

</head>

<body>

  <heading>Infrastructure As A Service Management Tool</heading>

  <whiteBox></whiteBox>

	<!-- question mark button -->
  <button style=“background-color: pink; border: 1px solid white;” type="button" id="bttnTwo">?</button>

  <formBox>
    <formBoxTitle style="font-size: 35px; padding-top: 20px;text-align: center;">Create an account</formBoxTitle>

    <form autocomplete="off" style="padding-top: 90px; padding-bottom: 10px; text-align: left;" action="checkusers.php">

      <div style="padding:0px 20px;">
	<!-- hidden form -->
        <input value="" type="hidden" id="neddih" name="neddih">

        <br>Username<br>
        <input value="" type="text" id="userInput" name="username" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='user'></div>
        Password<br>
        <input value="" type="password" id="passInput" name="submit" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='pass'></div>
        Re-type Password<br>
        <input value="" type="password" id="passReInput" name="passRe" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='passRe'></div>
        Email<br>
        <input value="" type="text" id="emailInput" name="email" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='email'></div><br>

        Already have an account? <a href="login.php">Log in</a><br>
      </div>

	     <!-- displays error message -->
      <formBoxError><?=$userError?></formBoxError>
      <!-- submits form if username, password and email are entered correctly-->
      <br><input class="button" type="reset" value="Reset"><input class="button" type="submit" value="Submit" onclick="return checkForm();">

    </form>
  </formBox>


</body>
</html>
