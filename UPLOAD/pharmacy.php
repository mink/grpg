<?
include 'header.php';

if ($_GET['buy'] != "") {
	$cost = 0;
	$cost = ($_GET['buy'] == "No-Doze") ? 10000 : $cost;
	$cost = ($_GET['buy'] == "Steroids") ? 2500 : $cost;
	
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
	
	if($_GET['buy'] == "No-Doze"){
		$newamount = $user_class->nodoze + 1;
		$newsql = mysql_query("UPDATE `grpgusers` SET `nodoze` = '".$newamount."' WHERE `id`= '".$user_class->id."'");
	}
	if($_GET['buy'] == "Steroids"){
		$newamount = $user_class->genericsteroids + 1;
		$newsql = mysql_query("UPDATE `grpgusers` SET `genericsteroids` = '".$newamount."' WHERE `id`= '".$user_class->id."'");
	}
}
?>
<tr><td class="contenthead">Pharmacy</td></tr>
<tr><td class="contentcontent">
How may I help you? We offer quite a bit of medical supplies here for all your medical needs. I am of course assuming that these drugs won't be abused... We have a strict no drug-abuse policy here in Generica...
</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
	<tr>
		<td width='25%' align='center'>
			<img src='images/noimage.png' width='100' height='100' style='border: 1px solid #333333'><br>
			No-Doze<br>
			$10,000<br>
			<a href='pharmacy.php?buy=No-Doze'>[Buy]</a>
		</td>
		<td width='25%' align='center'>
			<img src='images/noimage.png' width='100' height='100' style='border: 1px solid #333333'><br>
			Generic Steroids<br>
			$2,500<br>
			<a href='pharmacy.php?buy=Steroids'>[Buy]</a>
		</td>
	</tr>
</table>
			
</td></tr>
<?
include 'footer.php';
?>
