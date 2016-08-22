 search.php
File Type: PHP script text

<?
include 'header.php';
?>
<tr><td class="contenthead">Mobster Search</td></tr>
<tr><td class="contentcontent">Find mobsters that meet your search criteria.</td></tr>
<tr><td class="contentcontent">
<form method="post">
	<table cellspacing='0' cellpadding='3'>
	<tr>
		<td>Level:</td>
		<td><input type='text' name='level' size='7' maxlength='10'> to <input type='text' name='level2' size='7' maxlength='10'>(inclusive)</td>
	</tr>
	<tr>
		<td>Money:</td>
		<td>$<input type='text' name='money' size='12' maxlength='16'> and more</td>

	</tr>
	<tr>
		<td>Attackable:</td>
		<td><select name='attack'>
		<option value='1'>Yes</option>
		<option value='0'>No</option>

		</select></td>
	</tr>
	<tr>
		<td colspan='2'><input type='submit' name='search' value='Search'></td>
	</tr>
	</table>
</form>
</td></tr>
<?
if($_POST['search'] != ""){
	echo '<tr><td class="contenthead">Search Results</td></tr><tr><td class="contentcontent">';
	$result = mysql_query("SELECT * FROM `grpgusers` ORDER BY `id` ASC");

	while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$user_search = new User($line['id']);
		if($user_search->jail == 0 && $user_search->hospital == 0 && $user_class->city == $user_search->city){
			$attack = 1;
		} else {
			$attack = 0;
		}

		if($_POST['level'] <= $user_search->level && $_POST['level2'] >= $user_search->level && $user_search->money >= $_POST['money'] && $attack == $_POST['attack']){
			echo "<div>".$user_search->id.".)".$user_search->formattedname." $".$user_search->money." Level:".$user_search->level."</div>";
		}
	}
	echo "</td></tr>";
}

include 'footer.php';
?>

