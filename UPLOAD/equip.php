<?
include 'header.php';

if ($_GET['unequip'] == "weapon" && $user_class->eqweapon != 0){
	Give_Item($user_class->eqweapon, $user_class->id);
	$result = mysql_query("UPDATE `grpgusers` SET `eqweapon` = '0' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have unequipped your weapon.");
	mrefresh("inventory.php");
	include 'footer.php';
	die();
}

if ($_GET['unequip'] == "armor" && $user_class->eqarmor != 0){
	Give_Item($user_class->eqarmor, $user_class->id);
	$result = mysql_query("UPDATE `grpgusers` SET `eqarmor` = '0' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have unequipped your armor.");
	mrefresh("inventory.php");
	include 'footer.php';
	die();
}	

if ($_GET['id'] == ""){
	echo Message("No item picked.");
	include 'footer.php';
	die();
}	

$howmany = Check_Item($_GET['id'], $user_class->id);//check how many they have

$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$_GET['id']."'");
$worked = mysql_fetch_array($result2);

	$error = ($howmany == 0) ? "You don't have any of those." : $error;
	$error = ($worked['level'] > $user_class->level) ? "You aren't high enough level to use this." : $error;
	
	
	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	
Take_Item($_GET['id'], $user_class->id);

if ($_GET['eq'] == "weapon"){
	if($user_class->eqweapon != 0){
		Give_Item($user_class->eqweapon, $user_class->id);
	}
	$result = mysql_query("UPDATE `grpgusers` SET `eqweapon` = '".$_GET['id']."' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have succesfully equipped a weapon.");
	mrefresh("inventory.php");
}
if ($_GET['eq'] == "armor"){
	if($user_class->eqarmor != 0){
		Give_Item($user_class->eqarmor, $user_class->id);
	}
	$result = mysql_query("UPDATE `grpgusers` SET `eqarmor` = '".$_GET['id']."' WHERE `id`='".$_SESSION['id']."'");
	echo Message("You have succesfully equipped armor.");
	mrefresh("inventory.php");
}


include 'footer.php';
?>