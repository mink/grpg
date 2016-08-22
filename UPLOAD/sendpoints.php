<?php
include 'header.php';

if($_POST['sendpoints'] != ""){
  $money_person = new User($_POST['theirid']);

  if($user_class->points >= $_POST['amount'] && $_POST['amount'] > 0 && $user_class->id != $money_person->id){
	$newpoints = $user_class->points - $_POST['amount'];
	$result = mysql_query("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `id`='".$_SESSION['id']."'");
	
	$newpoints = $money_person->points + $_POST['amount'];
	$result = mysql_query("UPDATE `grpgusers` SET `points` = '".$newpoints."' WHERE `id`='".$_POST['theirid']."'");
	echo "You have successfully transferred ".$_POST['amount']." points to ".$money_person->formattedname.".";
  } else {
	echo "You don't have enough points to do that!";
  } 
}
?>

<div class="content"><u>Send Points</u><br>
<form name='login' method='post' action='sendpoints.php'>
  <p>&nbsp;</p>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr> 
      <td width='35%' height='27'>Amount Of Points</td>
      <td width='65%'>
        <input name='amount' type='text' size='22'>
    	</td>
    </tr>
        <tr> 
      <td width='35%' height='27'>User ID</td>
      <td width='65%'>
        <input name='theirid' type='text' size='22' value='<? echo $_GET['person'] ?>'>
    	</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>
        <input type='submit' name='sendpoints' value='Send Points'>
        </td>
    </tr>
  </table>
</form>
</div>


<?php
include 'footer.php';
?>