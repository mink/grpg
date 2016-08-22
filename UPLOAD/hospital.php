<?
include 'header.php';

echo "<tr><td class='contenthead'>Hospital</td></tr>";
$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `hospital` DESC");
echo '<tr><td class="contentcontent">';
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$secondsago = time()-$line['lastactive'];
			$user_hospital = new User($line['id']);
			if (floor($user_hospital->hospital / 60) != 1) {
			$plural = "s";
			 }
			 if($user_hospital->hospital != 0){
			$someonehere = 1;
			$how = ($line['hhow'] == "wasattacked") ? "Was attacked by" : "Attacked";
			echo "<div>".$user_hospital->formattedname." for another ".floor($user_hospital->hospital / 60)." minute".$plural.". (".$how." ".$line['hwho']." and lost at ".$line['hwhen'].")</div>";
			}
	}
	if ($someonehere != 1){
		echo "No one is in the hospital.";
	}
echo "</td></tr>";

include 'footer.php'
?>