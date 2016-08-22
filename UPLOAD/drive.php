<?
include 'header.php';

$result = mysql_query("SELECT * FROM `cars` WHERE `userid`='".$user_class->id."'");
$howmany = mysql_num_rows($result);
if($howmany ==0){
	echo Message("You don't have a car. You can't drive without a car.");
	include 'footer.php';
	die();
}

if ($_GET['go'] != "") {
	$result = mysql_query("SELECT * FROM `cars` WHERE `userid`='".$user_class->id."'");
	$howmany = mysql_num_rows($result);
	
	$error = ($howmany ==0) ? "You don't have a car. You can't drive somewhere without a car." : $error;
	$error = ($user_class->jail > 0) ? "You can't drive somewhere if you are in jail." : $error;
	$error = ($user_class->hospital > 0) ? "You can't drive somewhere if you are in the hospital." : $error;
	$error = ($_GET['go'] == $user_class->city) ? "You are already there." : $error;

	$result = mysql_query("SELECT * FROM `cities` WHERE `id`='".$_GET['go']."'");
    $worked = mysql_fetch_array($result);

	$error = ($worked['name'] == "") ? "That city doesn't exist." : $error;
	$error = ($user_class->level < $worked['levelreq']) ? "You are not a high enough level to go there." : $error;
	$error = ($user_class->money < 50) ? "You can't afford gas." : $error;

	if (!isset($error)){
		$newmoney = $user_class->money - 50;
		$result = mysql_query("UPDATE `grpgusers` SET `city` = '".$_GET['go']."', `money` = '".$newmoney."' WHERE `id` = '".$user_class->id."'");
		$user_class = new User($_SESSION['
		']);
		echo Message("You successfully paid $50 for gas and drove to your destination.");
	} else {
		echo Message($error);
	}

}
?>
	<tr><td class="contenthead">Drive</td></tr>
	<tr><td class="contentcontent">Tired of <?= $user_class->cityname ?>? Pay $50 for gas for your car and you can drive anywhere you want.

	</td></tr>
<?
$result = mysql_query("SELECT * FROM `cities` ORDER BY `levelreq` ASC");
echo '<tr><td class="contentcontent">';
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<div>".$line['name'] . " Lvl Req:".$line['levelreq']." <a href='drive.php?go=".$line['id']."'>Drive</a></div>";
	}
echo '</td></tr>';

include 'footer.php';
?>