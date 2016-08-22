<?
include 'header.php';
if ($_GET['change'] == "yes"){
	echo Message("Your color scheme has been changed.");
}
if (isset($_GET['style'])) {
    $result= mysql_query("UPDATE `grpgusers` SET `style`='".$_GET['style']."' WHERE `id`='".$user_class->id."'");
	echo Message("Please wait while your changes are being made...");
    mrefresh("changestyle.php?change=yes", 0);
}
?>
<tr><td class="contenthead">
Change Color Scheme
</td></tr>
<tr><td class="contentcontent">
Current Scheme: <?= $user_class->style; ?>
<?
$cresult = mysql_query("SELECT DISTINCT `style` FROM `styles`");
while($line = mysql_fetch_array($cresult, MYSQL_ASSOC)) {
	echo "<div><a href='changestyle.php?style=".$line['style']."'>Switch to theme #".$line['style']."</a></div>";
		// get style info
		$result = mysql_query("SELECT * FROM `styles` WHERE `style`='".$line['style']."'");
		$i = 0;
		echo "<table><tr>";
		while($line2 = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$color[$i] = $line2['value'];
			echo '<td style="background-color:'.$color[$i].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
			$i++;
		}
		echo "</tr></table>";
		//get style info
}
?>

</td></tr>
<?
include 'footer.php';
?>