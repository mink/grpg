<?
include 'header.php';

if ($_GET['harvest']){
	$result = mysql_query("SELECT * FROM `growing` WHERE `id`='".$_GET['harvest']."'");
	$worked = mysql_fetch_array($result);
	
	$error = ($user_class->id != $worked['userid']) ? "You are not the owner of this crop." : $error;
	$error = ($worked['timedone'] > time()) ? "This crop isn't finished growing yet." : $error;

	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	
	$newpot = $user_class->marijuana + $worked['cropamount'];
	$result = mysql_query("UPDATE `grpgusers` SET `marijuana` = '".$newpot."' WHERE `id`='".$user_class->id."'");
	Give_Land($worked['cityid'], $worked['userid'], $worked['amount']);
	$user_class = new User($_SESSION['id']);
	$result2= mysql_query("DELETE FROM `growing` WHERE `id`='".$_GET['harvest']."'");
	echo Message("You have received ".$worked['cropamount']." ounces of marijuana.");
}

if ($_POST['plant']){
	$result = mysql_query("SELECT * FROM `land` WHERE `city`='".$user_class->city."' AND `userid`='".$user_class->id."'");
	$worked = mysql_fetch_array($result);
	
 	$newlandtotal = $worked['amount'] - $_POST['amount'];
 	$currentland = Check_Land($user_class->city, $user_class->id);

	$error = ($_POST['amount'] > $worked['amount']) ? "You do not have that many acres of land." : $error;
	$error = ($_POST['amount'] < 1) ? "Please enter a valid amount of land." : $error;
	$error = (($_POST['amount'] * 100) > $user_class->potseeds) ? "You don't have enough marijuana seeds to plant that many acres of weed. You need 100 seeds per acre." : $error;

	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}

$result= mysql_query("INSERT INTO `growing` (`userid`, `cityid`, `amount`, `croptype`, `cropamount`, `timeplanted`, `timedone`)"."VALUES ('".$user_class->id."', '".$user_class->city."', '".$_POST['amount']."', 'pot', '".($_POST['amount'] * 100)."', ".time().", '".(time() + 604800)."')");
	
	$newland = $worked['amount'] - $_POST['amount'];
	$newpotseeds = $user_class->potseeds - ($_POST['amount'] * 100);
	$result = mysql_query("UPDATE `grpgusers` SET `potseeds` = '".$newpotseeds."' WHERE `id`='".$user_class->id."'");
	Take_Land($user_class->city, $user_class->id, $_POST['amount']);
	$user_class = new User($_SESSION['id']);
	echo Message("You have planted ".$_POST['amount']." acres of marijuana.");
}
?>
<tr><td class="contenthead">Manage Land</td></tr>
<tr><td class="contentcontent">
Here is where you can manage your acres of land.
</td></tr>
<?
$result = mysql_query("SELECT * FROM `land` WHERE `city`='".$user_class->city."' AND `userid`='".$user_class->id."'");
$worked = mysql_fetch_array($result);

echo '<tr><td class="contenthead">Plant</td></tr>';
echo '<tr><td class="contentcontent">';
if ($worked['amount'] > 0){
	echo 'You have '.$worked['amount'].' acres of land in '.$user_class->cityname.' and '.$user_class->potseeds.' marijuana seeds, which is enough to grow '.floor($user_class->potseeds / 100).' acres of weed.';
?>

<form method='post'><input type='text' name='amount' size='3' maxlength='20'> Acres <input type='submit' name='plant' value='Plant Pot Seeds'></post>
<?
} else {
	echo "You have no land in this city that can be planted on.";
}
echo '</td></tr>';

$result = mysql_query("SELECT * FROM `growing` WHERE `cityid`='".$user_class->city."' AND `userid`='".$user_class->id."'");
$worked = mysql_fetch_array($result);

echo '<tr><td class="contenthead">Currently Growing</td></tr>';
echo '<tr><td class="contentcontent">';
if ($worked['amount'] > 0){
	echo "<table width ='100%'><tr><td><b>ID</b></td><td><b>Crop Type</b></td><td><b>Acres Planted</b></td><td><b>Total Plants Left (on all acres)</b></td><td><b>Time Left Until Harvest</b></td></tr>";
	$result = mysql_query("SELECT * FROM `growing` WHERE `cityid`='".$user_class->city."' AND `userid`='".$user_class->id."'");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$howlong = ($line['timedone'] < time()) ? 'Ready! <a href="fields.php?harvest='.$line['id'].'">Harvest Now</a>' : howlongtil($line['timedone']);
		echo "<tr><td>".$line['id']."</td><td>".$line['croptype']."</td><td>".$line['amount']."</td><td>".$line['cropamount']."</td><td>".$howlong."</td></tr>";
	}
	echo '</table>';
} else {
	echo "You do not currently have any land with crops growing on it.";
}
echo '</td></tr>';
include 'footer.php';
?>