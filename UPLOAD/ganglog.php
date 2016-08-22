<?
include 'header.php';

if ($user_class->gang != 0) {
	$gang_class = New Gang($user_class->gang);
	echo "<tr><td class='contenthead'>[".$gang_class->tag."]".$gang_class->name." Defense Log</td></tr><tr><td class='contentcontent'>";

	$result = mysql_query("SELECT * from `ganglog` WHERE `gangid` = '".$gang_class->id."' ORDER BY `timestamp` DESC");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$attacker = new User($row['attacker']);
		$defender = new User($row['defender']);
		$winner = new User($row['winner']);
		$time = date(F." ".d.", ".Y." ".g.":".i.":".sa,$row['timestamp']);
		echo $attacker->formattedname." attacked ".$defender->formattedname." and ".$winner->formattedname." won - ".$time."<br>";
	}
	echo "<td><tr>";
} else {
	echo Message("You aren't in a gang.");
}
include 'footer.php';
?>