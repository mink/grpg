<?
include 'header.php';

if ($_GET['sell'] != "") {
	$gain = $user_class->marijuana * 100;

	$error = ($user_class->rmdays == 0) ? "You must be a Respected Mobster to sell drugs." : $error;
	$error = ($gain == 0) ? "You don't have any." : $error;
	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	$newmoney = $user_class->money + $gain;
	
	$newsql = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."', `marijuana`='0' WHERE `id`= '".$user_class->id."'");
	echo Message("You sold all your weed and got $".$gain);
}

if ($_GET['buy'] != "") {
	$cost = 0;
	$cost = ($_GET['buy'] == "cocaine") ? 5000 : $cost;
	$cost = ($_GET['buy'] == "potseeds") ? 5000 : $cost;
	
	$error = ($user_class->rmdays == 0) ? "You must be a Respected Mobster to buy drugs." : $error;
	$error = ($user_class->money < $cost) ? "You do not have enough money!" : $error;
	$error = ($cost == 0) ? "You didn't pick a real drug." : $error;
	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	$newmoney = $user_class->money - $cost;
	$newsql = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`= '".$user_class->id."'");
	echo Message("You have purchased some ".$_GET['buy'].".");
	
	if($_GET['buy'] == "cocaine"){
		$newamount = $user_class->cocaine + 1;
		$newsql = mysql_query("UPDATE `grpgusers` SET `cocaine` = '".$newamount."' WHERE `id`= '".$user_class->id."'");
	}
	if($_GET['buy'] == "potseeds"){
		$newamount = $user_class->potseeds + 100;
		$newsql = mysql_query("UPDATE `grpgusers` SET `potseeds` = '".$newamount."' WHERE `id`= '".$user_class->id."'");
	}
}

?>

<tr><td class="contenthead">Shady-Looking Stranger</td></tr>

<tr><td class="contentcontent">

<? echo ($user_class->rmdays > 0) ? "Hey there buddy. Want to buy some cocaine? It'll make you faster and help you pull off those bigger crimes! Best of all it will last you 15 minutes! Cocaine is only $5,000, so what are you waiting for? Or perhaps you want to get into the drug dealing business yourself... For $5,000 I will give enough seeds to plant an acre of sweet sticky weed. I will also buy weed at 100 bucks and ounce.<br><br><center><a href='buydrugs.php?buy=cocaine'>Buy Cocaine</a> | <a href='buydrugs.php?buy=potseeds'>Buy Marijuana Seeds</a> | <a href='buydrugs.php?sell=pot'>Sell all Weed</a> | <a href='city.php'>Your a bad man, I'm leaving!</a></center>" : "Hmm... How do I know you won't squeal? You aren't respected enough to buy from me. Come back when you are a respected mobster.<br><br><center><a href='city.php'>Back to the city</a></center>"; ?>

</td></tr>

<?

include 'footer.php';

?>

