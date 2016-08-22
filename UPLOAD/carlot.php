<?
include 'header.php';

if ($user_class->city != 2){
	echo Message("You must be in Los Angeles to visit Big Bob's. If you are level 5 you can take the <a href='bus.php'>bus</a> to L.A. now and visit Big Bob's.");
	include 'footer.php';
	die();
}

if (isset($_GET['buy'])) {

$resultnew = mysql_query("SELECT * from `carlot` WHERE `id` = '".$_GET['buy']."'");
$worked = mysql_fetch_array($resultnew);
 if($worked['id'] != ""){
    if ($user_class->money >= $worked['cost']){
    $newmoney = $user_class->money - $worked['cost'];
    $newsql = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`= '".$user_class->id."'");
    $result= mysql_query("INSERT INTO `cars` VALUES('$user_class->id', '".$_GET['buy']."')");
    echo Message("You have purchased a ".$worked['name']);
    } else {
    echo Message("You do not have enough money to buy a ".$worked['name']);
    }
  } else {
  echo Message("That isn't a real item.");
  }
}

$result = mysql_query("SELECT * FROM `carlot`");
$howmanyitems = 0;
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if ($line['buyable'] == 1){
		$cars .= "	
		<td width='25%' align='center'>
	
						<img src='". $line['image']."' width='100' height='100' style='border: 1px solid #333333'><br>
						". car_popup($line['name'], $line['id']) ."<br>
						$". $line['cost'] ."<br>
						<a href='carlot.php?buy=".$line['id']."'>[Buy]</a>
					</td>
		";
		$howmanyitems = $howmanyitems + 1;
		if ($howmanyitems == 3){
			$cars.= "</tr><tr>";
			$howmanyitems = 0;
		}
	}
}
?>
<tr><td class="contenthead">Car Lot</td></tr>
<tr><td class="contentcontent">
Welcome to Big Bob's Used Car Lot! Just take your pick of any cars I have out in my lot.
</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
				<tr>
				<? echo $cars; ?>
				</tr>
			</table>
</td></tr>
<?
include 'footer.php'
?>