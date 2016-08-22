<?
include 'header.php';

$error = ($user_class->energypercent < 25) ? "You need to have at least 25% of your energy if you want to attack someone." : $error;
$error = ($user_class->jail > 0) ? "You can't attack someone if you are in jail." : $error;
$error = ($user_class->hospital > 0) ? "You can't attack someone if you are in the hospital." : $error;
$error = ($_GET['attack'] == "") ? "You didn't choose someone to attack." : $error;
$error = ($_GET['attack'] == $user_class->id) ? "You can't attack yourself." : $error;
$attack_person = new User($_GET['attack']);
$error = ($attack_person->city != $user_class->city) ? "You must be in the same city as the person you are attacking. Duh." : $error;
$error = ($attack_person->username == "") ? "That person doesn't exist." : $error;
$error = ($attack_person->hospital > 0) ? "You can't attack someone that is in the hospital." : $error;
$error = ($attack_person->jail > 0) ? "You can't attack someone that is in jail." : $error;
$error = ($user_class->level > 5 && $attack_person->level < 6) ? "You can't attack someone that is level 5 or below because you are higher than level 5." : $error;

if (isset($error)){
	echo Message($error);
	include 'footer.php';
	die();
}

$yourhp = $user_class->hp;
$theirhp = $attack_person->hp;
?>
<tr><td class="contenthead">Fight House</td></tr>
<tr><td class="contentcontent">You are in a fight with <? echo $attack_person->formattedname ?>.</td></tr>
<tr><td class="contentcontent">
<?
$wait = ($user_class->speed > $attack_person->speed) ? 1 : 0;

while($yourhp > 0 && $theirhp > 0){
	$damage = $attack_person->moddedstrength - $user_class->moddeddefense;
	$damage = ($damage < 1) ? 1 : $damage;

	if($wait == 0){
		$yourhp = $yourhp - $damage;
		echo $attack_person->formattedname . " hit you for " . $damage . " damage using their ".$attack_person->weaponname.". <br>";
	} else {
		$wait = 0;
	}

	if($yourhp > 0) {
		$damage = $user_class->moddedstrength - $attack_person->moddeddefense;
		$damage = ($damage < 1) ? 1 : $damage;
		$theirhp = $theirhp - $damage;
		echo "You hit " . $attack_person->formattedname . " for " . $damage . " damage using your ".$user_class->weaponname.". <br>";
	}

	if($theirhp <= 0){ // attacker won
		 $winner = $user_class->id;
		 $theirhp = 0;
		 $moneywon = floor($attack_person->money /10);
		 $battlewon = 1 + $user_class->battlewon;
		 $battlemoney = $moneywon + $user_class->battlemoney;
		 $expwon = 150 - (25 * ($user_class-> level - $attack_person->level));
		 $expwon = ($expwon < 0) ? 0 : $expwon;
		 $newexp = $expwon + $user_class->exp;
		 $newmoney = $user_class->money + $moneywon;
		 $result = mysql_query("UPDATE `grpgusers` SET `exp` = '".$newexp."', money = '".$newmoney."', `battlewon` = '".$battlewon."', `battlemoney` = '".$battlemoney."' WHERE `id`='".$_SESSION['
		 
		 ']."'");

		 $newmoney = $attack_person->money - $moneywon;
		 $battlelost = $user_class->battlelost + 1;
		 $battlemoney = $user_class->battlemoney - $moneywon;
		 $result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."', `hwho` = '".$user_class->username."', `hhow` = 'wasattacked', `hwhen` = '".date(g.":".i.":".sa,time())."', `hospital` = '1200', `battlelost` = '".$battlelost."', `battlemoney` = '".$battlemoney."' WHERE `id`='".$attack_person->id."'");
		 Send_Event($attack_person->id, "You were hospitalized by ".$user_class->username." for 20 minutes.");
		 echo Message("You hospitalized " . $attack_person->formattedname . ". You gain $expwon exp and stole $".$moneywon." from " . $attack_person->formattedname . ".");

		 //give gang exp
		 if ($user_class->gang != 0) {
			 $gang = New Gang($user_class->gang);
			 $newgangexp = $gang->exp + $expwon;
			 $result = mysql_query("UPDATE `gangs` SET `exp` = '".$newgangexp."' WHERE `id`='".$gang->id."'");
		 }
	}

	if($yourhp <= 0){ // defender won
		 $winner = $attack_person->id;
		 $yourhp = 0;
		 $battlewon = 1 + $attack_person->battlewon;
 		 $moneywon = floor($user_class->money /10);
		 $battlemoney = $moneywon + $attack_person->battlemoney;
		 $expwon = 100 - (25 * ($attack_person-> level - $user_class->level));
		 $expwon = ($expwon < 0) ? 0 : $expwon;
		 $newexp = $expwon + $attack_person->exp;
		 $newmoney = $attack_person->money + $moneywon;
		 $result = mysql_query("UPDATE `grpgusers` SET `exp` = '".$newexp."', money = '".$newmoney."', `battlewon` = '".$battlewon."', `battlemoney` = '".$battlemoney."' WHERE `id`='".$attack_person->id."'");

		 $newmoney = $user_class->money - $moneywon;
		 $battlelost = $user_class->battlelost + 1;
		 $battlemoney = $user_class->battlemoney - $moneywon;
		 $result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."', `hwho` = '".$attack_person->username."', `hhow` = 'attacked', `hwhen` = '".date(g.":".i.":".sa,time())."', `hospital` = '1200', `battlelost` = '".$battlelost."', `battlemoney` = '".$battlemoney."' WHERE `id`='".$user_class->id."'");
		 Send_Event($user_class->id, "You were hospitalized by ".$attack_person->username." for 20 minutes.");
		 echo Message($attack_person->formattedname . " Hospitalized you and stole $".$moneywon." from you.");

		 //give gang exp
		 if ($attack_user->gang != 0) {
			 $gang = New Gang($attack_user->gang);
			 $newgangexp = $gang->exp + $expwon;
			 $result = mysql_query("UPDATE `gangs` SET `exp` = '".$newgangexp."' WHERE `id`='".$gang->id."'");
		 }
	}
}
//put defense log into gang
if ($attack_person->gang != 0) {
	$time = time();
	$result= mysql_query("INSERT INTO `ganglog` (`timestamp`, gangid, attacker, defender, winner)"."VALUES ('".$time."', '".$attack_person->gang."', '".$user_class->id."', '".$attack_person->id."', '".$winner."')");
}
//update users
$newenergy = $user_class->energy - floor($user_class->energy * .10);
$result = mysql_query("UPDATE `grpgusers` SET `hp` = '".$theirhp."' WHERE `id`='".$attack_person->id."'");
$result = mysql_query("UPDATE `grpgusers` SET `hp` = '".$yourhp."', `energy` = '".$newenergy."' WHERE `id`='".$user_class->id."'");
echo "</td></tr>";
include 'footer.php';
?>