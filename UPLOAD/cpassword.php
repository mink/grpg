<?
include 'header.php';

if (isset($_POST['submit'])) {

  $oldpassword = $_POST["oldpass"];
  $password = $_POST["newpass"];
  $password2 = $_POST["newpassagain"];
  $checkuser = mysql_query("SELECT * FROM `grpgusers` WHERE `password`='$oldpassword' AND `id`='".$user_class->id."'");

  $user_exist = mysql_num_rows($checkuser);

  if($user_exist == 0){
    $message .= "<div>You entered the wrong old password.</div>";
  }
  if(strlen($password) < 4 or strlen($username) > 20){
    $message .= "<div>The password you chose has " . strlen($password) . " characters. You need to have between 4 and 20 characters.</div>";
  }
  if($password != $password2){
    $message .= "<div>Your passwords don't match. Please try again.</div>";
  }

  //insert the values
  if (!isset($message)){
    $result= mysql_query("UPDATE `grpgusers` SET `password`='".$password."' WHERE `id`='".$user_class->id
	."'");
    echo Message('Your password has been changed.');
    
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
Change Password
</td></tr>
<tr><td class="contentcontent">
<form name='login' method='post'>
  <table width='25%' border='0' align='center' cellpadding='0' cellspacing='0'>
  	<tr>
      <td height='28'><font size='2' face='verdana'>Old Password</font></td>
      <td><font size='2' face='verdana'>
        <input type='password' name='oldpass'>
        </font></td>
    </tr>
    <tr>
    <tr>
      <td height='28'><font size='2' face='verdana'>New Password</font></td>
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

      <td>&nbsp;</td>
      <td><font size='2' face='verdana'>
        <input type='submit' name='submit' value='Login'>
        </font></td>
    </tr>
</table>
</form>
<?
include 'footer.php';
?>