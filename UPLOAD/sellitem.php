<?

include 'header.php';



if ($_GET['id'] == ""){

	echo Message("No item picked.");

	include 'footer.php';

	die();

}	



$howmany = Check_Item($_GET['id'], $user_class->id);//check how many they have


$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$_GET['id']."'");

$worked = mysql_fetch_array($result2);



$price = $worked['cost'] * .60;



if ($_GET['confirm'] == "true"){ //if they confirm they want to sell it

	$error = ($howmany == 0) ? "You don't have any of those." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}

	

	$newmoney = $user_class->money + $price;

	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");

	Take_Item($_GET['id'], $user_class->id);

	echo Message("You have sold a ".$worked['itemname']." for $".$price.".");

	include 'footer.php';

	die();

}

?>

<tr><td class="contenthead">Sell Item</td></tr>

<tr><td class="contentcontent">

<?= "Are you sure that you want to sell ".$worked['itemname']." for $".$price."?<br><a href='sellitem.php?id=".$_GET['id']."&confirm=true'>Yes</a>"; ?>

</td></tr>

<?

include 'footer.php';

?>