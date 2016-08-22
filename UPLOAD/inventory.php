<?
include 'header.php';
if ($_GET['use'] == 14){ //if they are trying to use an awake pill
	$result = mysql_query("SELECT * FROM `inventory` WHERE `userid`='".$user_class->id."' AND `itemid`='14'");
	$howmany = mysql_num_rows($result);

	if ($howmany > 0) {
		$result = mysql_query("UPDATE `grpgusers` SET `awake` = '".$user_class->maxawake."' WHERE `id`='".$_SESSION['id']."'");
		Take_Item(14, $user_class->id);//take away an awake pill
		echo Message("You popped an awake pill.");
	}
}
?>
<tr><td class="contenthead">Your Inventory</td></tr>
<tr><td class="contentcontent">Everything you have collected.</td></tr>
<tr><td class="contenthead">Equipped</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
	<tr>
		<td width='50%' align='center'>
		<? if ($user_class->eqweapon != 0){?>
			<img src='<?= $user_class->weaponimg ?>' width='100' height='100' style='border: 1px solid #333333'><br>
			<?= item_popup($user_class->weaponname, $user_class->eqweapon) ?><br>
			<a href='equip.php?unequip=weapon'>[Unequip]</a>
		<? } else {
			echo "You don't have a weapon equipped.";
		   }
		?>
		</td>
		<td width='50%' align='center'>
		<? if ($user_class->eqarmor != 0){?>
			<img src='<?= $user_class->armorimg ?>' width='100' height='100' style='border: 1px solid #333333'><br>
			<?= item_popup($user_class->armorname, $user_class->eqarmor) ?><br>
			<a href='equip.php?unequip=armor'>[Unequip]</a>
		<? } else {
			echo "You don't have any armor equipped.";
		   }
		?>
		</td>
	</tr>
</table>
</td></tr>
<?
$result = mysql_query("SELECT * FROM `inventory` WHERE `userid` = '".$user_class->id."' ORDER BY `userid` DESC");

	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$result2 = mysql_query("SELECT * FROM `items` WHERE `id`='".$line['itemid']."'");
    $worked2 = mysql_fetch_array($result2);

		if ($worked2['offense'] > 0){
		$sell = ($worked2['cost'] > 0) ? "<a href='sellitem.php?id=".$worked2['id']."'>[Sell]</a>" : "";
		$weapons .= "

		<td width='25%' align='center'>

		<img src='". $worked2['image']."' width='100' height='100' style='border: 1px solid #333333'><br>
		". item_popup($worked2['itemname'], $worked2['id']) ." [x".$line['quantity']."]<br>
		$". $worked2['cost'] ."<br>
		$sell <a href='putonmarket.php?id=".$worked2['id']."'>[Market]</a> <a href='senditem.php?id=".$worked2['id']."'>[Send]</a> <a href='equip.php?eq=weapon&id=".$worked2['id']."'>[Equip]</a>
		</td>
		";
		}

		if ($worked2['defense'] > 0){
		$sell = ($worked2['cost'] > 0) ? "<a href='sellitem.php?id=".$worked2['id']."'>[Sell]</a>" : "";
		$armor .= "

		<td width='25%' align='center'>

		<img src='". $worked2['image']."' width='100' height='100' style='border: 1px solid #333333'><br>
		". item_popup($worked2['itemname'], $worked2['id']) ." [x".$line['quantity']."]<br>
		$". $worked2['cost'] ."<br>
		$sell <a href='putonmarket.php?id=".$worked2['id']."'>[Market]</a> <a href='senditem.php?id=".$worked2['id']."'>[Send]</a> <a href='equip.php?eq=armor&id=".$worked2['id']."'>[Equip]</a>
		</td>
		";
		}

		if ($worked2['id'] == 14){
		$misc .= "

		<td width='25%' align='center'>

		<img src='". $worked2['image']."' width='100' height='100' style='border: 1px solid #333333'><br>
		". $worked2['itemname'] ." [x".$line['quantity']."]<br>
		<a href='inventory.php?use=14'>[Use]</a> <a href='putonmarket.php?id=".$worked2['id']."'>[Market]</a> <a href='senditem.php?id=".$worked2['id']."'>[Send]</a>
		</td>
		";
		}
	}
	
//check for drugs
		if ($user_class->cocaine != 0){
			$drugs .= "
	
			<td width='25%' align='center'>
	
			<img src='images/noimage.png' width='100' height='100' style='border: 1px solid #333333'><br>
			Cocaine [x".$user_class->cocaine."]<br>
			$0<br>
			<a href='drugs.php?use=cocaine'>[Use]</a>
			</td>
			";
		}
		if ($user_class->nodoze != 0){
			$drugs .= "
	
			<td width='25%' align='center'>
	
			<img src='images/noimage.png' width='100' height='100' style='border: 1px solid #333333'><br>
			No-Doze [x".$user_class->nodoze."]<br>
			$0<br>
			<a href='drugs.php?use=nodoze'>[Use]</a>
			</td>
			";
		}
		if ($user_class->genericsteroids != 0){
			$drugs .= "
	
			<td width='25%' align='center'>

			<img src='images/noimage.png' width='100' height='100' style='border: 1px solid #333333'><br>
			Generic Steroids [x".$user_class->genericsteroids."]<br>
			$0<br>
			<a href='drugs.php?use=genericsteroids'>[Use]</a>
			</td>
			";
		}
//check for drugs
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
if ($armor != ""){
 ?>
<tr><td class="contenthead">Armor</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
				<tr>
				<? echo $armor; ?>
				</tr>
			</table>
</td></tr>
<?
}


if ($misc != ""){
 ?>
<tr><td class="contenthead">Misc.</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
				<tr>
				<? echo $misc; ?>
				</tr>
			</table>
</td></tr>
<?
}

if ($drugs != ""){
 ?>
<tr><td class="contenthead">Drugs</td></tr>
<tr><td class="contentcontent">
<table width='100%'>
				<tr>
				<? echo $drugs; ?>
				</tr>
			</table>
</td></tr>
<?
}
include 'footer.php'
?>