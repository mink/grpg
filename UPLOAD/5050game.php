<?php
include 'header.php';

if ($_POST['takebet'] != ""){

	$result = mysql_query("SELECT * FROM `5050game` WHERE `id`='".$_POST['bet_id']."'");
    $worked = mysql_fetch_array($result);
	if ($worked['owner'] == $user_class->id) {
		echo Message("You can't take your own bet.");
		include 'footer.php';
		die();
	}
    $amount = $worked['amount'];
 	$user_points = new User($worked['owner']);

	if ($amount > $user_class->money){
		echo Message("You don't have enough money to match their bet.");
	}
	if($amount <= $user_class->money){
		$newmoney = $user_class->money - $amount;
		$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");
		$user_class = new User($_SESSION['id']);

		$winner = rand(0,1);
		if($winner == 0){ //original poster wins
			echo Message("You have lost.");
			$amount = $amount * 2;
			$newmoney = $user_points->money + $amount;
			$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_points->id."'");
			Send_Event($user_points->id, "You won the $amount dollar bid you placed.");
		} else { //the person who accepted the bid won
			echo "You have won!";
			$amount = $amount * 2;
			$newmoney = $user_class->money + $amount;
			$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");
			Send_Event($user_points->id, "You lost the $amount dollar bid you placed.");
		}
		$result = mysql_query("DELETE FROM `5050game` WHERE `id`='".$worked['id']."'");

	}
}

if ($_POST['makebet']){
 	if($_POST['amount'] > $user_class->money){
		echo Message("You don't have that much money.");
	}
	if($_POST['amount'] < 1000){
		echo Message("Please enter a valid amount of money.");
	}
	if($_POST['amount'] >= 1000 && $_POST['amount'] <= $user_class->money){
		echo Message("You have added $".$_POST['amount']);
		$result= mysql_query("INSERT INTO `5050game` (owner, amount)"."VALUES ('$user_class->id', '$_POST[amount]')");
		$newmoney = $user_class->money - $_POST['amount'];
		$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");
		$user_class = new User($_SESSION['
		
		']);
	}
}

?>
<tr><td class="contenthead">50/50 Chance Game</td></tr>
<tr><td class="contentcontent">
This game is simple. 2 people bet the same amount of money, then a winner is randomly picked. The winner recieves all of the money!
</td></tr>
<tr><td class="contentcontent">
<form method='post'>
Amount of money to bid. $<input type='text' name='amount' size='10' maxlength='20' value='<? echo $user_class->money ?>'> (minimum of $1000 bet)<br>
<input type='submit' name='makebet' value='Make Bet'></form>
</td></tr>
<tr><td class="contentcontent">
<?php
$result = mysql_query("SELECT * FROM `5050game` ORDER BY `amount` DESC");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$user_points = new User($line['owner']);
	echo "<form method='post'>";
	echo "<br>".$user_points->formattedname." - $".$line['amount']."<input type='hidden' name='bet_id' value='".$line['id']."'> <input type='submit' name='takebet' value='Take Bet'></form>";
}
?>
</td></tr>
<?php
include 'footer.php';
?>