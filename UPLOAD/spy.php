<?
include 'header.php';
?>
<td class="contenthead" colspan="2">Spy</td></tr><tr>	<td class="contentcontent">	<table width="100%">
<?php
if ($_GET['id'] != ""){
$spy_class = new User($_GET['id']);
$cost = $spy_class->level * 1000;
	if($_GET['confirm'] != "yes"){
		echo "<center>Are you sure that you want to hire a Private Investigator to spy on ".$spy_class->formattedname." for $".$cost."?<br><a href='spy.php?id=".$spy_class->id."&confirm=yes'>Yes</a> | <a href='profiles.php?id=".$spy_class->id."'>No</a></center>";
	} else {
	  if($cost > $user_class->money){
	   echo "You don't have enough money.";    	
	  } else {
		$points = (rand(0,1) == 1) ? $spy_class->points : "Your Private Investigator could not find their points out.";
		$bank = (rand(0,1) == 1) ? $spy_class->bank : "Your Private Investigator could not find their bank out.";
		$strength = (rand(0,1) == 1) ? $spy_class->strength : "Your Private Investigator could not find their strength out.";
		$defense = (rand(0,1) == 1) ? $spy_class->defense : "Your Private Investigator could not find their defense out.";	
		$speed = (rand(0,1) == 1) ? $spy_class->speed : "Your Private Investigator could not find their speed out.";
		echo "Your Private Investigator found out the following about ".$spy_class->formattedname.":<br>Strength - ".prettynum($strength)." <br> Defense - ".prettynum($defense)." <br> Speed - ".prettynum($speed)." <br> Bank - ". prettynum($bank,1) ."<br> Points - ". prettynum($points)."<br><br><center><a href='spylog.php'>View Spylog</a></center>";
		$total = $user_class->money - $cost;
		$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$total."' WHERE `id` = '".$user_class->id."'");
	if (!is_numeric($defense)){
		$defense = "-1";
	}
	if (!is_numeric($speed)){
		$speed = "-1";
	}
	if (!is_numeric($bank)){
		$bank = "-1";
	}
	if (!is_numeric($strength)){
		$strength = "-1";
	}
	if (!is_numeric($points)){
		$points = "-1";
	}

		$result=mysql_query("INSERT INTO `spylog` (`id`, `spyid`, `strength`, `defense`, `speed`, `bank`, `points`, `age`) VALUES ('".$user_class->id."', '".$spy_class->id."', '".$strength."', '".$defense."', '".$speed."', '".$bank."', '".$points."', '".time()."')");

	  }
	}
}
?>
<?
include 'footer.php';
?>