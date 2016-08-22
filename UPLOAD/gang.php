<?
include 'header.php';

if ($user_class->gang == 0){
	echo Message("You are not in a gang.");
	include 'footer.php';
	die();
}

$gang_class = New Gang($user_class->gang);

if ($_GET['action'] == "leave"){
	if ($gang_class->leader != $user_class->username){
		$newsql = mysql_query("UPDATE `grpgusers` SET `gang` = '0' WHERE `id`= '".$user_class->id."'");
		echo Message("You have left your gang.");
	} else {
		echo Message("You can't leave a gang if you are a leader.");
	}
}
?>

<td class="contenthead"><? echo "[". $gang_class->tag . "]" . $gang_class->name; ?></td>
</tr>
<tr><td class="contentcontent"><?= $gang_class->description; ?></td></tr>

<?
if ($gang_class->leader == $user_class->username){
?>
<tr><td class="contenthead">Gang Management</td></tr>
<tr><td class="contentcontent">
	<table width='100%'>
		<tr>
			<td width='33%' align='center'><a href='invite.php'>Invite Player</a></td>
			<td width='33%' align='center'><a href='managegang.php'>Manage Gang Members</a></td>
			<td width='33%' align='center'><a href='changedesc.php'>Change Gang Message</a></td>
		</tr>
	</table>
</td></tr>
<?
}
?>

<tr><td class="contenthead">Gang Actions</td></tr>
<tr><td class="contentcontent">
	<table width='100%'>
		<tr>
			<td width='25%' align='center'><a href='viewgang.php?id=<?= $gang_class->id ?>'>View Gang</a></td>
			<td width='25%' align='center'><a href='gang.php?action=leave'>Leave Gang</a></td>
			<td width='25%' align='center'><a href='ganglog.php'>Defense Log</a></td>
			<td width='25%' align='center'><a href='gangvault.php'>Vault</a></td>
		</tr>
		<tr>
			<td width='25%' align='center'><a href='gangarmory.php'>Armory</a></td>
			<td width='25%' align='center'></td>
			<td width='25%' align='center'></td>
			<td width='25%' align='center'></td>
		</tr>
	</table>
</td></tr>

<?
include 'footer.php';
?>