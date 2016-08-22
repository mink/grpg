<?
include 'header.php';

$gang_class = new Gang($user_class->gang);

if ($gang_class->leader != $user_class->username){
	echo Message("You do not have authorization to be here.");
	include 'footer.php';
	die();
}

if ($_POST['invite'] != ""){
		$to = $_POST['username'];
		$gang = $user_class->gang;

		$checkuser = mysql_query("SELECT `username` FROM `grpgusers` WHERE `username`='".$to."'");
		$username_exist = mysql_num_rows($checkuser);
		
		$checkuser2 = mysql_query("SELECT `username` FROM `ganginvites` WHERE `username`='".$to."' AND `gangid`='".$gang_class->id."'");
		$username_exist2 = mysql_num_rows($checkuser2);
		
		if ($username_exist2 != 0){
		  echo Message('That user has already been invited.');
		}
		
		if($username_exist > 0 && $username_exist2 == 0){
		  $result= mysql_query("INSERT INTO `ganginvites` (`username`, `gangid`)".
		  "VALUES ('$to', '$gang')");
		 echo Message("$to has been invited.");
		}
		if ($username_exist == 0){
		  echo Message('You entered a non-existant username.');
		}

	}
?>
<tr><td class="contenthead">Invite User To <?= $gang_class->name; ?></td></tr>

			<form method="post">
			<tr><td class="contentcontent">Invite User: <input type='text' name='username' size='15'> <input type='submit' name='invite' value='Invite'></td></tr>
			</form>
<?
include 'footer.php';
?>