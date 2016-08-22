<?
include 'header.php';
?>
<tr><td class="contenthead">Refer To Earn Points</td></tr>
<tr><td class="contentcontent">Your Referer Link: http://www.thegrpg.com/register.php?referer=<? echo $user_class->id; ?><br />UPDATE: You will recieve your points only <i>after</i> we filter out multis. This is due to too many people abusing the referral system. Because we have to do this manually now, this could take anywhere from an hour to 2 days, but rest assured that you will recieve your points.
</td></tr>
<?
echo '<tr><td class="contenthead">Players You Have Referred</td></tr>';
$result = mysql_query("SELECT * FROM `referrals` WHERE `referrer`='".$user_class->id."'");
echo '<tr><td class="contentcontent">';
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$credited = ($line['credited'] == 0) ? "Pending" : "Approved";
			echo "<div>".$line['referred']." - ".$credited."</div>";
	}
echo '</td></tr>';
include 'footer.php';
?>