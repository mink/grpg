<?
include 'dbcon.php';

$result = mysql_query("SELECT * FROM `stocks`");
while($line = mysql_fetch_assoc($result)) {
	$amount = rand (strlen($line['cost']) * -1, strlen($line['cost']));
	$newamount = $line['cost'] + $amount;
	if ($newamount < 1){
		$newamount = 1;
	}
	$result2 = mysql_query("UPDATE `stocks` SET `cost`='".$newamount."' WHERE `id`='".$line['id']."'");
}

?>