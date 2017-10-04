<?php
session_start();

// gets email.
$email = $_GET['email'];

// connects to database (replace $dbuser and $dbpass with your own database username and password)
$dbuser = "dgbr";
$dbpass = "ilovecows";
$db = "SSID";
$connect = oci_connect($dbuser, $dbpass, $db);

if (!$connect) {
    echo "An error occurred connecting to the database";
    exit;
}

// selects the password and username of the user with this email
$sql = "SELECT username, submit FROM users WHERE email = '$email'";

$stmt = oci_parse($connect, $sql);

if(!$stmt)  {
  echo "An error occurred in parsing the sql string.\n";
  exit;
}

oci_execute($stmt);

// if a user already exists with a email, stores the username and password in sessions
if (oci_fetch_array($stmt))
{
    $username = oci_result($stmt,"USERNAME");
    $submit = oci_result($stmt,"SUBMIT");

    $_SESSION['username'] = $username;
    $_SESSION['submit'] = $submit;

    //Gets the time the email is sent
    $_SESSION['submitTime'] = date("His");

    // Send email to inputted email
    $from = 'donotreply@IaaSManagementTool.com.au';
    $to      = $email;
    $subject = 'Forgot your password? || IaaS Management Tool';
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: IaaS Management Tool <$from>\r\n";

    $msg = '
    <html>
    <head>
    </head>

    <body>

    <p>Your password can now be reset.</p>

    <a href="http://www.deakin.edu.au/~dgbr/SIT374_Sprint2_Team10/changePassword.php">Click here to change your password</a>

    <div>
    Please do not respond to this email.
    </div>

    <br>Regards, <br>

    IaaS Management Tool.

    </body>
    </html>
    ';

    mail($to, $subject, $msg, $headers) or die ("mail error");

    // Directs page to sent email
    header('location: sentEmail.php');
    exit;
}

else
{ //if the user does not exist, the users details are stored in the db and sent to login.php
    $_SESSION['emailError'] = "An account using this email does not exist";
    header('location: getpassword.php');
}
oci_close($stmt);
?>
