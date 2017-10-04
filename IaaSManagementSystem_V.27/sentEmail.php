<?php
  session_start();
  $emailError = $_SESSION['emailError'];

  $submitTime = $_SESSION['submitTime']; // Gets the time the session begun
  $_SESSION['currentTime'] = date("His"); // Stores the current time in session

  //Prints current time in variable
  $currentTime = $_SESSION['currentTime'];

  //calculates the finishing time of session to display on screen
  $endOfSession = 1440 - ($currentTime - $submitTime);
  $endOfSession = round($endOfSession/60);
?>

<html>
<head>

  <link rel="stylesheet" type="text/css" href="css/css.css">

  <title>Login</title>
  <style>

    td, th {  text-align: left;  padding: 8px;}

    whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 560px;	left: 0px;}
    formBox { border: 1px solid lightgrey; background-color: white; position: absolute; left: 50%; width: 512px; margin-left: -240px; top: 70px; height: 400px; z-index: 99999999; }
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

</head>

<body>

  <heading>Infrastructure As A Service Management Tool</heading>

  <whiteBox>

  <formBox>

    <formBoxTitle style="font-size: 40px; padding-top: 20px; text-align: center;">Success</formBoxTitle>

    <form autocomplete="off"  style="padding-top: 130px; padding-bottom: 10px; text-align: left;" action="login.php" method="get">
      <div style="text-align: center; padding-top: 45px; font-size: 20px;">Your email was successfully sent.<br>Check your email to change your password.<br>You have <?=$endOfSession?> minutes to change your password<br>before you have to resend the email.</div>
      <buttonBox>
      <!-- directs page to login.php-->
      <input name = "s1" class="button" style="width: 100%;" type="submit" value="Go Back To Login">
      </buttonBox>
    </form>

  </formBox>


  </whiteBox>

</body>
</html>
