<?
include 'header.php';
if (isset($_POST['submit'])) {
 $cost = (strlen($_POST['title']) + strlen($_POST['message'])) * 50;
 $error = ($cost > $user_class->money) ? "You don't have enough money for that!" : $error;
 $error = ($_POST['title'] == "") ? "You need to have a title!" :  $error;
 $error = ($_POST['message'] == "") ? "You need to have a message!" : $error;
 if($error == ""){
    $newmoney = $user_class->money - $cost;
    $time = time();
    $newsql = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`= '".$user_class->id."'");
    $result= mysql_query("INSERT INTO `ads` VALUES('".$time."', '$user_class->id', '".$_POST['title']."', '".$_POST['message']."')");
    echo Message("You have posted a classified ad for $".$cost);
  } else {
  echo Message($error);
  }
}
?>
<tr><td class="contenthead">Classified Ads</td></tr>
<tr><td class="contentcontent">
Here you can post any thing your heart desires. Careful though, as it costs $50 per character in the title and in the message.
</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<table width='100%'>
	<tr>
		<td width='25%'>Title:</td>
		<td width='25%'>
		<input type='text' name='title'  size='40' maxlength='100'>
		</td>
	</tr>

	<tr>

		<td width='25%'>Message:</td>
		<td width='25%'>
		<textarea name='message' cols='60' rows='4' ></textarea>
		</td>
	</tr>

	<tr>
		<td width='25%'>Submit:</td>

		<td width='25%'>
		<input type='submit' name='submit' value='Post'>
		</td>
	</tr>
</table>
</form>
</td></tr>

<?
$result = mysql_query("SELECT * from `ads` ORDER BY `when` DESC LIMIT 10");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
$user_ads = New User($row['poster']);
?>
<tr><td class="contentcontent">
<table width='100%'>
	<tr>
		<td width='15%'><b>Title</b>:</td>

		<td width='45%'><?= $row['title']; ?></td>
		<td width='15%'><b>Poster</b>:</td>
		<td width='45%'><?= $user_ads->formattedname ?></td>
	</tr>

	<tr>
		<td width='100%' colspan='4'><?= $row['message'] ?></td>

	</tr>
</table>
</td></tr>
<?
}
?>


<?
include 'footer.php';
?>