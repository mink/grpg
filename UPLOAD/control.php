<?
include 'header.php';
$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `lastactive` DESC");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$secondsago = time()-$line['lastactive'];
		if ($secondsago > 2592000) {
			$user_online = new User($line['id']);
			$result2 = mysql_query("DELETE FROM `grpgusers` WHERE `id`='".$user_online->id."'");
		}
	}
if ($user_class->admin != 1) {
  echo Message("You are not authorized to be here.");
  include 'footer.php';
  die();
}

//referrals section
if ($_GET['givecredit'] != ""){
	$result = mysql_query("UPDATE `referrals` SET `credited`='1' WHERE `id`='".$_GET['givecredit']."'");
	$result = mysql_query("SELECT * FROM `referrals` WHERE `id` = '".$_GET['givecredit']."'");
	$line = mysql_fetch_array($result);
	$cp_user = new User($line['referrer']);
	$newpoints = $cp_user->points + 10;
	$result = mysql_query("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `id`='".$cp_user->id."'");
	send_event($cp_user->id, "You have been credited 10 points for referring ".$line['referred'].". Keep up the good work!");
	echo Message("You have accepted the referral.");
}
if ($_GET['denycredit'] != ""){
	$result = mysql_query("DELETE FROM `referrals` WHERE `id`='".$_GET['denycredit']."'");
	
	send_event($line['referrer'], "Unfortunately you have recieved no points for referring ".$line['referred'].". This could be a result of many different things, such as you abusing the referral system, or the player you referred only signing up, but never actually playing.");
	echo Message("You have denied the referral.");
}
//jobs section
if ($_GET['deletejob']){
	$result = mysql_query("DELETE FROM `jobs` WHERE `id`='".$_GET['deletejob']."'");
	echo Message("You have deleted a job.");
	mrefresh("control.php?page=jobs");
	include 'footer.php';
	die();
}
if ($_POST['addjobdb']){
	$result= mysql_query("INSERT INTO `jobs` (name, money, strength, defense, speed, level)"."VALUES ('".$_POST['name']."','".$_POST['money']."','".$_POST['strength']."','".$_POST['defense']."','".$_POST['speed']."', '".$_POST['level']."')");	
	echo Message("You have added a job to the database.");
}
if ($_POST['editjobdb']){
	$result= mysql_query("UPDATE `jobs` SET `name`='".$_POST['name']."', `money`='".$_POST['money']."', `strength`='".$_POST['strength']."', `defense`='".$_POST['defense']."', `speed`='".$_POST['speed']."', `level`='".$_POST['level']."' WHERE `id`='".$_POST['id']."'");	
	echo Message("You have edited a job.");
}
//city section
if ($_GET['deletecity']){
	$result = mysql_query("DELETE FROM `cities` WHERE `id`='".$_GET['deletecity']."'");
	echo Message("You have deleted a city.");
	mrefresh("control.php?page=cities");
	include 'footer.php';
	die();
}
if ($_POST['addcitydb']){
	$result= mysql_query("INSERT INTO `cities` (name, levelreq, landleft, landprice, description)"."VALUES ('".$_POST['name']."','".$_POST['levelreq']."','".$_POST['landleft']."','".$_POST['landprice']."','".$_POST['description']."')");	
	echo Message("You have added a city to the database.");
}
if ($_POST['editcitydb']){
	$result= mysql_query("UPDATE `cities` SET `name`='".$_POST['name']."', `levelreq`='".$_POST['levelreq']."', `landleft`='".$_POST['landleft']."', `landprice`='".$_POST['landprice']."', `description`='".$_POST['description']."' WHERE `id`='".$_POST['id']."'");	
	echo Message("You have edited a city.");
}
//crime section
if ($_GET['deletecrime']){
	$result = mysql_query("DELETE FROM `crimes` WHERE `id`='".$_GET['deletecrime']."'");
	echo Message("You have deleted a crime.");
	mrefresh("control.php?page=crimes");
	include 'footer.php';
	die();
}
if ($_POST['addcrimedb']){
	$result= mysql_query("INSERT INTO `crimes` (name, nerve, stext, ftext, ctext)"."VALUES ('".$_POST['name']."','".$_POST['nerve']."','".$_POST['stext']."','".$_POST['ftext']."','".$_POST['ctext']."')");	
	echo Message("You have added a crime to the database.");
}
if ($_POST['editcrimedb']){
	$result= mysql_query("UPDATE `crimes` SET `name`='".$_POST['name']."', `nerve`='".$_POST['nerve']."', `stext`='".$_POST['stext']."', `ftext`='".$_POST['ftext']."', `ctext`='".$_POST['ctext']."' WHERE `id`='".$_POST['id']."'");	
	echo Message("You have edited a crime.");
}
//items section
if ($_POST['additemdb']){
	$result= mysql_query("INSERT INTO `items` (itemname,description,cost,image,offense,defense,heal,buyable,level)"."VALUES ('".$_POST['itemname']."','".$_POST['description']."','".$_POST['cost']."','".$_POST['image']."','".$_POST['offense']."','".$_POST['defense']."','".$_POST['heal']."','".$_POST['buyable']."','".$_POST['level']."')");	
}
if ($_GET['takealluser'] != ""){
	$oldamount = Check_Item($_GET['takeallitem'], $_GET['takealluser']);
	$result = mysql_query("DELETE FROM `inventory` WHERE `userid` = '".$_GET['takealluser']."' AND `itemid` = '".$_GET['takeallitem']."'");
 echo Message("That user had ".$oldamount." of those, now they are all gone.");
}
if ($_POST['giveitem'] != ""){
	$oldamount = Check_Item($_POST['itemnumber'], Get_ID($_POST['username']));
	Give_Item($_POST['itemnumber'], Get_ID($_POST['username']), $_POST['itemquantity']);
	$newamount = Check_Item($_POST['itemnumber'], Get_ID($_POST['username']));
	echo Message("That user had ".$oldamount." of those, and now has ".$newamount." of them.");
}
if ($_POST['takeitem'] != ""){
	$oldamount = Check_Item($_POST['itemnumber'], Get_ID($_POST['username']));
	Take_Item($_POST['itemnumber'], Get_ID($_POST['username']), $_POST['itemquantity']);
	$newamount = Check_Item($_POST['itemnumber'], Get_ID($_POST['username']));
	echo Message("That user had ".$oldamount." of those, and now has ".$newamount." of them.");
}
if ($_POST['listitems'] != ""){
	$oldamount = Check_Item($_POST['itemnumber'], Get_ID($_POST['username']));
	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid`='".Get_ID($_POST['username'])."'");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$line['itemid']."'");
		$worked2 = mysql_fetch_array($result2);
		$out.= "<div>".$line['itemid'].".) ".item_popup($worked2['itemname'], $worked2['id']) ." $". $worked2['cost']." Quantity: ".$line['quantity']." <a href='control.php?page=playeritems&takealluser=".Get_ID($_POST['username'])."&takeallitem=".$line['itemid']."'>Take All</a></div>";
	}
	echo Message($_POST['username']."'s Items<br>".$out);
}
if ($_POST['changemessage'] != ""){
	$result = mysql_query("UPDATE `serverconfig` SET `messagefromadmin` = '".$_POST['message']."'");
	echo Message("You have changed the message from the admin.");
}

if ($_POST['changeserverdown'] != ""){
	$result = mysql_query("UPDATE `serverconfig` SET `serverdown` = '".$_POST['message']."'");
	echo Message("You have changed the server down text.");
}
if ($_POST['addrmdays'] != ""){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='".$_POST['username']."'");
    $worked = mysql_fetch_array($result);
	
	$newrmdays = $worked['rmdays'] + $_POST['rmdays'];
	$result = mysql_query("UPDATE `grpgusers` SET `rmdays` = '".$newrmdays."' WHERE `username`='".$_POST['username']."'");
	
	echo Message("You have added ".$_POST['rmdays']." RM Days to ".$_POST['username'].".");
}
if ($_POST['addpoints'] != ""){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='".$_POST['username']."'");
    $worked = mysql_fetch_array($result);
	
	$newpoints = $worked['points'] + $_POST['points'];
	$result = mysql_query("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `username`='".$_POST['username']."'");
	
	echo Message("You have added ".$_POST['points']." points to ".$_POST['username'].".");
}
if ($_POST['addhookers'] != ""){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='".$_POST['username']."'");
    $worked = mysql_fetch_array($result);
	
	$newhookers = $worked['hookers'] + $_POST['hookers'];
	$result = mysql_query("UPDATE `grpgusers` SET `hookers` = '".$newhookers."' WHERE `username`='".$_POST['username']."'");
	
	echo Message("You have added ".$_POST['hookers']." hookers to ".$_POST['username'].".");
}
if ($_POST['givermgun'] != ""){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='".$_POST['username']."'");
    $worked = mysql_fetch_array($result);

    $result= mysql_query("INSERT INTO `inventory` (userid, itemid)".
    "VALUES ('".$worked['id']."', '15')");	
	
	echo Message("You have given an RM Gun to ".$_POST['username'].".");
}
if ($_POST['givermarmor'] != ""){
	$result = mysql_query("SELECT * FROM `grpgusers` WHERE `username`='".$_POST['username']."'");
    $worked = mysql_fetch_array($result);

    $result= mysql_query("INSERT INTO `inventory` (userid, itemid)".
    "VALUES ('".$worked['id']."', '16')");	
	
	echo Message("You have given an RM Armor to ".$_POST['username'].".");
}
if ($_GET['action'] == "deleteallfromip"){
	$result = mysql_query("DELETE FROM `grpgusers` WHERE ip='".$_GET['ip']."'");
}
if(isset($_POST['adminstatus'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 1 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
if(isset($_POST['revokeadminstatus'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 0 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}

if(isset($_POST['banplayer'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 5 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
if(isset($_POST['president'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 3 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
if(isset($_POST['impeachpresident'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 0 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
if(isset($_POST['congress'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 4 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
if(isset($_POST['impeachcongress'])){
$user = trim($_POST['username']);
if($user != ""){
$query = "UPDATE grpgusers SET admin = 0 WHERE username = '$user'";
mysql_query($query) or die("Failure to Update a player with Admin Status. MySQL reports: ".mysql_error());
}
}
?>
<tr><td class="contenthead">Control Panel</td></tr>
<tr><td class="contentcontent">Welcome to the control panel. Here you can do just about anything, from giving players items they have paid for with real money, to adding, changing, or deleting jobs, cities, items, etc. <br /><br />Please send any ideas for things that need to be added to the control panel to comments@thegrpg.com <br /><br />If you are experiencing problems with any of the options, try clicking the submit button instead of pressing the enter key.</td></tr>
<?php if($_GET['page'] == "") { ?>
<tr><td class="contenthead">Change Message From The Admin</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<?
$result = mysql_query("SELECT * from `serverconfig`");
$worked = mysql_fetch_array($result);
?>
<textarea name='message' cols='53' rows='7'><?= $worked['messagefromadmin']; ?></textarea><br />
<input type='submit' name='changemessage' value='Change Message From Admin'>
</form>
</td></tr>
<tr><td class="contenthead">Change Server Down Text</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<?
$result = mysql_query("SELECT * from `serverconfig`");
$worked = mysql_fetch_array($result);
?>
<textarea name='message' cols='53' rows='7'><?= $worked['serverdown']; ?></textarea><br />
<input type='submit' name='changeserverdown' value='Change Server Down Text'>
</form>
</td></tr>

<?php } ?>
<?php if ($_GET['page'] == "rmoptions") { ?>
<tr><td class="contenthead">Add RM Days</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='rmdays' size='10' maxlength='75'> [How Many RM Days]<br />
<input type='submit' name='addrmdays' value='Add RM days'>
</form>
</td></tr>
<tr><td class="contenthead">Add Points</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='points' size='10' maxlength='75'> [How Many Points]<br />
<input type='submit' name='addpoints' value='Give Points'>
</form>
</td></tr>
<tr><td class="contenthead">Add Hookers</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='hookers' size='10' maxlength='75'> [How Many Hookers]<br />
<input type='submit' name='addhookers' value='Give Hookers'>
</form>
</td></tr>
<tr><td class="contenthead">Give RM Gun</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='givermgun' value='Give RM Gun'>
</form>
</td></tr>
<tr><td class="contenthead">Give RM Armor</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='givermarmor' value='Give RM Armor'>
</form>
</td></tr>
<?php 
}
if ($_GET['page'] == "setplayerstatus") { ?>
<tr><td class="contenthead">Ban a Player</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='reason'   size='10' maxlength='75'>[Reason for Banning]<br/>
<input type='submit' name='banplayer' value='Ban Player'></td></tr>
<tr><td class="contenthead">Give Admin Status</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='adminstatus' value='Change Admin Status'>
</form>
</td></tr>
<tr><td class="contenthead">Revoke Admin Status</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='revokeadminstatus' value='Revoke Admin Status'>
</form>
</td></tr>
<tr><td class="contenthead">Presidential Election</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='president' value='Elect President'>
</form>
</td></tr>
<tr><td class="contenthead">Impeach President</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='impeachpresident' value='Impeach President'>
</form>
</td></tr>
<tr><td class="contenthead">Congressional Elections</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='congress' value='Elect Congress'>
</form>
</td></tr>
<tr><td class="contenthead">Impeach Congress</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='impeachcongress' value='Impeach Congressman'>
</form>
</td></tr>
<?
}

if ($_GET['page'] == "playeritems") { ?>
<tr><td class="contenthead">List Of All Items</td></tr>
<tr><td class="contentcontent">
<?
$result = mysql_query("SELECT * FROM `items`");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<div>".$line['id'].".) ".item_popup($line['itemname'], $line['id']) ." $". $line['cost']."</div>";
}
?>
</td></tr>
<tr><td class="contenthead">Add New Item To Database</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='itemname' size='10' maxlength='75'> [itemname]<br />
<input type='text' name='description' size='10' maxlength='75'> [description]<br />
<input type='text' name='cost' size='10' maxlength='75'> [cost]<br />
<input type='text' name='image' size='10' maxlength='75'value='images/noimage.png'> [image]<br />
<input type='text' name='offense' size='10' maxlength='75'> [offense]<br />
<input type='text' name='defense' size='10' maxlength='75'> [defense]<br />
<input type='text' name='heal' size='10' maxlength='75'value='0'> [heal]<br />
<input type='text' name='buyable' size='10' maxlength='75'value='0'> [buyable]<br />
<input type='text' name='level' size='10' maxlength='75' value='0'> [level]<br />
<input type='submit' name='additemdb' value='Add Item'></td></tr>
</form>
<tr><td class="contenthead">Give Item</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='itemnumber'   size='10' maxlength='75'> [Item Number]<br/>
<input type='text' name='itemquantity'   size='10' maxlength='75'> [Quantity]<br/>
<input type='submit' name='giveitem' value='Give Items'></td></tr>
</form>
<tr><td class="contenthead">Take Item</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='text' name='itemnumber'   size='10' maxlength='75'> [Item Number]<br/>
<input type='text' name='itemquantity'   size='10' maxlength='75'> [Quantity]<br/>
<input type='submit' name='takeitem' value='Take Items'></td></tr>
</form>
<tr><td class="contenthead">View A Player's Items</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='username' size='10' maxlength='75'> [Username]<br />
<input type='submit' name='listitems' value='List Items'></td></tr>
</form>
<?
}

if ($_GET['page'] == "referrals") { ?>
<tr><td class="contenthead">Manage Referrals</td></tr>
<tr><td class="contentcontent">
<?
$result = mysql_query("SELECT * FROM `referrals` WHERE `credited`='0'");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<div>".$line['id'].".) ".$line['referred']." was referred by Player ID:". $line['referrer']." (".date(F." ".d.", ".Y." ".g.":".i.":".sa,$line['when']).") <a href='control.php?page=referrals&givecredit=".$line['id']."'>Credit</a> | <a href='control.php?page=referrals&denycredit=".$line['id']."'>Deny</a></div>";
}
?>
</td></tr>
<?
}
if ($_GET['page'] == "crimes") { ?>
	<tr><td class="contenthead">Crimes</td></tr>
	<tr><td class="contentcontent">
	<?
	$result = mysql_query("SELECT * FROM `crimes`");
	echo "<table><tr align='center'><td><b>ID</b></td><td><b>Name</b></td><td><b>Nerve</b></td><td><b>Delete</b></td><tr>";
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<tr><td>".$line['id'].".)</td><td>".$line['name']."</td><td>". $line['nerve']."</td><td><a href='control.php?page=crimes&deletecrime=".$line['id']."'>[Delete Crime]</a></td></tr>";
	}
	echo "</table>";
	?>
	</td></tr>
	<tr><td class="contenthead">Add New Crime To Database</td></tr>
	<tr><td class="contentcontent">
	<form method='post'>
	<input type='text' name='name' size='30' maxlength='75'> [name]<br />
	<input type='text' name='nerve' size='30' maxlength='75'> [nerve]<br />
	<textarea name='stext' cols='53' rows='7'>Success message</textarea><br />
	<textarea name='ctext' cols='53' rows='7'>Fail message</textarea><br />
	<textarea name='ftext' cols='53' rows='7'>Fail and caught message</textarea><br />
	<input type='submit' name='addcrimedb' value='Add Crime'></td></tr>
	</form>
	<tr><td class="contenthead">View/Edit A Crime</td></tr>
	<tr><td class="contentcontent">
	<form method='post'>
	<input type='text' name='crimeid' size='10' maxlength='75'> [Crime ID]<br />
	<input type='submit' name='vieweditcrime' value='View/Edit Crime'></td></tr>
	<?
	if($_POST['vieweditcrime']){
		$result = mysql_query("SELECT * FROM `crimes` WHERE `id`='".$_POST['crimeid']."'");
		$worked = mysql_fetch_array($result);
		?>
		<tr><td class="contenthead">Edit Crime</td></tr>
		<tr><td class="contentcontent">
		<form method='post'>
		<input type='text' name='name' size='30' maxlength='75' value='<?= $worked['name'] ?>'> [name]<br />
		<input type='text' name='nerve' size='30' maxlength='75' value='<?= $worked['nerve'] ?>'> [nerve]<br />
		<textarea name='stext' cols='53' rows='7'><?= $worked['stext'] ?></textarea><br />
		<textarea name='ctext' cols='53' rows='7'><?= $worked['ctext'] ?></textarea><br />
		<textarea name='ftext' cols='53' rows='7'><?= $worked['ftext'] ?></textarea><br />
		<input type="hidden" name="id" value="<?= $worked['id'] ?>">
		<input type='submit' name='editcrimedb' value='Edit Crime'></td></tr>
		</form>
		<?
	}
}
if ($_GET['page'] == "cities") { ?>
<tr><td class="contenthead">Cities</td></tr>
<tr><td class="contentcontent">
<?
$result = mysql_query("SELECT * FROM `cities`");
echo "<table cellpadding='4'><tr align='center'><td><b>ID</b></td><td><b>Name</b></td><td><b>Level Req</b></td><td><b>Land Left</b></td><td><b>Land Price</b></td><td><b>Delete</b></td></tr>";
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<tr><td>".$line['id'].".)</td><td>".$line['name']."</td><td>". $line['levelreq']."</td><td>".$line['landleft']."</td><td>".$line['landprice']."</td><td><a href='control.php?page=cities&deletecity=".$line['id']."'>[Delete City]</a></td></tr>";
}
echo "</table>";
?>
</td></tr>
<tr><td class="contenthead">Add New City To Database</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='name' size='30' maxlength='75'> [name]<br />
<input type='text' name='levelreq' size='30' maxlength='75'> [level req]<br />
<input type='text' name='landleft' size='30' maxlength='75'> [land left]<br />
<input type='text' name='landprice' size='30' maxlength='75'> [land price]<br />
<textarea name='description' cols='53' rows='7'>Description goes here...</textarea><br />
<input type='submit' name='addcitydb' value='Add City'></td></tr>
</form>
<tr><td class="contenthead">View/Edit A City</td></tr>
<tr><td class="contentcontent">
<form method='post'>
<input type='text' name='cityid' size='10' maxlength='75'> [City ID]<br />
<input type='submit' name='vieweditcity' value='View/Edit City'></td></tr>
<?
	if($_POST['vieweditcity']){
		$result = mysql_query("SELECT * FROM `cities` WHERE `id`='".$_POST['cityid']."'");
		$worked = mysql_fetch_array($result);
		?>
		<tr><td class="contenthead">Edit City</td></tr>
		<tr><td class="contentcontent">
		<form method='post'>
		<input type='text' name='name' size='30' maxlength='75' value='<?= $worked['name'] ?>'> [name]<br />
		<input type='text' name='levelreq' size='30' maxlength='75' value='<?= $worked['levelreq'] ?>'> [level req]<br />
		<input type='text' name='landleft' size='30' maxlength='75' value='<?= $worked['landleft'] ?>'> [land left]<br />
		<input type='text' name='landprice' size='30' maxlength='75' value='<?= $worked['landprice'] ?>'> [land price]<br />
		<textarea name='description' cols='53' rows='7'><?= $worked['description'] ?></textarea><br />
		<input type="hidden" name="id" value="<?= $worked['id'] ?>">
		<input type='submit' name='editcitydb' value='Edit City'></td></tr>
		</form>
		<?
	}
}
if ($_GET['page'] == "jobs") { ?>
	<tr><td class="contenthead">Jobs</td></tr>
	<tr><td class="contentcontent">
	<?
	$result = mysql_query("SELECT * FROM `jobs`");
	echo "<table><tr align='center'><td><b>ID</b></td><td><b>Name</b></td><td><b>Money</b></td><td><b>Strength</b></td><td><b>Defense</b></td><td><b>Speed</b></td><td><b>Level</b></td><td><b>Delete</b></td><tr>";
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<tr><td>".$line['id'].".)</td><td>".$line['name']."</td><td>". $line['money']."</td><td>".$line['strength']."</td><td>".$line['defense']."</td><td>".$line['speed']."</td><td>".$line['level']."</td><td><a href='control.php?page=jobs&deletejob=".$line['id']."'>[Delete Job]</a></td></tr>";
	}
	echo "</table>";
	?>
	</td></tr>
	<tr><td class="contenthead">Add New Job To Database</td></tr>
	<tr><td class="contentcontent">
	<form method='post'>
	<input type='text' name='name' size='30' maxlength='75'> [name]<br />
	<input type='text' name='money' size='30' maxlength='75'> [money]<br />
	<input type='text' name='strength' size='30' maxlength='75'> [strength]<br />
	<input type='text' name='defense' size='30' maxlength='75'> [defense]<br />
	<input type='text' name='speed' size='30' maxlength='75'> [speed]<br />
	<input type='text' name='level' size='30' maxlength='75'> [level]<br />
	<input type='submit' name='addjobdb' value='Add Job'></td></tr>
	</form>
	<tr><td class="contenthead">View/Edit A Job</td></tr>
	<tr><td class="contentcontent">
	<form method='post'>
	<input type='text' name='jobid' size='10' maxlength='75'> [Job ID]<br />
	<input type='submit' name='vieweditjob' value='View/Edit Job'></td></tr>
	<?
	if($_POST['vieweditjob']){
		$result = mysql_query("SELECT * FROM `jobs` WHERE `id`='".$_POST['jobid']."'");
		$worked = mysql_fetch_array($result);
		?>
		<tr><td class="contenthead">Edit Job</td></tr>
		<tr><td class="contentcontent">
		<form method='post'>
		<input type='text' name='name' size='30' maxlength='75' value='<?= $worked['name'] ?>'> [name]<br />
		<input type='text' name='money' size='30' maxlength='75' value='<?= $worked['money'] ?>'> [money]<br />
		<input type='text' name='strength' size='30' maxlength='75' value='<?= $worked['strength'] ?>'> [strength]<br />
		<input type='text' name='defense' size='30' maxlength='75' value='<?= $worked['defense'] ?>'> [defense]<br />
		<input type='text' name='speed' size='30' maxlength='75' value='<?= $worked['speed'] ?>'> [speed]<br />
		<input type='text' name='level' size='30' maxlength='75' value='<?= $worked['level'] ?>'> [level]<br />
		<input type="hidden" name="id" value="<?= $worked['id'] ?>">
		<input type='submit' name='editjobdb' value='Edit Job'>
		</form>
		</td></tr>
		<?
	}
}
include 'footer.php';
?>