<?
include 'nliheader.php';

if(isset($_POST['submit'])){
  $username = $_POST["username"];
  $password = $_POST["password"];


  $result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='$username'") or die ("Name and password not found or not matched");
  $worked = mysql_fetch_array($result);
  $user_class = new User($worked['id']);

  if($worked['password'] == $password){
	if($user_class->rmdays > 0){
		echo '<meta http-equiv="refresh" content="0;url=index.php">';
	} else {
   ?>
   <tr><td class="contenthead">GRPG Is Brought To You By:</td></tr>
   <tr><td class="contentcontent">
	   <center>
	   <script type="text/javascript"><!--
	   google_ad_client = "pub-0905156377500300";
	   google_ad_width = 336;
	   google_ad_height = 280;
	   google_ad_format = "336x280_as";
	   google_ad_type = "image";
	   //2007-04-06: grpg
	   google_ad_channel = "8497905351";
	   //-->
	   </script>
	   <script type="text/javascript"
		 src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
	   </script>
	   <br>
	   <a href="index.php">Continue</a><br>Want to see your ad here? For only $20 a month you could put anything you want on this page! Contact me at myneocorp@gmail.com
	   </center>
	   </td></tr>
   <?
   }
    	$_SESSION["id"] = $worked['id'];
	die();
  } else {
    echo Message('Sorry, your username and password combination are invalid.');
  }
}
?>
<tr><td class="contenthead">
.: Login
</td></tr>
<tr><td class="contentcontent">
<form name='login' method='post' action='login.php'>
  <table width='25%' border='0' align='center' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='35%' height='27'><font size='2' face='verdana'>Username&nbsp;</font></td>
      <td width='65%'><font size='2' face='verdana'>
        <input name='username' type='text' size='22'>
        </font></td>
    </tr>
    <tr>
      <td height='24'><font size='2' face='verdana'>Password&nbsp;</font></td>
      <td><font size='2' face='verdana'>
        <input name='password' type='password' size='22'>

        </font></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><font size='2' face='verdana'>
        <input type='submit' name='submit' value='Login'>
        </font></td>
    </tr>
  </table>
</form>

<br>
<center>
		 &copy; 2007 MyNeoCorp Productions
</center>
</td></tr>

<?
include 'nlifooter.php';
?>