<?php
include 'header.php';

if ($_POST['sellstocks']){
	$result = mysql_query("SELECT * FROM `stocks` WHERE `id`='".$_POST['stocks_id']."'");
    $worked = mysql_fetch_array($result);
    $price = $worked['cost'];
	$costbefore = $price * $_POST['amount'];
	$firmcut = ceil($costbefore * .1);
 	$totalcost = $costbefore - $firmcut;
	
	$error = ($_POST['amount'] < 1) ? "Please enter a valid amount of shares to sell." : $error;
	$error = (Check_Share($worked['id'], $user_class->id) == 0) ? "You don't own that many shares." : $error;
	
	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}

	echo Message("You have sold ".$_POST['amount']." shares for a total of $".$totalcost." ($".$price." per share X ".$_POST['amount']." shares - $".$firmcut." transaction fee)");
	$newmoney = $user_class->money + $totalcost;
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");
	$user_class = new User($_SESSION['id']);
	Take_Share($_POST['stocks_id'], $user_class->id, $_POST['amount']);
}

?>
<tr><td class="contentcontent" align="center">
<img src='images/stock market.png' />
</td></tr>
<tr><td class="contenthead">Your Portfolio</td></tr>
<tr><td class="contentcontent">
Here you can view, compare, and sell your shares.
</td></tr>
<tr><td class="contenthead">View Stocks</td></tr>
<tr><td class="contentcontent">
	<table width='100%'>
		<tr>
			<td width='35%'><b>Company Name</b></td>
			<td width='20%'><b>Cost per Share</b></td>
			<td width='10%'><b># Held</b></td>
			<td width='15%'><b>Total Value</b></td>
			<td width='20%'><b>Sell</b></td>
		</tr>
<?
$result = mysql_query("SELECT * FROM `shares` WHERE `userid`='".$user_class->id."' ORDER BY `userid` ASC");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$result2 = mysql_query("SELECT * FROM `stocks` WHERE `id`='".$line['companyid']."'");
	$worked2 = mysql_fetch_array($result2);
	echo "<form method='post'>";
	echo "<tr><td width='35%'>".$worked2['company_name']."</td><td width='20%'>$".$worked2['cost']."</td><td width='10%'>".$line['amount']."</td><td width='15%'>$".$line['amount'] * $worked2['cost']."</td><td width='20%'><input type='text' name='amount' size='3' maxlength='20' value='".$line['amount']."'><input type='hidden' name='stocks_id' value='".$line['companyid']."'>&nbsp;<input type='submit' name='sellstocks' value='Sell'></form><br></tr>";
}
?>
	</table>
</td></tr>
<?php
include 'footer.php';
?>