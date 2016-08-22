<?
include 'header.php';
?>
<tr><td class="contenthead">Hall Of Fame [<a href="http://bourbanlegends.com/forum/viewtopic.php?pid=1240">?</a>]</td></tr>
<tr><td class="contentcontent"><center><a href="halloffame.php?view=exp">Level</a> | <a href="halloffame.php?view=strength">Strength</a> | <a href="halloffame.php?view=defense">Defense</a> | <a href="halloffame.php?view=speed">Speed</a> | <a href="halloffame.php?view=money">Money</a> | <a href="halloffame.php?view=points">Points</a></center></td></tr>
<tr><td class="contentcontent">
<table width='100%'>
<tr>
	<td>Rank</td>
	<td>Mobster</td>
	<td>Level</td>
	<td>Money</td>
	<td>Gang</td>

	<td align='center'>Online</td>
</tr>
<?
$view = ($_GET['view'] != "") ? $_GET['view'] : 'exp';


$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `".$view."` DESC LIMIT 50");
$rank = 0;
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$rank++;
	$user_hall = new User($line['id']);
	?>
	<tr>
			<td><?= $rank ?></td>
			<td><?= $user_hall->formattedname ?></td>
			<td><?= $user_hall->level ?></td>
			<td>$<?= $user_hall->money ?></td>
			<td><?= $user_hall->formattedgang ?></td>
			<td><?= $user_hall->formattedonline ?></td>
	</tr>
	<?
}
?>

</td></tr>
<?
include 'footer.php';
?>