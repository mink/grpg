<?
include 'header.php';
if ($_GET['id'] == ""){
	echo Message("No item picked.");
	include 'footer.php';
	die();
}	

$howmany = Check_Item($_GET['id'], $user_class->id);

$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$_GET['id']."'");
$worked = mysql_fetch_array($result2);

if ($_GET['put'] == "true"){ //if they are trying to put something up
	$error = ($howmany == 0) ? "You don't have any of those." : $error;
	
	if (isset($error)){
		echo Message($error);
		include 'footer.php';
		die();
	}
	
	echo Message("You have added a ".$worked['itemname']." to the gang armory!<br><br><a href='gangarmory.php'>Back to armory</a>");
	$result= mysql_query("INSERT INTO `gangarmory` (itemid, gangid)"."VALUES ('$_GET[id]', '$user_class->gang')");
	Take_Item($_GET['id'], $user_class->id); //take one of the items they put up away from them
	die();
}
?>
<tr><td class="contenthead">Add An Item To The Gang Armory</td></tr>
<tr><td class="contentcontent" align="center">
You are adding a <?= $worked['itemname'] ?> to the gang armory.<br><br>

<a href='addtoarmory.php?id=<?= $_GET['id'] ?>&put=true'>Continue</a> | <a href="gangarmory.php">Back</a>
<br>
</td></tr>
<?
include 'footer.php';
?>