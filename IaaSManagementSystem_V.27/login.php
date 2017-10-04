<?php
  session_start();

  $_SESSION[login_info] = array();
  $_SESSION[login_info]['ip_address'] = get_client_ip();
  $_SESSION[login_info]['login_time'] = show_time();
  $_SESSION['loggedin'] = "";
  $_SESSION['sharedInfra'] = false;

	// checks if user is logged in or not
  $loginError = $_SESSION['illegalAccess'];
  $userError = "";

	// changes error message depending on whether the user doesn’t exist or if they attempted to access certain pages without logging in first
  if ($loginError == true) $userError = "You must log in first";
  else $userError = "";

  $_SESSION['illegalAccess'] = false;

  function show_time(){
		return date ("Y-m-d H:i:s", time());
	}

	// get client ip address
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

?>

<html>
<head>

  <link rel="stylesheet" type="text/css" href="css/css.css">

  <title>Login</title>
  <style>

    td, th {  text-align: left;  padding: 8px;}
    a { color: #576C73; text-decoration:none; }

    whiteBox {background-color: white;	position: absolute;	width: 100%;	top: 350px;	height: 560px;	left: 0px;}
    formBox { border: 1px solid #DDDADA; background-color: white; position: absolute; left: 50%; width: 512px; margin-left: -240px; top: 70px; height: auto; padding-bottom: 10px; z-index: 99999999; }
    formBoxError { color: #576C73; position: absolute; left: 50%; width: 200px; margin-left: 40px; top: 305px; height: 30px; z-index: 99999999; text-align: right;}
    formBoxTitle { border: 2px solid #ADD8E6; background-color: #ADD8E6; position: absolute; height: 80px; width: 480px;  padding-left: 15px; padding-right:15px;}

    input {
      -webkit-user-select: text;
      -moz-user-select: text;
      -ms-user-select: text;
      user-select: text;
    }

    input[type=submit]{
      background-color: #ADD8E6;
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
      background-color: #ADD8E6;
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

            var username = document.getElementById("userId").value;
            var submit = document.getElementById("subId").value;
            var neddih = document.getElementById("neddih").value;

            //checks if username and password are blank.
            if (username == '' || submit == '') {
                alert("Fill All Fields");
                return false;
            }
            else if (neddih != '') { // checks if hidden input form is filled in. If it is, it is a good possibility a bot attempted to log in
                alert(“Error”);
                return false;
            }
            else {
                // login can proceed
                return true;
            }
        }

      </script>

</head>

<body>

  <div class="dropdown">
    <div class="dropbtn" style="font-family: 'Times New Roman', Times, serif; font-size:19px;">Menu</div>
    <div class="dropdown-content">
      <a href="viewSharedInfrastructure.php">Shared Infrastructure</a>
    </div>
  </div>

  <heading>Infrastructure As A Service Management Tool</heading>

  <whiteBox>

  <formBox>

    <formBoxTitle style="font-size: 40px; padding-top: 20px; text-align: center;">Login</formBoxTitle>

    <form autocomplete="off"  style="padding-top: 130px; padding-bottom: 10px; text-align: left;" action="checkLogin.php" method="get">

      <?php
      // sessior error array, all login related errors are passed here
			if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
				for($i = 0; $i < count($_SESSION['error']); $i++){
					//show individual errors
					echo '<p style="text-align: center; color: red; font-weight: 700; margin-top:5px;">' . $_SESSION['error'][$i] . '</p>';
				}
			}

			//unset errors afterwards
			unset($_SESSION['error']);

		?>

      <div style="padding-left: 15px; padding-right:15px;">
	<!-- hidden input form only bots will fill out-->
        <input value="" type="hidden" id="neddih" name="neddih">

        Username<br>
        <input type="text" id="userId" name="username" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='username'></div>

        Password<br>
        <input type="password" id="subId" name="submit" style="width: 100%; padding: 12px 20px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box;">
        <div id='submit'></div>

        <div style="margin-top: 10px;">
          Don't have an account? <a href="signup.php">Create an account</a><br>
          Forgotten your password? <a href="getpassword.php">Click here</a><br>
        </div>

      </div><br>
      <buttonBox>
	<!-- resets form or calls checkForm and directs page to checkLogin.php-->
      <input type="reset" value="Reset" class="submitBttn" style="text-align:center;"><input name="s1"  style="text-align:center;" class="submitBttn" type="submit" value="Submit" onclick="return checkForm();"  >
    </buttonBox>
    </form>

	   <!-- display error message -->
    <formBoxError><?=$userError?></formBoxError>
  </formBox>


  </whiteBox>

</body>
</html>
