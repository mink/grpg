<?php
include 'header.php';

$error = ($user_class->jail > 0) ? "You can't do crimes if you are in jail." : $error;
$error = ($user_class->hospital > 0) ? "You can't do crimes if you are in the hospital." : $error;

if (isset($error)){
	echo Message($error);
	include 'footer.php';
	die();
}

$crime = $_GET['id'];

if ($crime != ""){

	$result = mysql_query("SELECT * FROM `crimes` WHERE `id`='".$crime."'");
    $worked = mysql_fetch_array($result);
	$nerve = $worked['nerve'];
	$name = $worked['name'];
	$stext = '[[We currently do not have a success message for this crime :( You can help  us by submitting your idea for a message in the crime section of the forums!]]';
	$ctext = '[[We currently do not have a "You got caught" message for this crime :( You can help  us by submitting your idea for a message in the crime section of the forums!]]';
	$ftext = '[[We currently do not have a failure message for this crime :( You can help  us by submitting your idea for a message in the crime section of the forums!]]';
	$stexta = explode("^",$worked['stext']);
	$stext = ($stexta[0] != "") ? $stexta[array_rand($stexta)] : $stext;
	$ctexta = explode("^",$worked['ctext']);
	$ctext = ($ctexta[0] != "") ? $ctexta[array_rand($ctexta)] : $ctext;
	$ftexta = explode("^",$worked['ftext']);
	$ftext = ($ftexta[0] != "") ? $ftexta[array_rand($ftexta)] : $ftext;
	
	$chance = rand(1,(100 * $nerve - ($user_class->speed / 35)));
	// get the crimes here

	$money = (25 * $nerve) + 15 * ($nerve - 1);
	$exp = $money;

	if ($user_class->nerve >= $nerve) {
		if($chance <= 75) {
			echo Message($stext."<br><br><font color='green'>Success! You receive ".$exp." exp and $".$money.".</font><br><a href='crime.php?id=".$crime."'>Retry</a> | <a href='crime.php'>Back</a>");
			$exp = $exp + $user_class->exp;
			$crimesucceeded = 1 + $user_class->crimesucceeded;
			$crimemoney = $money + $user_class->crimemoney;
			$money = $money + $user_class->money;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `exp` = '".$exp."', `crimesucceeded` = '".$crimesucceeded."', `crimemoney` = '".$crimemoney."', `money` = '".$money."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
		}elseif ($chance >= 150) {
			echo Message($ctext."<br><br><font color='red'>You were caught.</font> You were hauled off to jail for " . $crime * 10 . " minutes.");
			$crimefailed = 1 + $user_class->crimefailed;
			$jail = $crime * 60 * 10;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `crimefailed` = '".$crimefailed."', `jail` = '".$jail."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
		}else{
			echo Message($ftext."<br><br><font color='red'>You failed.</font><br><a href='crime.php?id=".$crime."'>Retry</a> | <a href='crime.php'>Back</a>");
			$crimefailed = 1 + $user_class->crimefailed;
			$nerve = $user_class->nerve - $nerve;
			$result = mysql_query("UPDATE `grpgusers` SET `crimefailed` = '".$crimefailed."', `nerve` = '".$nerve."' WHERE `id`='".$_SESSION['id']."'");
		}
	} else {
		echo Message("You don't have enough nerve for that crime.");
	}
	include 'footer.php';
	die();
}
?>

<tr><td class="contenthead">Crime</td></tr>

<tr><td class="contentcontent">
	<table width='100%'>
		<tr>
			<td width='50%'><b>Name</b></td>
			<td width='25%'><b>Nerve</b></td>
			<td width='25%'><b>Action</b></td>
		</tr>
<?
$result = mysql_query("SELECT * FROM `crimes` ORDER BY `nerve` ASC");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<tr><td width='50%'>".$line['name']."</td><td width='25%'>".$line['nerve']."</td><td width='25%'>[<a href='crime.php?id=".$line['id']."'>do</a>]</td></tr>";
}
?>
	</table>
</td></tr>
<?php
include 'footer.php';
?>