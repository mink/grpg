<?php
include 'header.php';
echo '<tr><td class="contenthead">Search Downtown</td></tr>';
echo '<tr><td class="contentcontent">';
if ($user_class->searchdowntown != 0) {
	for ($i=1; $i<=100; $i++)
	{
	  echo $i.".) ";
	  $randnum = rand(0,20);
	  if ($randnum == 0){
		echo "You didn't find anything.";
	  } else {
		echo "You found $".$randnum."!";
	  }
	  $total+= $randnum;
	  echo "<br>";
	}
	echo "<br> You found a total of $".$total." searching downtown!";
	$newmoney = $user_class->money + $total;
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."', `searchdowntown` = '0' WHERE `id`='".$user_class->id."'");
} else {
	echo "You have already searched down town as much as you can today.";
}
echo '</td></tr>';
include 'footer.php';
?>