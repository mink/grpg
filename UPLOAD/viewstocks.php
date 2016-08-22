<?php
include 'header.php';
?>
<tr><td class="contentcontent" align="center">
<img src='images/stock market.png' />
</td></tr>
<tr><td class="contenthead">View Stock Market</td></tr>

<tr><td class="contentcontent">
	<table width='100%'>
		<tr>
			<td width='5%'><b>ID</b></td>
			<td width='70%'><b>Company Name</b></td>
			<td width='25%'><b>Cost per Share</b></td>
		</tr>
<?
$result = mysql_query("SELECT * FROM `stocks` ORDER BY `id` ASC");
while($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<tr><td width='5%'>".$line['id']."</td><td width='70%'>".$line['company_name']."</td><td width='25%'>$".$line['cost']."</td></tr>";
}
?>
	</table>
</td></tr>
<?php
include 'footer.php';
?>