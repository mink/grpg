<?
include 'header.php';
$profile_class = new User($_GET['id']);
?>
<tr><td class="contenthead">Profile</td></tr>
<tr><td class="contentcontent">
		<table width='100%'>
		<tr>
			<td colspan='4'>

				<table width='100%' height='100%' cellpadding='5' cellspacing='2'>
				<tr>

					<td width='120' align='center'><img height="100" width="100" src="<?= $profile_class->avatar ?>"></td>
					<td align='center'><b>Favorite Quote: </b>"<?php echo $profile_class->quote; ?>"
					</td>

				</tr>
				</table>

			</td>
		</tr>

		<tr>
			<td width='15%'><b>Name</b>:</td>
			<td width='35%'><?php echo $profile_class->formattedname; ?></td>

			<td width='15%'><b>HP</b>:</td>
			<td width='35%'><?php echo $profile_class->formattedhp; ?></td>
		</tr>

		<tr>
			<td width='15%'><b>Type</b>:</td>
			<td width='35%'><?php echo $profile_class->type ?></td>

			<td width='15%'><b>Crimes</b>:</td>
			<td width='35%'><?php echo $profile_class->crimetotal; ?></td>
		</tr>

		<tr>
			<td width='15%'><b>Level</b>:</td>
			<td width='35%'><?php echo $profile_class->level; ?></td>

			<td width='15%'><b>Money</b>:</td>
			<td width='35%'>$<?php echo $profile_class->money; ?></td>
		</tr>

		<tr>
			<td width='15%'><b>Age</b>:</td>
			<td width='35%'><?php echo $profile_class->age; ?></td>

			<td width='15%'><b>Last Active</b>:</td>
			<td width='35%'><?php echo $profile_class->formattedlastactive; ?></td>
		</tr>

		<tr>
			<td width='15%'><b>Online</b>:</td>
			<td width='35%'><?php echo $profile_class->formattedonline; ?></td>

			<td width='15%'><b>Gang</b>:</td>
			<td width='35%'><?php echo $profile_class->formattedgang; ?></td>
		</tr>

		<tr>
			<td width='15%'><b>City</b>:</td>
			<td width='35%'><?php echo $profile_class->cityname; ?></td>

			<td width='15%'><b>House</b>:</td>
			<td width='35%'><?php echo $profile_class->housename; ?></td>
		</tr>
		</table>
	</td></tr>

<?
if ($user_class->id != $profile_class->id){
?>

		<tr><td class="contenthead">Actions</td></tr>
		<tr><td class="contentcontent">
		<table width='100%'>
			<tr>
				<td width='25%' align='center'><a href='pms.php?to=<? echo $profile_class->username ?>'>Message</a></td>

				<td width='25%' align='center'><a href='attack.php?attack=<? echo $profile_class->id ?>'>Attack</a></td>
				<td width='25%' align='center'><a href='mug.php?mug=<? echo $profile_class->id ?>'>Mug</a></td>
				<td width='25%' align='center'><a href='spy.php?id=<?php echo $profile_class->id; ?>'>Spy</a></td>
			</tr>

			<tr>
				<td width='25%' align='center'><a href='sendmoney.php?person=<? echo $profile_class->id; ?>'>Send Money</a></td>
				<td width='25%' align='center'><a href='sendpoints.php?person=<? echo $profile_class->id ?>'>Send Points</a></td>

				<td width='25%' align='center'>
			<a href='http://www.mafiastreets.com/profile/3826/add_friend.php'>Add Friend</a>
				</td>
				<td width='25%' align='center'>
			<a href='http://www.mafiastreets.com/profile/3826/add_enemy.php'>Add Enemy</a>
				</td>
			</tr>

			</table>
			</td></tr>
<?
}
include 'footer.php';
?>