<?
include 'header.php';

$result = mysql_query("SELECT * FROM `cities` WHERE `id`='".$user_class->city."'");
$worked = mysql_fetch_array($result);
?>
<tr><td class="contenthead"><? echo $user_class->cityname; ?></td></tr>
<tr><td class="contentcontent"><?= $worked['description'] ?></td></tr>
<tr><td class="contenthead">Places To Go</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
<tr>
	<td width='33.3%' valign='top'>
	<b>Shops</b><br>
	<s>
	Parts n Stuff
	<br></s>
	<a href="astore.php">Crazy Riley's Armor Emporium</a>
	<br><a href="store.php">Weapon Sales</a><br>
	<a href="itemmarket.php">Item Market</a><br>
	<a href="pointmarket.php">Points Market</a><br>
	<a href="spendpoints.php">Point Shop</a><br>
	<a href="pharmacy.php">Pharmacy</a><br />
	<? echo ($user_class->city == 2) ? "<a href='carlot.php'>Big Bob's Used Car Lot</a>" : ""?>
	</td>

	<td width='33.3%' valign='top'>
	<b>Town Hall</b><br>
	<a href="halloffame.php">Hall Of Fame</a><br>
	<a href='worldstats.php'>World Stats</a><br>
	<a href="viewstaff.php">Town Hall</a><br>
	<a href='search.php'>Mobster Search</a><br>
	<a href="citizens.php">Mobsters List</a><br>
	<a href="online.php">Mobsters Online</a><br>
	</td>
	<td width='33.3%' valign='top'>
	<b>Casino</b><br>
	<a href="lottery.php">Lottery</a><br>
	<a href="slots.php">Slot Machine</a><br>
	<a href='5050game.php'>50/50 Game</a><br>
	</td>

</tr>

<tr>
	<td width='33.3%' valign='top'>
	<b>Your Home</b><br>
	<a href="pms.php">Mailbox
<?php
$checkmail = mysql_query("SELECT * FROM `pms` WHERE `to`='$user_class->username' and `viewed`='1'");
$nummsgs = mysql_num_rows($checkmail);
?>
 [<?php echo $nummsgs; ?>]</a><br>
	<a href="events.php">Events
<?php
$checkmail = mysql_query("SELECT * FROM `events` WHERE `to`='$user_class->id' and `viewed` = '1'");
$numevents = mysql_num_rows($checkmail);
?>
	 [<?php echo $numevents; ?>]</a><br>
	<a href="spylog.php">Spy Log</a><br />
	<a href="inventory.php">Inventory</a><br>
	<a href="refer.php">Referrals</a><br>
	<a href="house.php">Move House</a><br />
	<a href="fields.php">Manage Land</a>
	</td>
	<td width='33.3%' valign='top'>
	<b>Travel</b><br>
	<a href='bus.php'>Bus Station</a><br>
	<a href='drive.php'>Drive</a><br>
	</td>
	<td width='33.3%' valign='top'>
	<b>Downtown</b><br>
	<a href="buydrugs.php">Shady-Looking Stranger</a><br>
	<a href="downtown.php">Search Downtown</a><br>
	<a href="jobs.php">Job Center</a><br>
	<a href = "gang_list.php">Gang List</a><br>
	<a href="<? echo ($user_class->gang == 0) ? "creategang.php" : "gang.php"; ?>">Your Gang</a><br>
	<a href="bank.php">Bank</a><br>
	<a href="realestate.php">Real Estate Agency</a>
	</td>
</tr>

<tr>
	<td width='33.3%' valign='top'>
	<b>Pet Central</b><br>
	<s>
	Pet Hall Of Fame</a><br>
	Your Pets</a><br>
	Pet Track</a><br>
	Pet Arena</a>
	</s>
	</td>
	<td width='33.3%' valign='top'>
	<b>Car Central</b><br>
	<a href='garage.php'>Your Garage</a><br>
	<s>
	Race Track</a>
	</s>
	
	</td>
	<td width='33.3%' valign='top'>
	<b>Generic Street</b><br />
	<a href='viewstocks.php'>View Stock Market</a><br />
    <a href='brokerage.php'>Brokerage Firm</a><br />
	<a href='portfolio.php'>View Portfolio</a>
	</td>
</tr>
</table>
</td></tr>
<?
include 'footer.php';
?>