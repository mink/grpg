<?
include 'header.php';
?>
<tr><td class="contenthead">Mailbox</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
<?
$result = mysql_query("SELECT * from `pms` WHERE `id`='".$_GET['id']."'");
$row = mysql_fetch_array($result);
     $from_user_class = new User($row['from']);
if ($_GET['id'] != ""){
    if (strtoupper($row['to']) == strtoupper($user_class->username)) {
    echo "
						<tr>
							<td width='15%'>Subject:</td>
							<td width='45%'>".$row['subject']."</td>
							<td width='15%'>Sender:</td>

							<td width='25%'>".$from_user_class->formattedname."</td>
						</tr>
						<tr>
							<td>Recieved:</td>
							<td colspan='3'>".date(F." ".d.", ".Y." ".g.":".i.":".sa,$row['timesent'])."</td>
						</tr>
						<tr>

							<td colspan='3' class='textm'>Message:<br>".wordwrap($row['msgtext'], 100, "\n", 1)."
					    	</td>
						</tr>
						<tr>
						<td colspan='4' align='center'><a href='pms.php?delete=".$row['id']."'>Delete</a> | <a href='pms.php?reply=".$row['id']."'>Reply</a></td>
						</tr>
						<tr>
							<td colspan='4' align='center'><a href='pms.php'>Back To Mailbox</a></td>
						</tr>

";
	$result2 = mysql_query("UPDATE `pms` SET `viewed` = '2' WHERE `id`='".$row['id']."'");
	}
}
?>

</table>
</td></tr>
<?
include 'footer.php';
?>