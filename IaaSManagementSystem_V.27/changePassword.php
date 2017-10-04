<?php
  session_start();
  $username = $_SESSION['username'];
  $submit = $_SESSION['submit'];

//Checks if session has expired. If it has, the user will have to send a new email to reset their password.
  if ($username == "" || $submit == ""){
    header("Location: login.php");
  }

?>

<!--
  This page will allow users to change their password after they've forgotten it.
  The user can only do this if sessions has expired
-->

<html>
<head>

  <link rel="stylesheet" type="text/css" href="css/css.css">

  <title>Login</title>
  <style>

    td, th {  text-align: left;  padding: 8px;}

    whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 560px;	left: 0px;}
    formBox { border: 1px solid lightgrey; background-color: white; position: absolute; left: 50%; width: 512px; margin-left: -240px; top: 70px; height: 400px; z-index: 99999999; }
    formBoxError { color: #576C73; position: absolute; left: 50%; width: 200px; margin-left: 40px; top: 318px; height: 30px; z-index: 99999999; text-align: right;}
    formBoxTitle { border: 2px solid lightgrey; background-color: lightgrey; position: absolute; height: 80px; width: 480px;  padding-left: 15px; padding-right:15px;}

    a {
      color: #576C73;
      text-decoration:none;
    }

    input {
      -webkit-user-select: text;
      -moz-user-select: text;
      -ms-user-select: text;
      user-select: text;
    }

    input[type=submit]{
      background-color: lightgrey;
      width: 50%;
      height: 43px;
      white-space: normal;
      display: inline-block;
      border: 0px solid #ccc;
      border-top: 0.5px solid white;
      border-left: 0.5px solid white;
      box-sizing: border-box;
      right:0px;
    }

    input[type=reset]{
      background-color: lightgrey;
      width: 50%;
      height: 43px;
      white-space: normal;
      display: inline-block;
      border: 0px solid #ccc;
      border-top: 0.5px solid white;
      border-right: 0.5px solid white;
      box-sizing: border-box;
    }

  </style>


  <script>

      function checkForm() {

            // Fetching values from all input fields and storing them in variables.
            var submitOne = document.getElementById("subOneId").value;
            var submitTwo = document.getElementById("subTwoId").value;

            // used to compare to user inputs to check if it contains whitespace
            var whiteSpace = /\s/;

            //Checks if input is blank
            if (submitOne == '' || submitTwo == '') {
                alert("Fill All Fields");
                return false;
            } //checks if boths inputs are the same
            else if (submitOne != submitTwo) {
                alert("Passwords must match");
                return false;
            }
            else {
              if (whiteSpace.test(submitOne)){ // checks if submitOne or submitTwo contain white space
                  alert("There must not be any spaces in your input e.g.\nCorrect: JohnSmith\nIncorrect: John Smith");
                  return false;
              }
              else if (submitOne.length < 7){ // checks if submitOne is less than 7 chars
                  alert("submit must be more than 7 characters e.g.\nCorrect: JohnSmith11\nIncorrect: JohnSmith");
                  return false;
              }
              else if(!submitOne.match(/[a-z]/g))  { // checks if submitOne doesn’t contain a lower case letter
                  alert("Password must include a lower case letter and a upper case letter e.g.\nCorrect: JohnSmith11\nIncorrect: JOHNSMITH11");
                  return false;
              }
              else if(!submitOne.match(/[A-Z]/g))  { // checks if submitOne doesn’t include a upper case letter
                  alert("Password must include a lower case letter and a upper case letter e.g.\nCorrect: JohnSmith11\nIncorrect: JOHNSMITH11");
                  return false;
              }
              else { //if passwords are of the correct format, returns true
                  return true;
              }
            }
        }

      </script>

</head>

<body>
  <heading>Infrastructure As A Service Management Tool</heading>
  <whiteBox>
    <formBox>
      <formBoxTitle style="font-size: 40px; padding-top: 20px; text-align: center;">Change Password</formBoxTitle>
      <form autocomplete="off"  style="padding-top: 130px; padding-bottom: 10px; text-align: left;" action="updatePassword.php" method="get">
        <div style="padding-left: 15px; padding-right:15px;">
          New Password<br>
          <input type="text" id="subOneId" name="submitOne" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
          Re-enter New Password<br>
          <input type="password" id="subTwoId" name="submitTwo" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        </div><br>
        <buttonBox>
    	    <!-- resets form or calls checkForm and directs page to updatePassword.php (see form action)-->
          <input name = "s1" style="width:100%" class="button" onclick="return checkForm();" type="submit" value="Submit">
        </buttonBox>
      </form>

    </formBox>

  </whiteBox>

</body>
</html>
