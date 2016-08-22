<?
include 'nliheader.php';

if (isset($_POST['submit'])) {

  $username = strip_tags($_POST["newname"]);
  $signuptime = time();
  $password = $_POST["newpass"];
  $password2 = $_POST["newpassagain"];
  $email = $_POST["email"];
  $checkuser = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='$username'");

  $username_exist = mysql_num_rows($checkuser);

  if($username_exist > 0){
    $message .= "<div>I'm sorry but the username you chose has already been taken.  Please pick another one.</div>";
  }
  if(strlen($username) < 4 or strlen($username) > 20){
    $message .= "<div>The username you chose has " . strlen($username) . " characters. You need to have between 4 and 20 characters.</div>";
  }
  if(strlen($password) < 4 or strlen($username) > 20){
    $message .= "<div>The password you chose has " . strlen($password) . " characters. You need to have between 4 and 20 characters.</div>";
  }
  if($password != $password2){
    $message .= "<div>Your passwords don't match. Please try again.</div>";
  }
  if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
    $message .= "<div>The e-mail address you entered was invalid.</div>";
  }

  //insert the values
  if (!isset($message)){
    $result= mysql_query("INSERT INTO `grpgusers` (ip, username, password, email, signuptime, lastactive)".
    "VALUES ('".$_SERVER['REMOTE_ADDR']."', '$username', '$password', '$email', '$signuptime', '$signuptime')");
    echo Message('Your account has been created successfully! Redirecting to login page in 5 seconds. <meta http-equiv="refresh" content="5;url=login.php">');
	
	if ($_POST['referer'] != ""){
	$result= mysql_query("INSERT INTO `referrals` (`when`, `referrer`, `referred`)".
    "VALUES ('$signuptime', '".$_POST['referer']."', '".$username."')");
	}
    
	die();
  }
}
?>
<?
if (isset($message)) {
echo Message($message);
}
?>
<tr><td class="contenthead">
.: Register
</td></tr>
<tr><td class="contentcontent">
  <table width='28%' border='0' align='center' cellpadding='0' cellspacing='0'>
<form name='register' method='post' action='register.php'>
    <tr>
      <td height='26'><font size='2' face='verdana'>Username</font></td>
      <td><font size='2' face='verdana'>
        <input type='text' name='newname'>
        </font></td>
    </tr>
    <tr>
      <td height='28'><font size='2' face='verdana'>Password</font></td>
      <td><font size='2' face='verdana'>
        <input type='password' name='newpass'>
        </font></td>
    </tr>
    <tr>
      <td height='28'><font size='2' face='verdana'>Confirm Password</font></td>
      <td><font size='2' face='verdana'>
        <input type='password' name='newpassagain'>
        </font></td>
    </tr>
    <tr>
      <td height='26'><font size='2' face='verdana'>Email address</font></td>
      <td><font size='2' face='verdana'>
        <input type='text' name='email'>
        </font></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><font size='2' face='verdana'>
      <input type='hidden' name='referer' value='<? echo $_GET['referer'] ?>'>
        <input type='submit' name='submit' value='Register'>
        </font></td>
    </tr>
  </table>
  </form>
<br>
<center>
		 &copy; 2007 MyNeoCorp Productions<br>
</center>
  </td></tr>
<?
include 'nlifooter.php';
?>