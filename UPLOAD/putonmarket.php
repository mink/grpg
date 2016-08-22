<?

include 'header.php';

if ($_GET['id'] == ""){

	echo Message("No item picked.");

	include 'footer.php';

	die();

}	



$howmany = Check_Item($_GET['id'], $user_class->id); //check how many they have



$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$_GET['id']."'");

$worked = mysql_fetch_array($result2);



if ($_GET['put'] == "true"){ //if they are trying to put something up

	$error = ($_POST['price'] < 1) ? "Please enter a valid amount of money." : $error;

	$error = ($howmany == 0) ? "You don't have any of those." : $error;

	

	if (isset($error)){

		echo Message($error);

		include 'footer.php';

		die();

	}

	

	echo Message("You have added a ".$worked['itemname']." to the market at a price of $".$_POST['price'].".");

	$result= mysql_query("INSERT INTO `itemmarket` (itemid, userid, cost)"."VALUES ('$_GET[id]', '$user_class->id', '$_POST[price]')");

	Take_Item($_GET['id'], $user_class->id);//take away item

	die();

}

?>

<tr><td class="contenthead">Put An Item On The Market</td></tr>

<tr><td class="contentcontent" align="center">

You are selling <?= $worked['itemname'] ?><br><br>

<form method='post' action='putonmarket.php?id=<?= $_GET['id'] ?>&put=true'>

Cost $<input type='text' name='price' size='10' maxlength='10'><br>

<input type='submit' name='market' value='Add'></form>

<br><br>

<a href="inventory.php">Back</a>

<br>

</td></tr>

<?

include 'footer.php';

?>