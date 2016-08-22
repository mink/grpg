<?
include 'dbcon.php';

$result = mysql_query("SELECT * FROM `inventory` ORDER BY `userid` DESC");
$howmanytotal = mysql_num_rows($result);

while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

	$result2 = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '".$line['userid']."' AND `itemid` = '".$line['itemid']."'");
	$howmanyrows = mysql_num_rows($result2);
	$worked2 = mysql_fetch_array($result2);
	if ($howmanyrows>0) {
		$result3= mysql_query("INSERT INTO `newinventory` (userid, itemid, quantity)"."VALUES ('".$line['userid']."', '".$line['itemid']."', '".$howmanyrows."')");
		$result4 = mysql_query("DELETE FROM `inventory` WHERE `userid` = '".$line['userid']."' AND `itemid` = '".$line['itemid']."'");
		
	}

}

?>