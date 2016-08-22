<?
include 'header.php';
$gang_class = new Gang($user_class->gang);

if ($gang_class->leader != $user_class->username){
	echo Message("You do not have authorization to be here.");
	include 'footer.php';
	die();
}

if($_GET['dismiss'] != ""){
	if($_GET['dismiss'] != $user_class->id){
		$result = mysql_query("UPDATE `grpgusers` SET `gang` = '0' WHERE `id`='".$_GET['dismiss']."'");
		echo Message("You have dismissed that user.");
	} else {
		echo Message("You can't kick yourself out of our own gang.");
	}
}
?>
<tr>
<td class="contenthead"><? echo "[". $gang_class->tag . "]" . $gang_class->name; ?></td>
</tr>

<tr><td class="contentcontent">
<table width='100%'>
			<tr>
				<td>Mobster</td>
				<td>Kick Out</td>
			</tr>
		<?php
		$result = mysql_query("SELECT * FROM `grpgusers` WHERE `gang` = '".$user_class->gang."' ORDER BY `exp` DESC");
			while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$gang_member = new User($line['id']);
					?>
					<tr>
					<td><?= $gang_member->formattedname; ?></td>
					<td><a href='managegang.php?id=<?= $gang_class->id."&dismiss=".$gang_member->id; ?>'>Kick Out</a></td>
<?
			}
include 'footer.php';
?>