<?
include 'header.php';

$checkeffects = mysql_query("SELECT * FROM `effects` WHERE `userid`='$user_class->id'");
$numeffects = mysql_num_rows($checkeffects);
if($numeffects > 0){
	echo Message("You can't train at the gym if you have an effect.");
	include 'footer.php';
	die();
}

if($user_class->jail > 0){
	echo Message("You can't train at the gym if you are in jail.");
	include 'footer.php';
	die();
}

if($user_class->hospital > 0){
	echo Message("You can't train at the gym if you are in the hospital.");
	include 'footer.php';
	die();
}

if ($_POST['train'] != "") {

 if ($_POST['energy'] > $user_class->energy){
  echo Message("You don't have that much energy.");
  include "footer.php";
  die();
}

if ($_POST['energy'] < 1){
  echo Message("Please enter a valid amount.");
  include "footer.php";
  die();
}
	if($_POST['type'] == 1){ // strength
		$newstrength = $user_class->strength + floor($_POST['energy'] * ($user_class->awake / 100));
		$result = mysql_query("UPDATE `grpgusers` SET `strength` = '".$newstrength."' WHERE `id` = '".$user_class->id."'");
		echo Message("You trained with ".$_POST['energy']." energy and recieved ".floor($_POST['energy'] * ($user_class->awake / 100))." strength.");
	}elseif($_POST['type'] == 2){ // defense
		$newdefense = $user_class->defense + floor($_POST['energy'] * ($user_class->awake / 100));
		$result = mysql_query("UPDATE `grpgusers` SET `defense` = '".$newdefense."' WHERE `id` = '".$user_class->id."'");
		echo Message("You trained with ".$_POST['energy']." energy and recieved ".floor($_POST['energy'] * ($user_class->awake / 100))." defense.");
	}elseif($_POST['type'] == 3){ // speed
		$newspeed = $user_class->speed + floor($_POST['energy'] * ($user_class->awake / 100));
		$result = mysql_query("UPDATE `grpgusers` SET `speed` = '".$newspeed."' WHERE `id` = '".$user_class->id."'");
		echo Message("You trained with ".$_POST['energy']." energy and recieved ".floor($_POST['energy'] * ($user_class->awake / 100))." speed.");
	}

$newawake = $user_class->awake - (2 * $_POST['energy']);
if ($newawake <0 ){
	$newawake = 0;
}
$newenergy = $user_class->energy - $_POST['energy'];

$result = mysql_query("UPDATE `grpgusers` SET `awake` = '".$newawake."', `energy` = '".$newenergy."' WHERE `id` = '".$user_class->id."'");

$user_class = new User($_SESSION['id']);
}
?>
	<tr><td class="contenthead">Gym</td></tr>
	<form method='post'>
	<tr><td class="contentcontent">
	You can currently train <?php echo $user_class->energy; ?> times.</td></tr>
	<tr><td class="contentcontent">
	<input type='text' name='energy' value='<?php echo $user_class->energy ?>' size='5' maxlength='5'>&nbsp;
	<select name='type'>
		<option value='1'>Strength</option>
		<option value='2'>Defense</option>
		<option value='3'>Speed</option>
	</select>
<input type='submit' name='train' value='Train'><br>
	</form>
	<tr><td class='contenthead'>Attributes</td></tr>
	<tr><td class='contentcontent'>
	<table width='100%'>
	<tr>

		<td width='15%'>Strength:</td>
		<td width='35%'><?php echo $user_class->strength; ?></td>
		<td width='15%'>Defense:</td>
		<td width='35%'><?php echo $user_class->defense; ?></td>
	</tr>

	<tr>
		<td width='15%'>Speed:</td>

		<td width='35%'><?php echo $user_class->speed; ?></td>
		<td width='15%'>Total:</td>
		<td width='35%'><?php echo $user_class->totalattrib; ?></td>
	</tr>
	</table>
	</td></tr>
<?
include 'footer.php';
?>