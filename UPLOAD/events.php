<?
//*********************** The GRPG ***********************
//*$Id: events.php,v 1.2 2007/07/22 07:40:50 cvs Exp $*
//********************************************************

include 'header.php';

if ($_GET['deleteall'] != ""){
  $result = mysql_query("DELETE FROM `events` WHERE `to`='".$user_class->id."'");
  echo Message("All your events have been deleted.");
}
$result2 = mysql_query("UPDATE `events` SET `viewed` = '2' WHERE `to`='".$user_class->id."'");

if ($_POST['delete'] != ""){
  $deleteevent = $_POST['event_id'];
  $result = mysql_query("DELETE FROM `events` WHERE `id`='".$deleteevent."'");
  echo Message("Event Deleted!");
}
?>
<tr><td class="contenthead">Event Log</td></tr>
<tr><td class="contentcontent" align='center'><a href='events.php?deleteall=true'>Delete All My Events</a></td>
<tr><td class="contentcontent">

<?
$result = mysql_query("SELECT * from `events` ORDER BY `timesent` DESC");
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    if ($row['to'] == $user_class->id) {
    echo "<table width='100%'>
						<tr>
							<td>Recieved:</td>
							<td colspan='3'>".date(F." ".d.", ".Y." ".g.":".i.":".sa,$row['timesent'])."</td>
						</tr>
						<tr>

							<td colspan='4' class='textm'>Event:&nbsp;&nbsp;".wordwrap($row['text'], 100, "\n", 1)."
					    	</td>
						</tr>
					</table><table width='100%'>
						<form method='post'>
						<input type='hidden' name='event_id' value='".$row['id']."'>

						<tr>
							<td width='25%' align='center'><input type='submit' name='delete' value='Delete'><HR></td>
						</tr>
						</form>
";
}
}
?>
</table>
</td></tr>
<?

include 'footer.php';
?>