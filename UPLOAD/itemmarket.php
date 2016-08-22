<?php

include 'header.php';



if ($_GET['buy']){



	$result = mysql_query("SELECT * FROM `itemmarket` WHERE `id`='".$_GET['buy']."'");

    $worked = mysql_fetch_array($result);

	

	$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$worked['itemid']."'");

	$worked2 = mysql_fetch_array($result2);

	

    $price = $worked['cost'];

 	$user_item = new User($worked['userid']);



	if ($worked['userid'] == $user_class->id) {

		echo Message("You have taken your ".$worked2['itemname']." off the market.");
		Give_Item($worked2['id'], $user_class->id);//give them the item they bought

		$result = mysql_query("DELETE FROM `itemmarket` WHERE `id`='".$_GET['buy']."'");

		include 'footer.php';

		die();

	}



	if ($price > $user_class->money){

		echo Message("You don't have enough money.");

	}else {

		echo Message("You have bought a ".$worked2['itemname'].".");

		$newmoney = $user_class->money - $price;

		$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_class->id."'");

		$newmoney = $user_item->money + $price;

		$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$user_item->id."'");

		$user_class = new User($_SESSION['id']);

		$result = mysql_query("DELETE FROM `itemmarket` WHERE `id`='".$_GET['buy']."'");
		Give_Item($worked2['id'], $user_class->id);//give them the item they bought

	}

}

?>

<tr><td class="contenthead">Item Market</td></tr>

<tr><td class="contentcontent">

<?php

$result = mysql_query("SELECT * FROM `itemmarket` ORDER BY `cost` ASC");

while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

	$user_item = new User($line['userid']);

	$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$line['itemid']."'");

	$worked = mysql_fetch_array($result2);

	

	if ($user_item->id == $user_class->id){

		$submittext = "Remove Item";

	} else {

		$submittext = "Buy";

	}

	echo "<a href='itemmarket.php?buy=".$line['id']."'>".$submittext."</a> ".$worked['itemname']." - $".$line['cost']." from $user_item->formattedname <br>";

}

?>

</td></tr>

<?php

include 'footer.php';

?>