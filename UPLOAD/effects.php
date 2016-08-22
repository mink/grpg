<?
include 'header.php';
if(!isset($_GET['view'])){
	echo Message("No effect selected.");
	include 'footer.php';
	die();
}

if($_GET['view'] == "Cocaine"){
	$effectdesc = "+30% to speed attribute";
}
if($_GET['view'] == "Generic Steroids"){
	$effectdesc = "+15% to strength attribute";
}
?>

<tr><td class="contenthead">Effect - <?= $_GET['view']; ?></td></tr>
<tr><td class="contentcontent"><?= $effectdesc; ?></td></tr>
<?
include 'footer.php';
?>
