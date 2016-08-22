<?php
include 'nliheader.php';
if ($_POST['submit']){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `email`='".$_POST['email']."'");
	$worked = mysql_fetch_array($result);
	
	if (mysql_num_rows($result) > 0){
		$email_to = $worked['email'];
		$email_subject = "Your Account Info For GRPG";
		$email_body = "This message has been sent to you because you requested your GRPG account info. If you didn't do that, disregard this e-mail. \nUsername:".$worked['username']." Password:".$worked['password'];
		
		if(mail($email_to, $email_subject, $email_body)){
			echo Message("Your username and password have been sent.");
		} else {
			echo Message("Fail.");
		}
	} else {
		echo Message("An account with that e-mail does not exist.");
	}
}
?>
<tr><td class="contenthead">Account Recovery</td></tr>
<tr><td class='contentcontent'>
Enter your e-mail address below, and your username and password will automatically be sent to your inbox. Don't forget to check your junk/bulk/spam folder if it doesn't arrive in your inbox.<br><br>
<form method='post'>
<input type="text" name="email"> <input type="submit" name="submit" value="Send Info">
</form>
</td></tr>
<?
include 'nlifooter.php';
?>