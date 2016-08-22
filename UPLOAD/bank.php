<?php
include 'header.php';

if($_POST['deposit'] != ""){
    $amount = $_POST['damount'];
    if ($amount > $user_class->money) {
        echo Message("You do not have that much money.");
    }
    if ($amount < 1){
        echo Message("Please enter a valid amount.");
    }
    if ($amount <= $user_class->money && $amount > 0) {
        echo Message("Money deposited.");
        $newbank = $amount + $user_class->bank;
        $newmoney = $user_class->money - $amount;
        $result = mysql_query("UPDATE `grpgusers` SET `bank` = '".$newbank."', `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");
        $user_class = new User($_SESSION['id']);
    }
}

if($_POST['withdraw'] != ""){
    $amount = $_POST['wamount'];
    if ($amount > $user_class->bank) {
        echo Message("You do not have that much money in the bank.");
    }
    if ($amount < 1){
        echo Message("Please enter a valid amount.");
    }
    if ($amount <= $user_class->bank && $amount > 0) {
        echo Message("Money withdrawn.");
        $newbank = $user_class->bank - $amount;
        $newmoney = $user_class->money + $amount;
        $result = mysql_query("UPDATE `grpgusers` SET `bank` = '".$newbank."', `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");
        $user_class = new User($_SESSION['id']);
    }
}

if($_GET['open'] == "new"){
    if($user_class->money >= 5000 && $user_class->bank == 0){
     $newmoney = $user_class->money - 5000;
        $result = mysql_query("UPDATE `grpgusers` SET `whichbank` = '1', `money` = '".$newmoney."' WHERE `id`='".$_SESSION['id']."'");
        $user_class = new User($_SESSION['
		']);
    }
}

if($user_class->rmdays > 1) {
	$interest = .04;
} else {
	$interest = .02;
}
$interest = ceil($user_class->bank * $interest);

?>
			<tr><td class="contenthead">Bank</td></tr>
      <? if($user_class->whichbank != 0){ ?>
      <tr><td class="contentcontent">
      Welcome to the bank. You currently have $<? echo $user_class->bank ?> in your account.<br><?php echo "You will make $".$interest." from interest next rollover."; ?><br><br>
			<form method='post'><input type='text' name='wamount' value='<? echo $user_class->bank ?>' size='10' maxlength='20'> &nbsp;
			<input type='submit' name='withdraw' value='Withdraw'></form><br><br>
			<form method='post'><input type='text' name='damount' value='<? echo $user_class->money ?>' size='10' maxlength='20'> &nbsp;
			<input type='submit' name='deposit' value='Deposit'></form>
	  </td></tr>
      <? } else { ?>
      <tr><td class="contenthead">Open An Account</td></tr>
      <tr><td class="contentcontent">
      You do not currently have an account with us. Would you like to open one for $5,000?<br>
      <a href="bank.php?open=new">Yes</a>
      </td></tr>
      <? } ?>
<?php
include 'footer.php';
?>