<?
include 'header.php';

$attack_person = new User($_GET['mug']);
if ($attack_person->city != $user_class->city){
	echo Message("You must be in the same city as the person you are attacking. Duh.");
	include 'footer.php';
	die();
}

if ($user_class->nerve < 10){
	echo Message("You need to have at least 10 nerve if you want to mug someone.");
	include 'footer.php';
	die();
}

if($user_class->jail > 0){
	echo Message("You can't mug someone if you are in jail.");
	include 'footer.php';
	die();
}

if($user_class->hospital > 0){
	echo Message("You can't mug someone if you are in the hospital.");
	include 'footer.php';
	die();
}

if ($user_class->level > 5 && $attack_person->level < 6){
	echo Message("You can't attack someone that is level 5 or below because you are higher than level 5.");
	include 'footer.php';
	die();
}

if ($_GET['mug'] == ""){
	echo Message("You didn't choose someone to mug.");
	include 'footer.php';
	die();
}

if ($_GET['mug'] == $user_class->id){
	echo Message("You can't mug yourself.");
	include 'footer.php';
	die();
}


if ($attack_person->username == ""){
	echo Message("That person doesn't exist.");
	include 'footer.php';
	die();
}

if ($attack_person->hospital > 0){
	echo Message("You can't mug someone that is in the hospital.");
	include 'footer.php';
	die();
}

if ($attack_person->jail > 0){
	echo Message("You can't mug someone that is in jail.");
	include 'footer.php';
	die();
}

if ($user_class->speed > $attack_person->speed){
	$mugamount = floor($attack_person->money / 4);
	$newmuggedamount = $attack_person->money - $mugamount;
	$newmuggeramount = $user_class->money + $mugamount;
	echo Message("You mugged ".$attack_person->formattedname." for $".$mugamount);
	Send_Event($attack_person->id, "You were mugged by ".$user_class->username.".");
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmuggeramount."' WHERE `id`='".$user_class->id."'");
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmuggedamount."' WHERE `id`='".$attack_person->id."'");
} else {
	echo Message("Their speed is higher than yours, so you failed.");
	Send_Event($attack_person->id, "You were going to be mugged by ".$user_class->username.", but your speed was higher and you saw him coming.");
}
$newnerve = $user_class->nerve - 10;
$result = mysql_query("UPDATE `grpgusers` SET `nerve` = '".$newnerve."' WHERE `id`='".$user_class->id."'");

include 'footer.php';
?>