<?
include 'header.php';
echo '<tr><td class="contenthead">Total Users</td></tr>';
echo '<tr><td class="contentcontent">';
$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `ip` ASC");

	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$result1 = mysql_query("SELECT * FROM `grpgusers` WHERE `ip`='".$line['ip']."'");
			if (mysql_num_rows($result1) > 1){
				$user_online = new User($line['id']);
				echo "<div>".$user_online->ip.".)".$user_online->formattedname."</div>";
			}
	}
echo "</td></tr>";
include 'footer.php'
?>