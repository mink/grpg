<?
include 'header.php';
echo '<tr><td class="contenthead">Total Users</td></tr>';
echo '<tr><td class="contentcontent">';
$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `id` ASC");

	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$secondsago = time()-$line['lastactive'];
			$user_online = new User($line['id']);
			echo "<div>".$user_online->id.".)".$user_online->formattedname."</div>";
	}
echo "</td></tr>";
include 'footer.php'
?>