<?php
include 'header.php';

if($_GET['buy'] != ''){
    $result = mysql_query("SELECT * FROM `houses` WHERE `id`='".$_GET['buy']."'");
    $worked = mysql_fetch_array($result);
    $cost = $worked['cost'];
	
		   if($user_class->house != 0){
			  $result2 = mysql_query("SELECT * FROM `houses` WHERE `id`='".$user_class->house."'");
			  $worked2 = mysql_fetch_array($result2);
			  $cost = $cost - ($worked2['cost'] * .75);
		
			  echo Message('You have sold your house for 75% of what it was worth ($'.$cost."). That amount will go towards the purchase of the new house.");
		   }
	
	
      if($cost > $user_class->money) {
          echo Message("You don't have enough money to buy that house.");
      }
      if($cost <= $user_class->money && $worked['name'] != "") {
	  
          $newmoney = $user_class->money - $cost;
          $result = mysql_query("UPDATE `grpgusers` SET `house` = '".$_GET['buy']."', `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");
          echo Message("You have purchased and moved into ".$worked['name'].".");
          $user_class = new User($_SESSION['id']);
      }
      if ($worked['name'] == ""){
          echo Message("That's not a real house.");
      }
}
?>
<tr><td class="contenthead">Move House</td></tr>
<?
if($user_class->house > 0){
	echo "<tr><td class='contentcontent' align='center'><a href='house.php?action=sell'>Sell Your House</a></td></tr>";
}
?>
<tr><td class="contentcontent">
<table width='100%'>
	<tr>
		<td width='45%'><b>Type</b></td>
		<td width='15%'><b>Awake</b></td>
		<td width='20%'><b>Cost</b></td>
		<td width='20%'><b>Move</b></td>
	</tr>

<?php
$result = mysql_query("SELECT * FROM `houses` ORDER BY `id` ASC");
	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<tr><td width='45%'>".$line['name']."</td><td>".$line['awake']."</td><td>\$".$line['cost']."</td><td>";
				if($line['id'] > $user_class->house){
					echo "<a href='house.php?buy=".$line['id']."'>Move In</a>";
				}
			echo "</td></tr>";

	}
?>
</table>
</td></tr>
<?php
include 'footer.php';
?>