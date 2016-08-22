<?php
include 'header.php';

if($_GET['radio'] == "on"){
	if($user_class->admin > 0) {
		echo "Radio has been turned on.";
		$result = mysql_query("UPDATE `serverconfig` SET `radio` = 'on'");
	} else {
	echo "You don't have priveledges to do that...";
	}
}

if($_GET['radio'] == "off"){
	if($user_class->admin > 0) {
		echo "Radio has been turned off.";
		$result = mysql_query("UPDATE `serverconfig` SET `radio` = 'off'");
	} else {
	echo "You don't have priveledges to do that...";
	}
}

if($_GET['random'] == "person"){
	if($user_class->admin > 0) {
		$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY RAND() LIMIT 0,1");
		$worked = mysql_fetch_array($result);
		$random_person = New User($worked['id']);
		echo "Random person selected is ".$random_person->formattedname;
	} else {
		echo "You don't have priveledges to do that...";
	}
}

include 'footer.php';
?>