<?
include 'header.php';
$gang_class = new Gang($user_class->gang);

if ($gang_class->leader != $user_class->username){
	echo Message("You do not have authorization to be here.");
	include 'footer.php';
	die();
}

if ($_POST['submit'] != ""){
	$result = mysql_query("UPDATE `gangs` SET `description` = '".strip_tags($_POST['changedesc'])."' WHERE `id`='".$gang_class->id."'");
	echo Message("You have changed the gang message.");
	$gang_class = new Gang($user_class->gang);
}
?>
<tr><td class="contenthead">Change Gang Message</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<textarea name='changedesc' cols='53' rows='7'><?= $gang_class->description; ?></textarea><br />
<input type='submit' name='submit' value='Change'>
</form>
</td>
</tr>
<?
include 'footer.php';
?>