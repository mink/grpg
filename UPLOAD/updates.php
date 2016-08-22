<?

//Updates

$updates_sql = mysql_query("SELECT * FROM `updates` WHERE `name` = 'trevor'");

while ($line = mysql_fetch_array($updates_sql, MYSQL_ASSOC)) {

	$update = $line['lastdone'];

}

$timesinceupdate = time() - $update;

if ($timesinceupdate>=300) {

	$num_updates = floor($timesinceupdate / 300);

	//stock market stuff
	$result = mysql_query("SELECT * FROM `stocks`");
	while($line = mysql_fetch_assoc($result)) {
		$amount = rand (strlen($line['cost']) * -1, strlen($line['cost']));
		$newamount = $line['cost'] + $amount;
		if ($newamount < 1){
			$newamount = 1;
		}
		$result2 = mysql_query("UPDATE `stocks` SET `cost`='".$newamount."' WHERE `id`='".$line['id']."'");
	}
	//stock market stuff

	$result = mysql_query("SELECT * FROM `grpgusers`");

	while($line = mysql_fetch_assoc($result)) {

		$updates_user = new User($line['id']);

		if ($updates_user->rmdays > 0) {

			$multiplier = 2;

		} else {

			$multiplier = 1;

		}

		$username = $updates_user->username;

		$newawake = $updates_user->awake + (5 * $num_updates) * $multiplier;

		$newawake = ($newawake > $updates_user->maxawake) ? $updates_user->maxawake : $newawake;

		$newhp = $updates_user->hp + (10 * $num_updates) * $multiplier;

		$newhp = ($newhp > $updates_user->maxhp) ? $updates_user->maxhp : $newhp;

		$newenergy = $updates_user->energy + (2 * $num_updates) * $multiplier;

		$newenergy = ($newenergy > $updates_user->maxenergy) ? $updates_user->maxenergy : $newenergy;

		$newnerve = $updates_user->nerve + (2 * $num_updates) * $multiplier;

		$newnerve = ($newnerve > $updates_user->maxnerve) ? $updates_user->maxnerve : $newnerve;

		$result2 = mysql_query("UPDATE `grpgusers` SET `awake` = '".$newawake."', `energy` = '".$newenergy."', `nerve` = '".$newnerve."', `hp` = '".$newhp."' WHERE `username` = '".$username."'");

	}

	//update the timer and db

	$thetime = time();

	$result2 = mysql_query("UPDATE `updates` SET `lastdone` = '".$thetime."' WHERE `name` = 'trevor'");

	$leftovertime = $timesinceupdate - (floor($timesinceupdate / 300) * 300);

	if ($leftovertime>0) {

		$newupdate =  time() - $leftovertime;

		$setleftovertime = mysql_query("UPDATE `updates` SET `lastdone` = '".$newupdate."' WHERE `name` = 'trevor'");

	}

}









$updates_sql = mysql_query("SELECT * FROM `updates` WHERE `name` = 'hospital'");

while ($line = mysql_fetch_array($updates_sql, MYSQL_ASSOC)) {

	$update = $line['lastdone'];

}

$timesinceupdate = time() - $update;

if ($timesinceupdate>=60) {

	$num_updates = floor($timesinceupdate / 60);

	$result = mysql_query("SELECT * FROM `grpgusers`");

	//DO STUFF

	while($line = mysql_fetch_assoc($result)) {

		$result_user = mysql_query("SELECT * FROM `grpgusers` WHERE `id`='".$line['id']."'");

		$updates_user = mysql_fetch_array($result_user);

		

		$newhospital = $updates_user['hospital'] - (60 * $num_updates);

		$newhospital = ($newhospital < 0) ? 0 : $newhospital;

		$newjail = $updates_user['jail'] - (60 * $num_updates);

		$newjail = ($newjail < 0) ? 0 : $newjail;

		$result2 = mysql_query("UPDATE `grpgusers` SET `hospital` = '".$newhospital."', `jail` = '".$newjail."' WHERE `id` = '".$line['id']."'");

	}

	

	$result = mysql_query("SELECT * FROM `effects`");

	while($line = mysql_fetch_assoc($result)) {

		if($line['timeleft'] > 0){

		$newamount = $line['timeleft'] - (1 * $num_updates);

		$result2 = mysql_query("UPDATE `effects` SET `timeleft` = '".$newamount."' WHERE `id` = '".$line['id']."'");

		}

	}

	$result2 = mysql_query("DELETE FROM `effects` WHERE `timeleft` < 1");

	

	//update the timer and db

	$thetime = time();

	$result2 = mysql_query("UPDATE `updates` SET `lastdone` = '".$thetime."' WHERE `name` = 'hospital'");

	$leftovertime = $timesinceupdate - (floor($timesinceupdate / 60) * 60);

	if ($leftovertime>0) {

		$newupdate =  time() - $leftovertime;

		$setleftovertime = mysql_query("UPDATE `updates` SET `lastdone` = '".$newupdate."' WHERE `name` = 'hospital'");

	}

}

?>