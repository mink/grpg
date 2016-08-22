<?php
include 'header.php';
if ($_GET['spend'] == "energy"){
	if($user_class->points > 9) {
	 $newpoints = $user_class->points - 10;
	  $result = mysql_query("UPDATE `grpgusers` SET `energy` = '".$user_class->maxenergy."', `points`='".$newpoints."' WHERE `id`='".$_SESSION['id']."'");
	  echo Message("You spent 10 points and refilled your energy.");
	} else {
		echo Message("You don't have enough points, silly buns.");
	}
}
if ($_GET['spend'] == "nerve"){
	if($user_class->points > 9) {
	 $newpoints = $user_class->points - 10;
	  $result = mysql_query("UPDATE `grpgusers` SET `nerve` = '".$user_class->maxnerve."', `points`='".$newpoints."' WHERE `id`='".$_SESSION['id']."'");
	  echo Message("You spent 10 points and refilled your nerve.");
	} else {
		echo Message("You don't have enough points, silly buns.");
	}
}
?>
<tr><td class="contenthead">Point Shop</td></tr>
<tr><td class="contentcontent">
Welcome to the Point Shop, here you can spend your points on various things.</td></tr>
<tr><td class="contentcontent">
<table>
		<tr>
			<td><a href='spendpoints.php?spend=energy'>Refill Energy</a></td>
			<td> - 10 Points</td>

		</tr>
		<tr>
			<td><a href='spendpoints.php?spend=nerve'>Refill Nerve</a></td>
			<td> - 10 Points</td>
		</tr>
</table>
</td></tr>
<?php
include 'footer.php';
?>