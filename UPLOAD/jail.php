<?
include 'header.php';

$jailbreak = $_GET['jailbreak'];
if ($jailbreak != ""){

$jailed_person = new User($jailbreak);
if ($jailed_person->formattedname == ""){
	echo Message("That person does not exist.");
	include 'footer.php';
	die();
}
if ($jailed_person->jail == "0"){
	echo Message("That person is not in jail.");
	include 'footer.php';
	die();
}
	$chance = rand(1,(100 * $crime - ($user_class->speed / 25)));
	$money = 785;
	$exp = 785;
	$nerve = 20;
	if ($user_class->nerve >= $nerve) {
		if($chance <= 75) {
			echo Message("Success! You receive ".$exp." exp and $".$money);
			$exp = $exp + $user_class->exp;
			$crimesucceeded = 1 + $user_class->crimesucceeded;
			$crimemoney = $money + $user_class->crimemoney;
			$money = $money + $user_class->money;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `exp` = '".$exp."', `crimesucceeded` = '".$crimesucceeded."', `crimemoney` = '".$crimemoney."', `money` = '".$money."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
			$result = mysql_query("UPDATE `grpgusers` SET `jail` = '0' WHERE `id`='".$jailed_person->id."'");
			//send even to that person
			Send_Event($jailed_person->id, "You have been busted out of jail by ".$user_class->formattedusername);
		}elseif ($chance >= 150) {
			echo Message("You were caught. You were hauled off to jail for " . 200 . " minutes.");
			$crimefailed = 1 + $user_class->crimefailed;
			$jail = 10800;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `crimefailed` = '".$crimefailed."', `jail` = '".$jail."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
		}else{
			echo Message("You failed.");
			$crimefailed = 1 + $user_class->crimefailed;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `crimefailed` = '".$crimefailed."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
		}
	} else {
		echo Message("You don't have enough nerve for that crime.");
	}
	include 'footer.php';
	die();
}
?>
<tr><td class="contenthead">Jail</td></tr>
<tr><td class="contentcontent">
<table width='100%' cellpadding='4' cellspacing='0'>
	<tr>

		<td>Mobster</td>

		<td>Time Left</td>

		<td>Actions</td>

	</tr>
	<?
$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `jail` DESC");

	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$secondsago = time()-$line['lastactive'];
			$user_jail = new User($line['id']);
			if (floor($user_jail->jail / 60) != 1) {
			$plural = "s";
			 }
			 if($user_jail->jail != 0){
			echo "<tr><td>".$user_jail->formattedname."</td><td>".floor($user_jail->jail / 60)." minute".$plural."</td><td><a href = 'jail.php?jailbreak=".$user_jail->id."'>Break Out</a></td></tr>";
			}
	}
	?>
</table>
</td></tr>
<?
include 'footer.php';
?>