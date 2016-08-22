<?php
include 'header.php';

if($_POST['sendmoney'] != ""){
  $money_person = new User($_POST['theirid']);

  if($user_class->money >= $_POST['amount'] && $_POST['amount'] > 0 && $user_class->id != $money_person->id){
	$newmoney = $user_class->money - $_POST['amount'];
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");

	$newmoney = $money_person->money + $_POST['amount'];
	$result = mysql_query("UPDATE `grpgusers` SET `money` = '".$newmoney."' WHERE `id`='".$_POST['theirid']."'");
	echo "You have successfully transferred $".$_POST['amount']." to ".$money_person->formattedname.".";
	Send_Event($user_points->id, "You have been sent $".$_POST['amount']." from ".$user_class->formattedname);
  } else {
	echo "You don't have enough money to do that!";
  }
}
?>

<div class="content"><u>Send Money</u><br>
<form name='login' method='post' action='sendmoney.php'>
  <p>&nbsp;</p>
  <table border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td width='35%' height='27'>Amount Of Money</td>
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
        <input type='submit' name='sendmoney' value='Send Money'>
        </td>
    </tr>
  </table>
</form>
</div>


<?php
include 'footer.php';
?>