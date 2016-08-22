<?
include 'header.php';

$result = mysql_query("SELECT * FROM `cities` WHERE `id`='".$user_class->city."'");
$worked = mysql_fetch_array($result);

if ($_POST['buyland']){
    $price = $worked['landprice'];
	$amount = $worked['landleft'];
 	$totalcost = $price * $_POST['amount'];
 	$newlandtotal = $amount - $_POST['amount'];
 	$currentland = Check_Land($user_class->city, $user_class->id);

	$error = ($_POST['amount'] > $amount) ? "There is not that much land available." : $error;
	$error = ($_POST['amount'] < 1) ? "Please enter a valid amount of land." : $error;
	$error = ($totalcost > $user_class->money) ? "You don't have enough money." : $error;

	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	
	echo Message("You have bought ".$_POST['amount']." acres of land in ".$user_class->cityname." for $".$totalcost);
	Give_Land($user_class->city, $user_class->id, $_POST['amount']);
	
	$newmoney = $user_class->money - $totalcost;
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");
	$user_class = new User($_SESSION['id']);
	
	$result = mysql_query("UPDATE `cities` SET `landleft` = '".$newlandtotal."' WHERE `id`='".$user_class->city."'");
}

$result = mysql_query("SELECT * FROM `cities` WHERE `id`='".$user_class->city."'");
$worked = mysql_fetch_array($result);
?>
<tr><td class="contenthead">Real Estate Agency Of Generica</td></tr>
<tr><td class="contentcontent">
Welcome to REAG! If we have any land left available, you can purchase it from here.
</td></tr>
<tr><td class="contentcontent">
Land available from REAG in <?= $user_class->cityname ?>: <?= $worked['landleft'] ?> acres
<?
if($worked['landleft'] != 0){
	echo "<form method='post'><input type='text' name='amount' size='3' maxlength='20' value='".$worked['landleft']."'> <input type='submit' name='buyland' value='Buy Land At $".$worked['landprice']." Per Acre'></post>";
}
?>
</td></tr>
<?
include 'footer.php';
?>