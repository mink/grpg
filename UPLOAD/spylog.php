<?
include 'header.php';
?>
<td class="contenthead" colspan="2">Spy Log</td></tr><tr>	<td class="contentcontent">	<table width="100%">

<tr>
	<td>When</td>
	<td>Username</td>
	<td>Strength</td>
	<td>Defense</td>
	<td>Speed</td>
	<td>Bank</td>
	<td>Points</td>
</tr>

<?

$result = mysql_query("SELECT * from `spylog` WHERE `id` = '".$user_class->id."' ORDER BY age DESC LIMIT 0,25");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if ($line['defense'] == -1){
		$line['defense'] = "Failed";
	}
	if ($line['speed'] == -1){
		$line['speed'] = "Failed";
	}
	if ($line['bank'] == -1){
		$line['bank'] = "Failed";
	}
	if ($line['strength'] == -1){
		$line['strength'] = "Failed";
	}
	if ($line['points'] == -1){
		$line['points'] = "Failed";
	}

	$profile_class = new User($line['spyid']);
	$out .= " <tr>	<td>". howlongago($line['age']) ." ago </td> <td>". $profile_class->formattedname ."</td> <td>" .prettynum($line['strength']). "</td> <td>" .prettynum($line['defense']). "</td> <td>" .prettynum($line['speed']). "</td> <td>".prettynum($line['bank'],1)."</td> <td>".prettynum($line['points'])."</td> </tr>";

}
echo $out;

include 'footer.php';
?>


	