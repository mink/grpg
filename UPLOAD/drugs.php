<?php

include 'header.php';

if ($_GET['use'] == "cocaine") {

$checkeffects = mysql_query("SELECT * FROM `effects` WHERE `userid`='$user_class->id'");

$numeffects = mysql_num_rows($checkeffects);

	$error = ($numeffects > 0) ? "You already have an effect!" : $error;

	$error = ($user_class->cocaine == 0) ? "You do not have any cocaine." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}

	

	$newamount = $user_class->cocaine - 1;

	$newsql = mysql_query("UPDATE `grpgusers` SET `cocaine` = '".$newamount."' WHERE `id`= '".$user_class->id."'");

	echo Message("You snorted some cocaine.");

  $result= mysql_query("INSERT INTO `effects` (`userid`, `effect`, `timeleft`)".

  "VALUES ('".$user_class->id."', 'Cocaine', '15')");

}

if ($_GET['use'] == "genericsteroids") {

$checkeffects = mysql_query("SELECT * FROM `effects` WHERE `userid`='$user_class->id'");

$numeffects = mysql_num_rows($checkeffects);

	$error = ($numeffects > 0) ? "You already have an effect!" : $error;

	$error = ($user_class->genericsteroids == 0) ? "You do not have any Steroids." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}

	

	$newamount = $user_class->genericsteroids - 1;

	$newsql = mysql_query("UPDATE `grpgusers` SET `genericsteroids` = '".$newamount."' WHERE `id`= '".$user_class->id."'");

	echo Message("You popped some Steroids.");

  $result= mysql_query("INSERT INTO `effects` (`userid`, `effect`, `timeleft`)".

  "VALUES ('".$user_class->id."', 'Generic Steroids', '15')");

}

if ($_GET['use'] == "nodoze") {

	$error = ($user_class->nodoze == 0) ? "You do not have any No-Doze." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}

	

	$newamount = $user_class->nodoze - 1;

	$newawake = $user_class->awake + 50;

	$newawake = ($newawake > $user_class->maxawake) ? $user_class->maxawake : $newawake;

	$newsql = mysql_query("UPDATE `grpgusers` SET `nodoze` = '".$newamount."', `awake` = '".$newawake."' WHERE `id`= '".$user_class->id."'");

	echo Message("You popped some No-Doze.");

}



include 'footer.php';

?>