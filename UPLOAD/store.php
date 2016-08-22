<?
//*********************** The GRPG ***********************
//*$Id: store.php,v 1.3 2007/07/24 02:52:21 cvs Exp $*
//********************************************************

include 'header.php';

if (isset($_GET['buy'])) {

$resultnew = mysql_query("SELECT * from `items` WHERE `id` = '".$_GET['buy']."' and `buyable` = '1'");
$worked = mysql_fetch_array($resultnew);
 if($worked['id'] != ""){
    if ($user_class->money >= $worked['cost']){
    $newmoney = $user_class->money - $worked['cost'];
    $newsql = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`= '".$user_class->id."'");
    Give_Item($_GET['buy'], $user_class->id);//give the user their item they bought
    echo Message("You have purchased a ".$worked['itemname']);
    } else {
    echo Message("You do not have enough money to buy a ".$worked['itemname']);
    }
  } else {
  echo Message("That isn't a real item.");
  }
}

	$result = mysql_query("SELECT * FROM `items`");
	$howmanyitems = 0;
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

		if ($line['offense'] > 0 && $line['buyable'] == 1){
		$weapons .= "

		<td width='25%' align='center'>

						<img src='". $line['image']."' width='100' height='100' style='border: 1px solid #333333'><br>
						". item_popup($line['itemname'], $line['id']) ." [x1]<br>
						$". $line['cost'] ."<br>
						<a href='store.php?buy=".$line['id']."'>[Buy]</a>
					</td>
		";
		$howmanyitems = $howmanyitems + 1;
			if ($howmanyitems == 3){
				$weapons.= "</tr><tr>";
				$howmanyitems = 0;
			}
		}
	}
if ($weapons != ""){
 ?>
<tr><td class="contenthead">Weapons</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
				<tr>
				<? echo $weapons; ?>
				</tr>
			</table>
</td></tr>
<?
}
include 'footer.php'
?>