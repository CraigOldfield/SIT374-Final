<?php
  session_start();

  $emailError = $_SESSION['emailError'];

?>

<html>
<head>

  <link rel="stylesheet" type="text/css" href="css/css.css">

  <title>Login</title>
  <style>

    td, th {  text-align: left;  padding: 8px;}


    whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 560px;	left: 0px;}
    formBox { border: 1px solid lightgrey; background-color: white; position: absolute; left: 50%; width: 512px; margin-left: -240px; top: 70px; height: 400px; z-index: 99999999; }
    formBoxError { color: #576C73; position: absolute; left: 50%; width: 400px; margin-left: -160px; top: 318px; height: 30px; z-index: 99999999; text-align: right;}
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
            // Fetching value from email input field and storing it in a variable.
            var email = document.getElementById("emailId").value;

            //checks if email is blank
            if (email == '') {
                alert("Fill All Fields");
                return false;
            }
            else {
                return true;
            }
        }

      </script>

</head>

<body>

  <heading>Infrastructure As A Service Management Tool</heading>

  <whiteBox>

  <formBox>

    <formBoxTitle style="font-size: 40px; padding-top: 20px; text-align: center;">Get Your Password</formBoxTitle>

    <form autocomplete="off"  style="padding-top: 130px; padding-bottom: 10px; text-align: left;" action="checkEmail.php" method="get">
      <div style="padding-left: 15px; padding-right:15px;">
        <br><br><br>Enter your email<br>
        <input type="text" id="emailId" name="email" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='email'></div>
      </div><br>
      <buttonBox>
	<!-- resets form or calls checkForm and directs page to checkLogin.php-->
      <input name = "s1" class="button" style="width: 100%;" onclick="return checkForm();" type="submit" value="Submit">
    </buttonBox>
    </form>
    <!-- display error message -->
    <formBoxError><?=$emailError?></formBoxError>
  </formBox>


  </whiteBox>

</body>
</html>
